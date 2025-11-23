<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tentang Kami - MaturityScan Tomat</title>
    
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
                        <span class="text-xl font-bold text-red-600">🍅 MaturityScan</span>
                    </div>
                    <div class="hidden md:block">
                        <div class="flex items-baseline space-x-6">
                            <a href="/" class="text-gray-900 hover:text-red-600 px-3 py-2 text-sm font-medium transition-colors">Home</a>
                            <a href="/about" class="text-gray-900 hover:text-red-600 px-3 py-2 text-sm font-medium transition-colors">About</a>
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
                    Mengenal MaturityScan Tomat: Solusi Klasifikasi Kematangan Inovatif Anda
                </h1>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Platform berbasis AI yang dirancang khusus untuk membantu petani dan distributor dalam menentukan tingkat kematangan tomat secara akurat dan efisien.
                </p>
                <div class="max-w-4xl mx-auto">
                    <img src="https://images.unsplash.com/photo-1581092795360-fd1ca04f0952?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1200&q=80" 
                         alt="MaturityScan Technology" 
                         class="w-full h-auto rounded-2xl shadow-lg">
                </div>
            </div>
        </section>

        <!-- Section: Tujuan Sistem Kami -->
        <section class="py-24">
            <div class="text-center space-y-8">
                <h2 class="text-3xl lg:text-4xl font-bold text-red-600">
                    Tujuan Sistem Kami
                </h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                    Kami berkomitmen untuk menyediakan solusi teknologi yang dapat meningkatkan efisiensi dan kualitas dalam industri pertanian tomat.
                </p>
                <div class="max-w-4xl mx-auto">
                    <div class="bg-white rounded-2xl shadow-lg p-12 border border-gray-100">
                        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                            <p class="mb-6">
                                MaturityScan Tomat dikembangkan dengan tujuan utama untuk mengatasi tantangan dalam klasifikasi kematangan tomat yang selama ini dilakukan secara manual dan subjektif. Sistem kami memanfaatkan kekuatan kecerdasan buatan dan computer vision untuk memberikan hasil yang konsisten, akurat, dan dapat diandalkan.
                            </p>
                            <p class="mb-6">
                                Dengan menggunakan algoritma pembelajaran mendalam yang telah dilatih dengan ribuan gambar tomat dari berbagai tingkat kematangan, sistem kami mampu mengenali pola-pola visual yang sulit dibedakan oleh mata manusia. Ini memungkinkan klasifikasi yang lebih presisi berdasarkan karakteristik warna, tekstur, dan bentuk tomat.
                            </p>
                            <p>
                                Kami percaya bahwa teknologi ini tidak hanya akan membantu meningkatkan kualitas produk tomat yang mencapai pasar, tetapi juga akan mengurangi pemborosan akibat klasifikasi yang tidak akurat. Petani dapat memanen tomat pada waktu yang optimal, distributor dapat mengelola inventaris dengan lebih baik, dan konsumen akhir akan mendapatkan produk dengan kualitas yang konsisten.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: Teknologi di Balik Akurasi Kami -->
        <section class="py-24">
            <div class="text-center space-y-8">
                <h2 class="text-3xl lg:text-4xl font-bold text-red-600">
                    Teknologi di Balik Akurasi Kami
                </h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                    Kombinasi algoritma canggih dan arsitektur modern yang menjamin performa optimal.
                </p>
                <div class="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                    <!-- Left Card -->
                    <div class="bg-white rounded-2xl shadow-lg p-10 border border-gray-100">
                        <div class="w-16 h-16 bg-red-100 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Algoritma Klasifikasi Cerdas</h3>
                        <div class="text-gray-700 leading-relaxed space-y-3">
                            <p>
                                Sistem kami menggunakan Convolutional Neural Network (CNN) yang telah dioptimalkan khusus untuk klasifikasi gambar tomat. Algoritma ini mampu:
                            </p>
                            <ul class="list-disc list-inside space-y-2 ml-4">
                                <li>Mengenali 95+ fitur visual dari setiap gambar</li>
                                <li>Proses klasifikasi dalam waktu kurang dari 2 detik</li>
                                <li>Akurasi mencapai 98.7% pada dataset pengujian</li>
                                <li>Kemampuan pembelajaran berkelanjutan untuk meningkatkan akurasi</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Right Card -->
                    <div class="bg-white rounded-2xl shadow-lg p-10 border border-gray-100">
                        <div class="w-16 h-16 bg-blue-100 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Tumpukan Teknologi Aplikasi Web</h3>
                        <div class="text-gray-700 leading-relaxed space-y-3">
                            <p>
                                Arsitektur aplikasi kami dibangun dengan teknologi modern untuk memastikan performa dan skalabilitas:
                            </p>
                            <ul class="list-disc list-inside space-y-2 ml-4">
                                <li>Backend Laravel dengan PHP 8.2 untuk performa optimal</li>
                                <li>Frontend responsive dengan Tailwind CSS</li>
                                <li>Cloud storage untuk pengelolaan gambar yang efisien</li>
                                <li>API RESTful untuk integrasi dengan sistem lain</li>
                                <li>Database PostgreSQL untuk data yang kompleks</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: Alur Kerja Klasifikasi Sederhana -->
        <section class="py-24">
            <div class="text-center space-y-8">
                <h2 class="text-3xl lg:text-4xl font-bold text-red-600">
                    Alur Kerja Klasifikasi Sederhana
                </h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                    Empat langkah mudah untuk mendapatkan hasil klasifikasi yang akurat.
                </p>
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-6xl mx-auto">
                    <!-- Step 1 -->
                    <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100 text-center">
                        <div class="w-16 h-16 bg-green-100 rounded-xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-3">1. Unggah Gambar</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Upload foto tomat melalui interface yang user-friendly. Support format JPG dan PNG.
                        </p>
                    </div>

                    <!-- Step 2 -->
                    <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100 text-center">
                        <div class="w-16 h-16 bg-yellow-100 rounded-xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-3">2. Proses Analisis</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            AI kami menganalisis gambar secara mendalam untuk menentukan tingkat kematangan.
                        </p>
                    </div>

                    <!-- Step 3 -->
                    <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100 text-center">
                        <div class="w-16 h-16 bg-blue-100 rounded-xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-3">3. Tampilkan Hasil</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Lihat hasil klasifikasi dengan probabilitas dan rekomendasi penggunaan.
                        </p>
                    </div>

                    <!-- Step 4 -->
                    <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100 text-center">
                        <div class="w-16 h-16 bg-purple-100 rounded-xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-3">4. Iterasi & Pembelajaran</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Sistem terus belajar dari setiap klasifikasi untuk meningkatkan akurasi.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: Visi Kami untuk Masa Depan -->
        <section class="py-24">
            <div class="text-center space-y-8">
                <h2 class="text-3xl lg:text-4xl font-bold text-red-600">
                    Visi Kami untuk Masa Depan
                </h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                    Membangun ekosistem pertanian digital yang lebih cerdas dan berkelanjutan.
                </p>
                <div class="max-w-4xl mx-auto">
                    <div class="bg-white rounded-2xl shadow-lg p-12 border border-gray-100">
                        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                            <p class="mb-6">
                                Visi kami adalah menjadi pemimpin dalam teknologi klasifikasi pertanian di Asia Tenggara pada tahun 2030. Kami tidak berhenti hanya pada klasifikasi tomat, tetapi berencana untuk mengembangkan sistem yang dapat mengklasifikasikan berbagai jenis produk pertanian lainnya seperti buah-buahan, sayuran, dan biji-bijian.
                            </p>
                            <p class="mb-6">
                                Kami sedang mengembangkan fitur-fitur canggih seperti prediksi waktu panen berdasarkan data historis, rekomendasi harga pasar berdasarkan kualitas produk, dan sistem integrasi dengan marketplace pertanian. Ini akan menciptakan ekosistem lengkap dari hulu hingga hilir yang memberikan nilai tambah bagi semua pemangku kepentingan.
                            </p>
                            <p class="mb-6">
                                Dalam jangka panjang, kami berharap teknologi kami dapat berkontribusi pada ketahanan pangan global dengan mengurangi pemborosan makanan hingga 30% melalui klasifikasi yang lebih akurat dan manajemen rantai pasok yang lebih efisien. Kami juga berkomitmen untuk membuat teknologi ini mudah diakses oleh petani skala kecil melalui model harga yang terjangkau dan program pelatihan berkelanjutan.
                            </p>
                            <p>
                                Kolaborasi dengan institusi penelitian, pemerintah, dan komunitas pertanian menjadi kunci dalam mewujudkan visi ini. Bersama, kita dapat membangun masa depan pertanian yang lebih cerdas, berkelanjutan, dan menguntungkan bagi semua pihak.
                            </p>
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
                    © 2025 MaturityScan Tomat. All rights reserved.
                </p>
                <p class="text-sm text-gray-400">
                    Made with ♥ Wasily
                </p>
            </div>
        </div>
    </footer>
</body>
</html>
