<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Http\Request;

class ClassificationHistoryController extends Controller
{
    public function index(Request $request)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $query = Upload::latest();

        // Filter by category
        if ($request->filter && $request->filter !== 'all') {
            $query->where('category', $request->filter);
        }

        // Search
        if ($request->search) {
            $query->where('category', 'like', '%' . $request->search . '%');
        }

        $uploads = $query->paginate(10);

        return view('Admin.classification-history', compact('uploads'));
    }
}