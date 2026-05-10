@extends('Admin.layouts.app')

@section('title', 'Kelola Akun Admin')

@section('page-title', 'Kelola Akun Admin')

@section('content')
<!-- Page Header -->
<div class="mb-6 md:mb-8">
    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-1 md:mb-2">Kelola Akun Admin</h1>
    <p class="text-sm md:text-base text-gray-600">Kelola admin yang memiliki akses ke sistem klasifikasi tomat</p>
</div>

<!-- Add Admin Button -->
<div class="mb-4 md:mb-6">
    <button class="btn-primary px-4 md:px-6 py-2 md:py-3 bg-gradient-to-r from-red-500 to-red-600 text-white font-medium rounded-lg md:rounded-xl hover:from-red-600 hover:to-red-700 transition-all duration-300 flex items-center space-x-2 text-sm md:text-base">
        <i class="fas fa-plus text-sm md:text-base"></i>
        <span>Tambah Admin</span>
    </button>
</div>

<!-- Admin Table -->
<div class="bg-white rounded-xl md:rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm md:text-base">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nama
                    </th>
                    <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">
                        Email
                    </th>
                    <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">
                        Role
                    </th>
                    <th class="px-3 md:px-6 py-3 md:py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($admins as $admin)
                <tr class="table-row hover:bg-gray-50 transition-colors" data-id="{{ $admin->id }}">
                    <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap">
                        <div class="text-xs md:text-sm font-medium text-gray-900">{{ $admin->name }}</div>
                        <div class="text-xs {{ $admin->email_verified_at ? 'text-green-500' : 'text-gray-500' }} md:hidden">
                            {{ $admin->email_verified_at ? 'Active' : 'Inactive' }}
                        </div>
                        <div class="text-xs text-gray-500 hidden sm:block md:hidden">{{ $admin->email }}</div>
                    </td>
                    <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-xs md:text-sm text-gray-900 hidden sm:table-cell">
                        {{ $admin->email }}
                        <div class="text-xs {{ $admin->email_verified_at ? 'text-green-500' : 'text-gray-500' }}">
                            {{ $admin->email_verified_at ? 'Active' : 'Inactive' }}
                        </div>
                    </td>
                    <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap hidden md:table-cell">
                        @php
                            $roleClass = ['admin' => 'bg-blue-100 text-blue-800'];
                            $roleLabel = ['admin' => 'Admin'];
                        @endphp
                        <span class="px-2 md:px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $roleClass[$admin->role] ?? 'bg-gray-100 text-gray-800' }}">
                            {{ $roleLabel[$admin->role] ?? ucfirst($admin->role) }}
                        </span>
                    </td>
                    <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-xs md:text-sm font-medium text-center">
                        <div class="flex items-center justify-center space-x-2">
                            <button class="btn-action text-blue-600 hover:text-blue-900 transition-colors cursor-pointer hover:bg-blue-50 p-2 rounded"
                                    onclick="editAdmin({{ $admin->id }})"
                                    title="Edit Admin">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn-action text-red-600 hover:text-red-900 transition-colors cursor-pointer hover:bg-red-50 p-2 rounded"
                                    onclick="deleteAdmin({{ $admin->id }})"
                                    title="Hapus Admin">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-3 md:px-6 py-6 md:py-8 text-center text-gray-500">
                        <div class="flex flex-col items-center">
                            <i class="fas fa-users text-3xl md:text-4xl mb-2 text-gray-300"></i>
                            <span class="text-sm md:text-base">Belum ada data admin</span>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<style>
.btn-action {
    transition: all 0.2s ease;
    transform: scale(1);
}
.btn-action:hover {
    transform: scale(1.1);
}
.btn-action:active {
    transform: scale(0.95);
}
#notifBox {
    transition: all 0.3s ease;
}
@media (max-width: 640px) {
    table { font-size: 0.875rem; }
    td, th { padding: 0.75rem 0.75rem !important; }
}
</style>

<!-- Notification Modal -->
<div id="notifModal" class="fixed inset-0 bg-black bg-opacity-40 hidden z-[9999] flex items-center justify-center p-4">
    <div id="notifBox" class="bg-white rounded-2xl shadow-2xl w-full max-w-sm mx-auto transform scale-95 opacity-0">
        <div class="p-6 text-center">
            <div id="notifIconWrapper" class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <i id="notifIcon" class="fas text-3xl"></i>
            </div>
            <h3 id="notifTitle" class="text-lg font-bold text-gray-900 mb-2"></h3>
            <p id="notifMsg" class="text-sm text-gray-600 mb-6"></p>
            <button onclick="closeNotif()"
                    id="notifBtn"
                    class="w-full py-2.5 px-6 rounded-xl text-white font-semibold text-sm transition-all duration-200 hover:opacity-90">
                OK
            </button>
        </div>
    </div>
</div>

<!-- Add Admin Modal -->
<div id="adminModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg md:rounded-xl p-4 md:p-6 w-full max-w-md mx-auto max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-4">
            <h3 id="modalTitle" class="text-lg md:text-xl font-semibold text-gray-900">Tambah Admin</h3>
            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 text-lg">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <form id="adminForm">
            @csrf
            <input type="hidden" id="adminId" name="id">

            <div class="mb-3 md:mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama</label>
                <input type="text" id="name" name="name" required
                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
            </div>

            <div class="mb-3 md:mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" id="email" name="email" required
                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
            </div>

            <div class="mb-4 md:mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <input type="password" id="password" name="password"
                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                       placeholder="Kosongkan jika tidak ingin mengubah">
            </div>

            <input type="hidden" name="role" value="admin">

            <div class="flex justify-end space-x-2 md:space-x-3">
                <button type="button" onclick="closeModal()"
                        class="px-3 md:px-4 py-2 text-sm text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 transition-colors">
                    Batal
                </button>
                <button type="submit"
                        class="px-3 md:px-4 py-2 text-sm bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function showNotif(type, message) {
        const modal   = document.getElementById('notifModal');
        const box     = document.getElementById('notifBox');
        const icon    = document.getElementById('notifIcon');
        const wrapper = document.getElementById('notifIconWrapper');
        const title   = document.getElementById('notifTitle');
        const msg     = document.getElementById('notifMsg');
        const btn     = document.getElementById('notifBtn');

        if (type === 'success') {
            wrapper.className = 'w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 bg-green-100';
            icon.className    = 'fas fa-check-circle text-3xl text-green-500';
            title.textContent = 'Berhasil!';
            btn.className     = 'w-full py-2.5 px-6 rounded-xl text-white font-semibold text-sm transition-all duration-200 hover:opacity-90 bg-green-500';
        } else {
            wrapper.className = 'w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 bg-red-100';
            icon.className    = 'fas fa-times-circle text-3xl text-red-500';
            title.textContent = 'Gagal!';
            btn.className     = 'w-full py-2.5 px-6 rounded-xl text-white font-semibold text-sm transition-all duration-200 hover:opacity-90 bg-red-500';
        }

        msg.textContent = message;
        modal.classList.remove('hidden');
        setTimeout(() => {
            box.classList.remove('scale-95', 'opacity-0');
            box.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeNotif() {
        const modal = document.getElementById('notifModal');
        const box   = document.getElementById('notifBox');
        box.classList.remove('scale-100', 'opacity-100');
        box.classList.add('scale-95', 'opacity-0');
        setTimeout(() => { modal.classList.add('hidden'); }, 300);
    }

    document.addEventListener('DOMContentLoaded', function() {
        const addAdminBtn = document.querySelector('.btn-primary');
        const adminForm   = document.getElementById('adminForm');

        if (addAdminBtn) {
            addAdminBtn.addEventListener('click', function() {
                openModal();
            });
        }

        if (adminForm) {
            adminForm.addEventListener('submit', function(e) {
                saveAdmin(e);
            });
        }
    });

    function openModal(adminId = null) {
        const modal = document.getElementById('adminModal');
        const form  = document.getElementById('adminForm');
        const title = document.getElementById('modalTitle');

        form.reset();
        document.getElementById('adminId').value = adminId || '';

        if (adminId) {
            title.textContent = 'Edit Admin';
            fetch(`/admin/manage-admin/${adminId}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('name').value  = data.name;
                    document.getElementById('email').value = data.email;
                    document.getElementById('password').removeAttribute('required');
                })
                .catch(() => {
                    showNotif('error', 'Gagal memuat data admin');
                });
        } else {
            title.textContent = 'Tambah Admin';
            document.getElementById('password').setAttribute('required', 'required');
        }

        modal.classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('adminModal').classList.add('hidden');
        document.getElementById('adminForm').reset();
    }

    function saveAdmin(event) {
        event.preventDefault();
        event.stopPropagation();

        const formData  = new FormData(event.target);
        const adminId   = formData.get('id');
        const submitBtn = event.target.querySelector('button[type="submit"]');

        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i>Menyimpan...';
        submitBtn.disabled  = true;

        const url    = adminId ? `/admin/manage-admin/${adminId}` : '/admin/manage-admin';
        const method = adminId ? 'PUT' : 'POST';

        const data = Object.fromEntries(formData.entries());
        delete data.id;

        fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            if (response.status === 422) {
                return response.json().then(data => {
                    let errorMessages = '';
                    for (const field in data.errors) {
                        errorMessages += data.errors[field].join(', ') + '\n';
                    }
                    showNotif('error', errorMessages.trim());
                    return null;
                });
            }
            if (!response.ok) throw new Error('Network response was not ok');
            return response.json();
        })
        .then(data => {
            if (!data) return;
            closeModal();
            showNotif('success', data.success || 'Admin berhasil disimpan!');
            setTimeout(() => { location.reload(); }, 1500);
        })
        .catch(() => {
            showNotif('error', 'Terjadi kesalahan. Silakan coba lagi.');
        })
        .finally(() => {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled  = false;
        });
    }

    function editAdmin(id) {
        openModal(id);
    }

    function deleteAdmin(id) {
        // Tampilkan konfirmasi dengan notif modal dulu
        const modal   = document.getElementById('notifModal');
        const box     = document.getElementById('notifBox');
        const icon    = document.getElementById('notifIcon');
        const wrapper = document.getElementById('notifIconWrapper');
        const title   = document.getElementById('notifTitle');
        const msg     = document.getElementById('notifMsg');
        const btn     = document.getElementById('notifBtn');

        wrapper.className = 'w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 bg-yellow-100';
        icon.className    = 'fas fa-exclamation-triangle text-3xl text-yellow-500';
        title.textContent = 'Konfirmasi Hapus';
        msg.textContent   = 'Apakah Anda yakin ingin menghapus admin ini? Tindakan ini tidak dapat dibatalkan.';
        btn.className     = 'w-full py-2.5 px-6 rounded-xl text-white font-semibold text-sm transition-all duration-200 hover:opacity-90 bg-yellow-500';
        btn.textContent   = 'Ya, Hapus';

        modal.classList.remove('hidden');
        setTimeout(() => {
            box.classList.remove('scale-95', 'opacity-0');
            box.classList.add('scale-100', 'opacity-100');
        }, 10);

        // Override tombol OK untuk konfirmasi hapus
        btn.onclick = function() {
            closeNotif();
            btn.textContent = 'OK';
            btn.onclick = closeNotif;

            fetch(`/admin/manage-admin/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    showNotif('error', data.error);
                } else {
                    showNotif('success', data.success || 'Admin berhasil dihapus!');
                    setTimeout(() => { location.reload(); }, 1500);
                }
            })
            .catch(() => {
                showNotif('error', 'Terjadi kesalahan. Silakan coba lagi.');
            });
        };
    }
</script>
@endsection