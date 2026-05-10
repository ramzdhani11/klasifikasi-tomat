<!-- Sidebar Component -->
<aside class="w-full bg-white h-full flex flex-col">
    <!-- Logo Section -->
    <div class="p-4 md:p-6 border-b border-gray-200">
        <div class="flex items-center space-x-2 md:space-x-3">
            <div class="w-8 h-8 md:w-10 md:h-10 flex items-center justify-center flex-shrink-0">
                <svg viewBox="0 0 100 100" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                    <!-- Tomato body -->
                    <circle cx="50" cy="62" r="32" fill="#e63946"/>
                    <!-- Shine -->
                    <ellipse cx="40" cy="50" rx="10" ry="7" fill="white" fill-opacity="0.25"/>
                    <!-- Stem -->
                    <path d="M50 32 Q49 24 47 16" fill="none" stroke="#2d6a4f" stroke-width="2.5" stroke-linecap="round"/>
                    <!-- Leaf left -->
                    <path d="M49 28 Q32 18 30 6 Q42 14 50 28" fill="#52b788"/>
                    <!-- Leaf right -->
                    <path d="M50 26 Q68 16 71 4 Q58 14 50 27" fill="#74c69d"/>
                    <!-- Scan lines -->
                    <line x1="22" y1="58" x2="78" y2="58" stroke="white" stroke-width="1.5" stroke-opacity="0.5" stroke-dasharray="5,3"/>
                    <line x1="22" y1="66" x2="78" y2="66" stroke="white" stroke-width="1" stroke-opacity="0.3" stroke-dasharray="5,3"/>
                    <!-- Brackets -->
                    <path d="M24 46 L24 40 L30 40" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-opacity="0.8"/>
                    <path d="M76 46 L76 40 L70 40" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-opacity="0.8"/>
                    <path d="M24 80 L24 86 L30 86" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-opacity="0.8"/>
                    <path d="M76 80 L76 86 L70 86" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-opacity="0.8"/>
                </svg>
            </div>
            <h1 class="text-lg md:text-xl font-bold text-gray-800">Tomat<span class="text-green-700">Scan</span></h1>
        </div>
    </div>
    
    <!-- Navigation Menu -->
    <nav class="flex-1 p-2 md:p-4 space-y-1 md:space-y-2 overflow-y-auto">
        <a href="{{ route('admin.dashboard') }}" 
           class="sidebar-link flex items-center space-x-3 px-3 md:px-4 py-2 md:py-3 rounded-lg text-sm md:text-base text-gray-700 hover:bg-gray-50 transition-all {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" onclick="document.getElementById('sidebar-wrapper').classList.add('-translate-x-full'); document.getElementById('sidebar-overlay').classList.add('hidden');">
            <i class="fas fa-home w-5 flex-shrink-0"></i>
            <span class="truncate">Dashboard</span>
        </a>
        
        <a href="{{ route('admin.manage-admin') }}" 
           class="sidebar-link flex items-center space-x-3 px-3 md:px-4 py-2 md:py-3 rounded-lg text-sm md:text-base text-gray-700 hover:bg-gray-50 transition-all {{ request()->routeIs('admin.manage-admin') ? 'active' : '' }}" onclick="document.getElementById('sidebar-wrapper').classList.add('-translate-x-full'); document.getElementById('sidebar-overlay').classList.add('hidden');">
            <i class="fas fa-users w-5 flex-shrink-0"></i>
            <span class="truncate">Kelola Akun Admin</span>
        </a>
        
        <a href="{{ route('admin.classification-history') }}" 
           class="sidebar-link flex items-center space-x-3 px-3 md:px-4 py-2 md:py-3 rounded-lg text-sm md:text-base text-gray-700 hover:bg-gray-50 transition-all {{ request()->routeIs('admin.classification-history') ? 'active' : '' }}" onclick="document.getElementById('sidebar-wrapper').classList.add('-translate-x-full'); document.getElementById('sidebar-overlay').classList.add('hidden');">
            <i class="fas fa-history w-5 flex-shrink-0"></i>
            <span class="truncate">Riwayat Klasifikasi</span>
        </a>
        
        <a href="{{ route('admin.system-statistics') }}" 
           class="sidebar-link flex items-center space-x-3 px-3 md:px-4 py-2 md:py-3 rounded-lg text-sm md:text-base text-gray-700 hover:bg-gray-50 transition-all {{ request()->routeIs('admin.system-statistics') ? 'active' : '' }}" onclick="document.getElementById('sidebar-wrapper').classList.add('-translate-x-full'); document.getElementById('sidebar-overlay').classList.add('hidden');">
            <i class="fas fa-chart-bar w-5 flex-shrink-0"></i>
            <span class="truncate">Statistik Sistem</span>
        </a>
    </nav>
    
    <!-- User Profile Section -->
    <div class="p-2 md:p-4 border-t border-gray-200">
        <div class="flex items-center space-x-2 md:space-x-3 px-3 md:px-4 py-2 md:py-3">
            <div class="w-8 h-8 bg-gradient-to-br from-red-400 to-pink-400 rounded-full flex items-center justify-center flex-shrink-0">
                <i class="fas fa-user text-white text-xs md:text-sm"></i>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-xs md:text-sm font-medium text-gray-900 truncate">{{ session('admin_name', 'Admin') }}</p>
                <p class="text-xs text-gray-500 truncate">Administrator</p>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <div class="p-2 md:p-4 text-center text-xs text-gray-500 border-t border-gray-200">
        Made with <span class="text-red-500">❤️</span> by TomatScan 
    </div>
</aside>

<style>
    .sidebar-item {
        transition: all 0.3s ease;
    }
    
    .sidebar-item:hover {
        transform: translateX(5px);
    }
    
    .sidebar-item.active {
        background: linear-gradient(90deg, #fee2e2 0%, #fef2f2 100%);
        border-left: 4px solid #ef4444;
        color: #ef4444;
        font-weight: 500;
    }
</style>
