<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    private function checkAuth()
    {
        if (!session('admin_logged_in')) {
            abort(403, 'Unauthorized');
        }
    }

    public function index()
    {
        $this->checkAuth();

        // Ambil hanya admin
        $admins = User::where('role', 'admin')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Admin.manage-admin', compact('admins'));
    }

    public function store(Request $request)
    {
        $this->checkAuth();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $admin = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'email_verified_at' => now()
        ]);

        return response()->json([
            'success' => 'Admin berhasil ditambahkan',
            'admin' => $admin
        ]);
    }

    public function edit($id)
    {
        $this->checkAuth();

        $admin = User::where('id', $id)
            ->where('role', 'admin')
            ->firstOrFail();

        return response()->json($admin);
    }

    public function update(Request $request, $id)
    {
        $this->checkAuth();

        $admin = User::where('id', $id)
            ->where('role', 'admin')
            ->firstOrFail();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            $admin->update([
                'password' => Hash::make($request->password)
            ]);
        }

        return response()->json([
            'success' => 'Admin berhasil diperbarui',
            'admin' => $admin
        ]);
    }

    public function destroy($id)
    {
        $this->checkAuth();

        $admin = User::where('id', $id)
            ->where('role', 'admin')
            ->firstOrFail();

        if ($admin->id == session('admin_user_id')) {
            return response()->json([
                'error' => 'Tidak dapat menghapus akun yang sedang digunakan'
            ], 422);
        }

        $admin->delete();

        return response()->json([
            'success' => 'Admin berhasil dihapus'
        ]);
    }

    public function toggleStatus($id)
    {
        $this->checkAuth();

        $admin = User::where('id', $id)
            ->where('role', 'admin')
            ->firstOrFail();

        if ($admin->id == session('admin_user_id')) {
            return response()->json([
                'error' => 'Tidak dapat menonaktifkan akun yang sedang digunakan'
            ], 422);
        }

        $status = $admin->email_verified_at ? null : now();

        $admin->update([
            'email_verified_at' => $status
        ]);

        return response()->json([
            'success' => 'Status berhasil diubah',
            'status' => $status ? 'active' : 'inactive'
        ]);
    }
}