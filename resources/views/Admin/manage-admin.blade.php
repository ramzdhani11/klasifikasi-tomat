@extends('Admin.layouts.app')

@section('title', 'Kelola Akun Admin')

@section('page-title', 'Kelola Akun Admin')

@section('content')
<!-- Page Header -->
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-2">Kelola Akun Admin</h1>
    <p class="text-gray-600">Kelola admin yang memiliki akses ke sistem klasifikasi tomat</p>
</div>

<!-- Add Admin Button -->
<div class="mb-6">
    <button class="btn-primary px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white font-medium rounded-xl hover:from-red-600 hover:to-red-700 transition-all duration-300 flex items-center space-x-2">
        <i class="fas fa-plus"></i>
        <span>Tambah Admin</span>
    </button>
</div>

<!-- Admin Table -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Foto
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nama
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Email
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Role
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <!-- Admin Row 1 -->
                <tr class="table-row">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <img src="https://picsum.photos/seed/admin1/50/50.jpg" 
                             alt="Admin" 
                             class="w-12 h-12 rounded-full object-cover border-2 border-gray-200">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">Ahmad Wijaya</div>
                        <div class="text-xs text-gray-500">Active</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        ahmad.wijaya@example.com
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                            Super Admin
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button class="btn-action text-blue-600 hover:text-blue-900 mr-3 transition-colors">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-action text-red-600 hover:text-red-900 transition-colors">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                
                <!-- Admin Row 2 -->
                <tr class="table-row">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <img src="https://picsum.photos/seed/admin2/50/50.jpg" 
                             alt="Admin" 
                             class="w-12 h-12 rounded-full object-cover border-2 border-gray-200">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">Siti Nurhaliza</div>
                        <div class="text-xs text-gray-500">Active</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        siti.nurhaliza@example.com
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                            Admin
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button class="btn-action text-blue-600 hover:text-blue-900 mr-3 transition-colors">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-action text-red-600 hover:text-red-900 transition-colors">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                
                <!-- Admin Row 3 -->
                <tr class="table-row">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <img src="https://picsum.photos/seed/admin3/50/50.jpg" 
                             alt="Admin" 
                             class="w-12 h-12 rounded-full object-cover border-2 border-gray-200">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">Budi Santoso</div>
                        <div class="text-xs text-gray-500">Active</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        budi.santoso@example.com
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                            Admin
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button class="btn-action text-blue-600 hover:text-blue-900 mr-3 transition-colors">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-action text-red-600 hover:text-red-900 transition-colors">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                
                <!-- Admin Row 4 -->
                <tr class="table-row">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <img src="https://picsum.photos/seed/admin4/50/50.jpg" 
                             alt="Admin" 
                             class="w-12 h-12 rounded-full object-cover border-2 border-gray-200">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">Dewi Lestari</div>
                        <div class="text-xs text-gray-500">Inactive</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        dewi.lestari@example.com
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                            Admin
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button class="btn-action text-blue-600 hover:text-blue-900 mr-3 transition-colors">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-action text-red-600 hover:text-red-900 transition-colors">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                
                <!-- Admin Row 5 -->
                <tr class="table-row">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <img src="https://picsum.photos/seed/admin5/50/50.jpg" 
                             alt="Admin" 
                             class="w-12 h-12 rounded-full object-cover border-2 border-gray-200">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">Rizki Pratama</div>
                        <div class="text-xs text-gray-500">Active</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        rizki.pratama@example.com
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Moderator
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button class="btn-action text-blue-600 hover:text-blue-900 mr-3 transition-colors">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-action text-red-600 hover:text-red-900 transition-colors">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Add Admin Modal functionality
    document.addEventListener('DOMContentLoaded', function() {
        const addAdminBtn = document.querySelector('.btn-primary');
        
        addAdminBtn.addEventListener('click', function() {
            // In a real application, this would open a modal
            alert('Modal tambah admin akan dibuka di sini');
        });
        
        // Edit buttons
        document.querySelectorAll('.btn-action.text-blue-600').forEach(btn => {
            btn.addEventListener('click', function() {
                // In a real application, this would open edit modal
                alert('Modal edit admin akan dibuka di sini');
            });
        });
        
        // Delete buttons
        document.querySelectorAll('.btn-action.text-red-600').forEach(btn => {
            btn.addEventListener('click', function() {
                // In a real application, this would show confirmation dialog
                if(confirm('Apakah Anda yakin ingin menghapus admin ini?')) {
                    alert('Admin akan dihapus');
                }
            });
        });
    });
</script>
@endsection
