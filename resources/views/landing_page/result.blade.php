<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hasil Klasifikasi - Maturity Scan Tomat</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Navbar -->
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <span class="text-2xl font-bold text-red-600">MaturityScan Tomat</span>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="/" class="text-gray-900 hover:text-red-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">Home</a>
                        <a href="#" class="text-gray-500 hover:text-red-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">About</a>
                    </div>
                </div>
                <div class="md:hidden">
                    <button class="text-gray-500 hover:text-gray-700 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <!-- Result Card -->
            <div class="bg-white rounded-2xl shadow-lg p-8 lg:p-12">
                <!-- Title -->
                <div class="text-center mb-8">
                    <h1 class="text-3xl lg:text-4xl font-bold text-gray-900">
                        Hasil Klasifikasi Tomat
                    </h1>
                </div>

                <!-- Image Display -->
                @if($imagePath)
                <div class="mb-8">
                    <img src="{{ asset('storage/' . $imagePath) }}" 
                         alt="Tomato Image" 
                         class="w-full h-auto rounded-2xl shadow-md object-cover"
                         style="max-height: 400px; object-position: center;">
                </div>
                @endif

                <!-- Classification Results -->
                <div class="space-y-6">
                    <!-- Maturity Level -->
                    <div class="flex items-center justify-between">
                        <span class="text-lg font-semibold text-gray-700">Kematangan:</span>
                        <span class="px-4 py-2 rounded-full text-white font-bold text-sm {{ $maturityColor }}">
                            {{ ucfirst($category) }}
                        </span>
                    </div>

                    <!-- Probability -->
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-lg font-semibold text-gray-700">Probabilitas:</span>
                            <span class="text-lg font-bold text-gray-900">{{ $probability }}%</span>
                        </div>
                        
                        <!-- Progress Bar -->
                        <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                            <div class="h-full rounded-full transition-all duration-500 ease-out {{ $progressColor }}" 
                                 style="width: {{ $probability }}%">
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="bg-gray-50 rounded-xl p-6">
                        <p class="text-gray-700 leading-relaxed">
                            {{ $description }}
                        </p>
                    </div>
                </div>

                <!-- Action Button -->
                <div class="mt-8 text-center">
                    <a href="{{ route('upload') }}" 
                       class="inline-flex items-center bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-8 rounded-lg shadow-lg transition-all duration-200 transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                        Unggah Gambar Lagi
                    </a>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-6 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p class="text-gray-400 text-sm">
                    © 2026 MaturityScanTomat. All rights reserved.
                </p>
            </div>
        </div>
    </footer>
</body>
</html>
