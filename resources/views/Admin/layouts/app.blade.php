<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - ML System</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts - Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Chart.js (only load on pages that need it) -->
    @if(request()->routeIs('admin.dashboard') || request()->routeIs('admin.system-statistics'))
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @endif
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
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
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        @include('Admin.partials.sidebar')
        
        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-10">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex-1">
                        <!-- Page Title (Mobile) -->
                        <h1 class="text-lg font-semibold text-gray-900 md:hidden">@yield('page-title')</h1>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <button class="relative p-2 text-gray-600 hover:text-gray-900 transition-colors">
                            <i class="fas fa-bell text-xl"></i>
                            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>
                        
                        <div class="flex items-center space-x-3">
                            <div class="text-right hidden md:block">
                                <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name ?? 'Admin User' }}</p>
                                <p class="text-xs text-gray-500">Administrator</p>
                            </div>
                            <div class="w-10 h-10 bg-gradient-to-br from-red-400 to-pink-400 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-white text-sm"></i>
                            </div>
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
        // Common functionality for all pages
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize tooltips and other common UI elements
            console.log('Admin Dashboard loaded');
        });
    </script>
    
    @yield('scripts')
</body>
</html>
