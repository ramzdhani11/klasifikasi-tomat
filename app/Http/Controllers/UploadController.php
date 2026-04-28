<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\Upload;
use Intervention\Image\Facades\Image;

class UploadController extends Controller
{
    protected $flaskApiUrl = 'http://127.0.0.1:5000/predict';

    /**
     * Display the upload page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('landing_page.upload');
    }

    /**
     * Handle the file upload and send to Flask API.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'tomato_image' => [
                'required',
                'file',
                'image',
                'mimes:jpeg,jpg,png',
                'max:5120', // 5MB max
            ],
        ], [
            'tomato_image.required' => 'Gambar tomat harus diunggah.',
            'tomato_image.file' => 'File harus berupa gambar.',
            'tomato_image.image' => 'File harus berupa gambar.',
            'tomato_image.mimes' => 'Format file yang diizinkan: JPG, JPEG, PNG.',
            'tomato_image.max' => 'Ukuran file maksimal 5MB.',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('upload.index')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $file = $request->file('tomato_image');
            
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $uploadPath = 'uploads/tomatoes';
            
            if (!Storage::disk('public')->exists($uploadPath)) {
                Storage::disk('public')->makeDirectory($uploadPath);
            }
            
            // ✅ Ganti dengan ini (kompress sebelum simpan)
$savePath = storage_path('app/public/' . $uploadPath . '/' . $filename);

// Buat folder jika belum ada
if (!file_exists(storage_path('app/public/' . $uploadPath))) {
    mkdir(storage_path('app/public/' . $uploadPath), 0755, true);
}

// Kompress: resize max 800px, quality 75%
Image::make($file->getRealPath())
    ->resize(400, null, function ($constraint) {
        $constraint->aspectRatio();
        $constraint->upsize();
    })
    ->save($savePath, 60);

$imagePath = $uploadPath . '/' . $filename;
            
            $apiResponse = $this->sendToFlaskAPI($file);
            
            if (!$apiResponse['success']) {
                return redirect()
                    ->route('upload.index')
                    ->withErrors(['error' => $apiResponse['error']])
                    ->withInput();
            }
            
            $upload = Upload::create([
                'image_path' => $imagePath,
                'category' => $apiResponse['category'],
                'confidence' => $apiResponse['confidence'],
            ]);
            
            return redirect()->route('upload.result', ['id' => $upload->id])
                ->with('success', 'Klasifikasi berhasil diproses.');
                
        } catch (\Exception $e) {
            return redirect()
                ->route('upload.index')
                ->withErrors(['error' => 'Terjadi kesalahan saat mengunggah file: ' . $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * Send image to Flask API for classification with retry mechanism.
     *
     * @param  \Illuminate\Http\UploadedFile  $file
     * @return array
     */
    private function sendToFlaskAPI($file)
    {
        $maxRetries = 2;
        $retryDelay = 1000; // milliseconds

        for ($attempt = 1; $attempt <= $maxRetries + 1; $attempt++) {
            try {
                $response = Http::timeout(30)
                    ->attach(
                        'image',
                        file_get_contents($file->getRealPath()),
                        $file->getClientOriginalName()
                    )
                    ->post($this->flaskApiUrl);

                if ($response->failed()) {
                    if ($attempt < $maxRetries + 1) {
                        usleep($retryDelay * 1000);
                        continue;
                    }
                    return [
                        'success' => false,
                        'error' => 'Gagal menghubungi API klasifikasi. Status: ' . $response->status()
                    ];
                }

                $result = $response->json();

                // Validate API response structure
                if (!isset($result['success'])) {
                    return [
                        'success' => false,
                        'error' => 'Format response API tidak valid'
                    ];
                }

                if (!$result['success']) {
                    $errorMsg = $result['message'] ?? 'Prediksi gagal';
                    return [
                        'success' => false,
                        'error' => 'Error dari API: ' . $errorMsg
                    ];
                }

                // Validate prediction structure
                if (!isset($result['prediction']['class']) || !isset($result['prediction']['confidence_percentage'])) {
                    return [
                        'success' => false,
                        'error' => 'Format response API tidak valid'
                    ];
                }

                // Extract and validate prediction data
                $category = $result['prediction']['class'];
                $confidence = round((float)$result['prediction']['confidence_percentage'], 2);

                // Validate category
                if (!in_array($category, ['matang', 'mentah', 'setengah_matang'])) {
                    return [
                        'success' => false,
                        'error' => 'Kategori prediksi tidak valid'
                    ];
                }

                return [
                    'success' => true,
                    'category' => $category,
                    'confidence' => $confidence
                ];

            } catch (\Illuminate\Http\Client\ConnectionException $e) {
                if ($attempt < $maxRetries + 1) {
                    usleep($retryDelay * 1000);
                    continue;
                }
                return [
                    'success' => false,
                    'error' => 'Tidak dapat terhubung ke API Flask. Pastikan server Python sudah berjalan.'
                ];
            } catch (\Exception $e) {
                if ($attempt < $maxRetries + 1) {
                    usleep($retryDelay * 1000);
                    continue;
                }
                return [
                    'success' => false,
                    'error' => 'Terjadi kesalahan saat memproses prediksi.'
                ];
            }
        }

        return [
            'success' => false,
            'error' => 'Gagal memproses prediksi setelah beberapa percobaan.'
        ];
    }

    /**
     * Display the classification result from database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function result(Request $request)
    {
        $uploadId = $request->route('id') ?? $request->query('id');

        if (!$uploadId) {
            return redirect()->route('upload.index')
                ->withErrors(['error' => 'ID upload tidak valid.']);
        }

        $upload = Upload::find($uploadId);

        if (!$upload) {
            return redirect()->route('upload.index')
                ->withErrors(['error' => 'Data klasifikasi tidak ditemukan.']);
        }

        return view('result', [
            'imagePath' => $upload->image_path,
            'category' => $upload->category,
            'confidence' => $upload->confidence,
            'processedAt' => $upload->created_at
        ]);
    }

    /**
     * Handle admin login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function adminLogin(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6',
        ], [
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 255 karakter.',
            'password.required' => 'Kata sandi harus diisi.',
            'password.string' => 'Kata sandi harus berupa string.',
            'password.min' => 'Kata sandi minimal 6 karakter.',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('admin.login')
                ->withErrors($validator)
                ->withInput();
        }

        $email = $request->input('email');
        $password = $request->input('password');

        // Query hanya admin dengan role 'admin'
        $user = \DB::table('users')
        ->where('email', $email)
        ->first();

        // Verifikasi password dan pastikan role adalah 'admin'
        if ($user && \Hash::check($password, $user->password) && $user->role === 'admin') {
            // Simpan session
            session([
                'admin_logged_in' => true,
                'admin_user_id' => $user->id,
                'admin_name' => $user->name
            ]);
            
            return redirect()->route('admin.dashboard')->with('success', 'Login berhasil! Selamat datang, ' . $user->name);
        }

        // Login gagal
        return redirect()
            ->route('admin.login')
            ->withErrors(['login' => 'Email atau kata sandi salah. Hanya admin yang dapat login.'])
            ->withInput($request->except('password'));
    }
}
