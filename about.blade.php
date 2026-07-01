<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tentang - Klasifikasi Kematangan Tomat</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-white">
 <!-- Navbar -->
<nav class="bg-white border-b border-gray-200">
    <div class="max-w-5xl mx-auto px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center space-x-8">
                <div class="flex-shrink-0">
                    <div class="flex items-center space-x-2">
                        <svg viewBox="0 0 100 100" width="36" height="36" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="50" cy="62" r="32" fill="#e63946"/>
                            <ellipse cx="40" cy="50" rx="10" ry="7" fill="white" fill-opacity="0.25"/>
                            <path d="M50 32 Q49 24 47 16" fill="none" stroke="#2d6a4f" stroke-width="2.5" stroke-linecap="round"/>
                            <path d="M49 28 Q32 18 30 6 Q42 14 50 28" fill="#52b788"/>
                            <path d="M50 26 Q68 16 71 4 Q58 14 50 27" fill="#74c69d"/>
                            <line x1="22" y1="58" x2="78" y2="58" stroke="white" stroke-width="1.5" stroke-opacity="0.5" stroke-dasharray="5,3"/>
                            <line x1="22" y1="66" x2="78" y2="66" stroke="white" stroke-width="1" stroke-opacity="0.3" stroke-dasharray="5,3"/>
                            <path d="M24 46 L24 40 L30 40" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-opacity="0.8"/>
                            <path d="M76 46 L76 40 L70 40" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-opacity="0.8"/>
                            <path d="M24 80 L24 86 L30 86" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-opacity="0.8"/>
                            <path d="M76 80 L76 86 L70 86" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-opacity="0.8"/>
                        </svg>
                        <span class="text-xl font-bold text-red-600">Tomat<span class="text-green-700">Scan</span></span>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="hidden sm:ml-6 sm:flex sm:items-center">
                        <a href="{{ route('tomat.upload') }}" class="text-gray-900 hover:text-red-600 px-3 py-2 text-sm font-medium transition-colors">Home</a>
                        <a href="{{ route('landing.about') }}" class="text-red-600 border-b-2 border-red-600 px-3 py-2 text-sm font-medium">Tentang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

    <!-- Main Content -->
    <main class="max-w-5xl mx-auto px-6 lg:px-8">
        
        <!-- Hero Section -->
        <section class="py-24 lg:py-32">
            <div class="text-center space-y-8">
                <h1 class="text-4xl lg:text-6xl font-bold text-red-600 leading-tight">
                    Klasifikasi Tingkat Kematangan Tomat Berdasarkan Citra Digital
                </h1>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed text-justify">
                    Penelitian Tugas Akhir: "Klasifikasi Tingkat Kematangan Tomat Berdasarkan Citra Digital Menggunakan Random Forest (RF) dan Color Histogram Berbasis Website"
                </p>
                <div class="max-w-4xl mx-auto">
                    <img src="{{ asset('assets/images/banyaktomat.png') }}" 
                         alt="Tomat Klasifikasi" 
                         class="w-full h-auto rounded-2xl shadow-lg">
                </div>
            </div>
        </section>

        <!-- Section: Penelitian -->
        <section class="py-24">
            <div class="text-center space-y-8">
                <h2 class="text-3xl lg:text-4xl font-bold text-red-600">
                    Tentang Penelitian
                </h2>
                <div class="max-w-4xl mx-auto">
                    <div class="bg-white rounded-2xl shadow-lg p-12 border border-gray-100">
                        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed text-justify">
                            <p class="mb-6">
                                Website ini dikembangkan sebagai bagian dari penelitian tugas akhir yang berjudul:
                                <strong>"Klasifikasi Tingkat Kematangan Tomat Berdasarkan Citra Digital Menggunakan Random Forest (RF) dan Color Histogram Berbasis Website."</strong>
                            </p>
                            <p class="mb-6">
                                Penelitian ini bertujuan untuk membangun sistem yang mampu mengidentifikasi tingkat kematangan tomat secara otomatis melalui analisis citra digital. Sistem memanfaatkan metode ekstraksi fitur Color Histogram dan algoritma Random Forest untuk mengklasifikasikan tomat ke dalam tiga kategori:
                            </p>
                            <ul class="list-disc list-inside space-y-2 ml-4 mb-6">
                                <li><strong>Mentah</strong></li>
                                <li><strong>Setengah Matang</strong></li>
                                <li><strong>Matang</strong></li>
                            </ul>
                            <p class="mb-6">
                                Selama ini, proses penilaian kematangan tomat umumnya dilakukan secara manual melalui observasi visual. Metode tersebut bersifat subjektif, memakan waktu, dan berpotensi menimbulkan ketidakkonsistenan hasil. Oleh karena itu, sistem ini hadir sebagai solusi berbasis teknologi untuk membantu proses klasifikasi yang lebih cepat, objektif, dan akurat.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: Teknologi -->
        <section class="py-24">
            <div class="text-center space-y-8">
                <h2 class="text-3xl lg:text-4xl font-bold text-red-600">
                    Teknologi yang Digunakan
                </h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                    Sistem ini dibangun menggunakan pendekatan modern untuk hasil yang optimal
                </p>
                <div class="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                    <!-- Teknologi 1 -->
                    <div class="bg-white rounded-2xl shadow-lg p-10 border border-gray-100">
                        <div class="w-16 h-16 bg-red-100 rounded-xl flex items-center justify-center mb-6">
                            <i class="fas fa-image text-2xl text-red-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Pengolahan Citra Digital</h3>
                        <div class="text-gray-700 leading-relaxed space-y-3">
                            <p>Ekstraksi Fitur Warna Color Histogram (HSV)</p>
                            <p>Analisis karakteristik visual tomat</p>
                        </div>
                    </div>

                    <!-- Teknologi 2 -->
                    <div class="bg-white rounded-2xl shadow-lg p-10 border border-gray-100">
                        <div class="w-16 h-16 bg-blue-100 rounded-xl flex items-center justify-center mb-6">
                            <i class="fas fa-brain text-2xl text-blue-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Machine Learning</h3>
                        <div class="text-gray-700 leading-relaxed space-y-3">
                            <p>Algoritma Random Forest (RF)</p>
                            <p>Klasifikasi otomatis tingkat kematangan</p>
                        </div>
                    </div>

                    <!-- Teknologi 3 -->
                    <div class="bg-white rounded-2xl shadow-lg p-10 border border-gray-100">
                        <div class="w-16 h-16 bg-green-100 rounded-xl flex items-center justify-center mb-6">
                            <i class="fas fa-globe text-2xl text-green-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Aplikasi Web</h3>
                        <div class="text-gray-700 leading-relaxed space-y-3">
                            <p>Platform berbasis website</p>
                            <p>Mudah diakses dari berbagai perangkat</p>
                        </div>
                    </div>

                    <!-- Teknologi 4 -->
                    <div class="bg-white rounded-2xl shadow-lg p-10 border border-gray-100">
                        <div class="w-16 h-16 bg-purple-100 rounded-xl flex items-center justify-center mb-6">
                            <i class="fas fa-upload text-2xl text-purple-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Cara Penggunaan</h3>
                        <div class="text-gray-700 leading-relaxed space-y-3">
                            <p>Pengguna cukup mengunggah gambar tomat</p>
                            <p>Sistem menampilkan hasil klasifikasi otomatis</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: Tujuan dan Manfaat -->
        <section class="py-24 bg-gray-50">
            <div class="text-center space-y-8">
                <h2 class="text-3xl lg:text-4xl font-bold text-red-600">
                    Tujuan & Manfaat Sistem
                </h2>
                <div class="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                    <!-- Tujuan -->
                    <div class="bg-white rounded-2xl shadow-lg p-10 border border-gray-100">
                        <div class="w-16 h-16 bg-red-100 rounded-xl flex items-center justify-center mb-6">
                            <i class="fas fa-bullseye text-2xl text-red-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Tujuan Sistem</h3>
                        <ul class="text-gray-700 leading-relaxed space-y-3 text-left list-disc list-inside">
                            <li>Mengembangkan sistem klasifikasi kematangan tomat berbasis citra digital</li>
                            <li>Menguji performa algoritma Random Forest</li>
                            <li>Menyediakan aplikasi web yang mudah diakses pengguna</li>
                        </ul>
                    </div>

                    <!-- Manfaat -->
                    <div class="bg-white rounded-2xl shadow-lg p-10 border border-gray-100">
                        <div class="w-16 h-16 bg-green-100 rounded-xl flex items-center justify-center mb-6">
                            <i class="fas fa-leaf text-2xl text-green-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Manfaat Sistem</h3>
                        <ul class="text-gray-700 leading-relaxed space-y-3 text-left list-disc list-inside">
                            <li>Membantu proses sortir tomat secara otomatis</li>
                            <li>Mengurangi subjektivitas penilaian visual</li>
                            <li>Mendukung efisiensi pascapanen</li>
                            <li>Menjadi referensi pengembangan computer vision di bidang pertanian</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: Pengembang -->
        <section class="py-24">
            <div class="text-center space-y-8">
                <h2 class="text-3xl lg:text-4xl font-bold text-red-600">
                    Pengembang
                </h2>
                <div class="max-w-4xl mx-auto">
                    <div class="bg-white rounded-2xl shadow-lg p-12 border border-gray-100">
                        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed text-justify md:text-left">
                            <p class="mb-6">
                                Dikembangkan oleh:
                            </p>
                            <div class="text-center space-y-4">
                                <div class="text-2xl font-bold text-gray-900">
                                    Abd. Aziz Ramadloni
                                </div>
                                <p class="text-lg text-gray-600">
                                    Mahasiswa Program Studi Manajemen Informatika<br>
                                    Politeknik Negeri Jember
                                </p>
                                <p class="text-gray-500">
                                    Sebagai bagian dari penelitian Tugas Akhir
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 py-12 mt-24">
        <div class="max-w-5xl mx-auto px-6 lg:px-8">
            <div class="text-center space-y-4">
                <p class="text-sm text-gray-500">
                    © 2026 TomatScan. All rights reserved.
                </p>
            </div>
        </div>
    </footer>
</body>
</html>
