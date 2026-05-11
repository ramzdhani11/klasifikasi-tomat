<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - ML System</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Preconnect ke CDN untuk lebih cepat -->
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- DNS Prefetch untuk domain eksternal -->
    <link rel="dns-prefetch" href="https://cdn.tailwindcss.com">
    
    <!-- Google Fonts - Inter dengan font-display: swap (non-blocking) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    <noscript><link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"></noscript>
    
    <!-- Font Awesome dengan async loading -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" media="print" onload="this.media='all'">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Chart.js (tanpa defer agar library siap sebelum scripts lain) -->
    @if(request()->routeIs('admin.dashboard') || request()->routeIs('admin.system-statistics'))
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    @endif
    
    <!-- Anti-flash dark mode script -->
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>
    
    <style>
        /* Performance optimization: Use system fonts for faster render */
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }
        
        /* Skeleton Loading Animation - untuk loading state */
        @keyframes skeleton-loading {
            0% {
                background-color: hsl(200, 20%, 80%);
            }
            100% {
                background-color: hsl(200, 20%, 95%);
            }
        }
        
        .skeleton {
            animation: skeleton-loading 1s linear infinite alternate;
        }
        
        /* Image lazy loading - prevent layout shift */
        img {
            display: block;
            max-width: 100%;
            height: auto;
        }
        
        /* Reduce paint/reflow for better performance */
        .stat-card {
            will-change: transform;
            contain: layout style paint;
        }
        
        .chart-card {
            contain: layout style paint;
        }
        
        /* GPU acceleration untuk smooth animations */
        #sidebar-wrapper {
            transform: translate3d(0, 0, 0);
            backface-visibility: hidden;
        }
        
        /* Dark Mode Styles */
        .dark {
            background-color: #1a1a1a;
            color: #e5e5e5;
        }
        
        .dark .bg-white {
            background-color: #2d2d2d !important;
        }
        
        .dark .bg-gray-50 {
            background-color: #1f1f1f !important;
        }
        
        .dark .bg-gray-100 {
            background-color: #2d2d2d !important;
        }
        
        .dark .text-gray-900 {
            color: #e5e5e5 !important;
        }
        
        .dark .text-gray-800 {
            color: #d4d4d4 !important;
        }
        
        .dark .text-gray-700 {
            color: #b3b3b3 !important;
        }
        
        .dark .text-gray-600 {
            color: #999999 !important;
        }
        
        .dark .text-gray-500 {
            color: #808080 !important;
        }
        
        .dark .border-gray-200 {
            border-color: #404040 !important;
        }
        
        .dark .border-gray-300 {
            border-color: #404040 !important;
        }
        
        .dark .hover\:bg-gray-50:hover {
            background-color: #2d2d2d !important;
        }
        
        .dark .hover\:bg-gray-100:hover {
            background-color: #3d3d3d !important;
        }
        
        .dark .hover\:bg-blue-50:hover {
            background-color: #1e3a5f !important;
        }
        
        .dark .hover\:bg-orange-50:hover {
            background-color: #5c3d1e !important;
        }
        
        .dark .hover\:bg-red-50:hover {
            background-color: #5c1e1e !important;
        }
        
        .dark .divide-gray-200 > :not([hidden]) ~ :not([hidden]) {
            border-color: #404040 !important;
        }
        
        .dark .shadow-sm {
            box-shadow: 0 1px 2px 0 rgba(255, 255, 255, 0.05) !important;
        }
        
        .dark .bg-gradient-to-r {
            background-image: none !important;
        }
        
        .dark .btn-primary {
            background-color: #dc2626 !important;
        }
        
        .dark .btn-primary:hover {
            background-color: #b91c1c !important;
        }
        
        /* Modal Dark Mode */
        .dark .fixed.inset-0 {
            background-color: rgba(0, 0, 0, 0.8) !important;
        }
        
        .dark .fixed.inset-0 > .bg-white {
            background-color: #2d2d2d !important;
            color: #e5e5e5 !important;
        }
        
        .dark .text-gray-700 {
            color: #b3b3b3 !important;
        }
        
        /* Form elements dark mode */
        .dark input, .dark select, .dark textarea {
            background-color: #3d3d3d !important;
            border-color: #404040 !important;
            color: #e5e5e5 !important;
        }
        
        .dark input:focus, .dark select:focus, .dark textarea:focus {
            border-color: #dc2626 !important;
        }
        
        /* Sidebar dark mode */
        .dark .bg-gradient-to-b {
            background-image: none !important;
            background-color: #1f1f1f !important;
        }
        
        .dark .sidebar-link {
            color: #b3b3b3 !important;
        }
        
        .dark .sidebar-link:hover {
            color: #e5e5e5 !important;
            background-color: #2d2d2d !important;
        }
        
        .dark .sidebar-link.active {
            color: #ffffff !important;
            background-color: #dc2626 !important;
        }
        
        .sidebar-link.active {
            background-color: #dc2626 !important;
            color: white !important;
        }
        
        .sidebar-link:hover {
            background-color: #f3f4f6 !important;
        }
        
        /* Admin card dark mode */
        .dark .hover\:bg-gray-50:hover {
            background-color: #2d2d2d !important;
        }
        
        .dark .border-t.border-gray-100 {
            border-color: #404040 !important;
        }
        
        .stat-card {
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .chart-container {
            position: relative;
            height: 300px;
        }
        
        .chart-card {
            transition: all 0.3s ease;
        }
        
        .chart-card:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .table-row:hover {
            background-color: #fafafa;
            transition: background-color 0.2s ease;
        }
        
        .filter-btn {
            transition: all 0.3s ease;
        }
        
        .filter-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.15);
        }
        
        .filter-btn.active {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }
        
        .pagination-btn {
            transition: all 0.2s ease;
        }
        
        .pagination-btn:hover:not(.active) {
            background-color: #fee2e2;
            color: #ef4444;
        }
        
        .pagination-btn.active {
            background-color: #ef4444;
            color: white;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(239, 68, 68, 0.3);
        }
        
        .btn-secondary {
            transition: all 0.3s ease;
        }
        
        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        /* ===== SIDEBAR RESPONSIVE ===== */
        #sidebar-wrapper {
            position: fixed !important;
            top: 0;
            left: 0;
            width: 260px;
            height: 100% !important;
            z-index: 50;
            transform: translateX(-100%) !important;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            overflow-y: auto;
            will-change: transform;
            background: #fff;
        }
        #sidebar-wrapper.is-open {
            transform: translateX(0) !important;
            box-shadow: 4px 0 24px rgba(0,0,0,0.18);
        }
        @media (min-width: 768px) {
            #sidebar-wrapper {
                position: relative !important;
                width: 256px !important;
                height: auto !important;
                transform: translateX(0) !important;
                box-shadow: none !important;
                transition: none !important;
                z-index: auto !important;
                flex-shrink: 0;
            }
        }
        #sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 45;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        #sidebar-overlay.is-active {
            display: block;
            opacity: 1;
        }
        @media (min-width: 768px) {
            #sidebar-overlay { display: none !important; }
        }
        .main-content-area {
            min-width: 0;
            flex: 1;
            overflow: auto;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar - Fixed on Desktop, Toggleable on Mobile -->
        <div id="sidebar-wrapper" class="bg-white border-r border-gray-200">
            @include('Admin.partials.sidebar')
        </div>
        
        <!-- Mobile Overlay (Hidden by default) -->
        <div id="sidebar-overlay"></div>
        
        <!-- Main Content -->
        <div class="main-content-area">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-10">
                <div class="flex items-center justify-between px-4 md:px-6 py-3 md:py-4">
                    <div class="flex items-center flex-1">
                        <!-- Mobile Menu Toggle -->
                        <button id="menuToggle" 
                                class="md:hidden flex items-center justify-center"
                                style="min-width:44px; min-height:44px; background:transparent; border:none; cursor:pointer; margin-right:0.5rem;"
                                aria-label="Buka menu"
                                aria-expanded="false">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" 
                                 xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <rect y="4"  width="24" height="2.5" rx="1.25" fill="#374151"/>
                                <rect y="11" width="24" height="2.5" rx="1.25" fill="#374151"/>
                                <rect y="18" width="24" height="2.5" rx="1.25" fill="#374151"/>
                            </svg>
                        </button>
                        <!-- Page Title (Mobile) -->
                        <h1 class="text-base md:text-lg font-semibold text-gray-900">@yield('page-title')</h1>
                    </div>
                    
                    <div class="flex items-center space-x-2 md:space-x-4">
                        <!-- Dark Mode Toggle -->
                        <button id="darkModeToggle" class="relative p-2 text-gray-600 hover:text-gray-900 transition-colors" title="Toggle Dark Mode">
                            <i class="fas fa-moon text-lg md:text-xl" id="darkModeIcon"></i>
                        </button>
                        
                        <div class="flex items-center space-x-2 md:space-x-3">
                            <a href="{{ route('admin.logout') }}" class="sidebar-item flex items-center space-x-1 md:space-x-3 px-2 md:px-4 py-2 md:py-3 rounded-lg text-red-600 hover:bg-red-50 transition-all text-sm md:text-base">
                                <i class="fas fa-sign-out-alt w-5"></i>
                                <span class="hidden sm:inline">Logout</span>
                            </a>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Page Content -->
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>
    
    <!-- Common JavaScript -->
    <script>
        // Service Worker Registration untuk caching dan offline support
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                // Register service worker async agar tidak block rendering
                navigator.serviceWorker.register('/sw.js', { scope: '/admin/' }).catch(err => {
                    // Silent fail - optional caching, tidak blocking
                    console.log('Service Worker registration failed:', err);
                });
            });
        }
        
        // Performance Monitoring untuk tracking page load speed
        window.addEventListener('load', function() {
            // Log performance metrics untuk device lemot
            if (window.performance && window.performance.timing) {
                const perfData = window.performance.timing;
                const pageLoadTime = perfData.loadEventEnd - perfData.navigationStart;
                const connectTime = perfData.responseEnd - perfData.requestStart;
                const renderTime = perfData.domComplete - perfData.domLoading;
                
                console.log('📊 Performance Metrics:');
                console.log('- Page Load:', pageLoadTime + 'ms');
                console.log('- Connect Time:', connectTime + 'ms');
                console.log('- Render Time:', renderTime + 'ms');
            }
        });
        
        // Lazy load images dengan Intersection Observer
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        if (img.dataset.src) {
                            img.src = img.dataset.src;
                            img.removeAttribute('data-src');
                            imageObserver.unobserve(img);
                        }
                    }
                });
            }, {
                rootMargin: '50px'
            });
            
            // Observe all lazy images
            document.querySelectorAll('img[data-src]').forEach(img => {
                imageObserver.observe(img);
            });
        }
        
        // Hamburger Menu Toggle untuk Mobile
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menuToggle');
            const sidebarWrapper = document.getElementById('sidebar-wrapper');
            const sidebarOverlay = document.getElementById('sidebar-overlay');

            function openSidebar() {
                sidebarWrapper.classList.add('is-open');
                sidebarOverlay.classList.add('is-active');
                document.body.style.overflow = 'hidden';
                if (menuToggle) menuToggle.setAttribute('aria-expanded', 'true');
            }

            function closeSidebar() {
                sidebarWrapper.classList.remove('is-open');
                sidebarOverlay.classList.remove('is-active');
                document.body.style.overflow = '';
                if (menuToggle) menuToggle.setAttribute('aria-expanded', 'false');
            }

            if (menuToggle) {
                menuToggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    sidebarWrapper.classList.contains('is-open') ? closeSidebar() : openSidebar();
                });
            }

            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', closeSidebar);
            }

            document.querySelectorAll('#sidebar-wrapper .sidebar-link, #sidebar-wrapper a').forEach(function(link) {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 768) closeSidebar();
                });
            });

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') closeSidebar();
            });

            let resizeTimer;
            window.addEventListener('resize', function() {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(function() {
                    if (window.innerWidth >= 768) {
                        sidebarWrapper.classList.remove('is-open');
                        sidebarOverlay.classList.remove('is-active');
                        document.body.style.overflow = '';
                    }
                }, 200);
            });
        });
        
        // Dark Mode Toggle
        document.addEventListener('DOMContentLoaded', function() {
            const darkModeToggle = document.getElementById('darkModeToggle');
            const darkModeIcon = document.getElementById('darkModeIcon');
            const html = document.documentElement;
            
            // Check for saved theme preference or default to light mode
            const currentTheme = localStorage.getItem('theme') || 'light';
            if (currentTheme === 'dark') {
                html.classList.add('dark');
                darkModeIcon.classList.remove('fa-moon');
                darkModeIcon.classList.add('fa-sun');
            }
            
            // Toggle dark mode
            darkModeToggle.addEventListener('click', function() {
                const isDark = html.classList.contains('dark');
                
                if (isDark) {
                    html.classList.remove('dark');
                    darkModeIcon.classList.remove('fa-sun');
                    darkModeIcon.classList.add('fa-moon');
                    localStorage.setItem('theme', 'light');
                } else {
                    html.classList.add('dark');
                    darkModeIcon.classList.remove('fa-moon');
                    darkModeIcon.classList.add('fa-sun');
                    localStorage.setItem('theme', 'dark');
                }
                
                // Update chart colors if charts exist
                if (window.updateChartTheme) {
                    updateChartTheme(!isDark);
                }
            });
            
            // Initialize tooltips and other common UI elements
            console.log('Admin Dashboard loaded - Responsive mode active');
            console.log('Viewport width:', window.innerWidth, 'px');
        });
    </script>
    
    @yield('scripts')
</body>
</html>
