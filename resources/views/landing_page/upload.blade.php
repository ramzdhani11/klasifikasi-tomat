<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Unggah Gambar Tomat - Tomato Maturity Scan</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Tailwind CDN (Tanpa Vite) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom Tailwind Config (Optional) -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        };
    </script>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <span class="text-2xl font-bold text-red-600">MaturityScan Tomat </span>
                </div>

                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="/" class="text-gray-900 hover:text-red-600 px-3 py-2 rounded-md text-sm font-medium">Beranda</a>
                    </div>
                </div>

                <div class="md:hidden">
                    <button class="text-gray-500 hover:text-gray-700 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main -->
    <main class="flex-grow">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

            <div class="text-center mb-12">
                <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
                    Unggah Gambar Tomat Anda
                </h1>
                <p class="text-lg text-gray-600">
                    Seret dan lepas gambar tomat Anda atau klik untuk memilih file.
                </p>
            </div>

            <form action="{{ route('upload.store') }}" method="POST" enctype="multipart/form-data" class="max-w-2xl mx-auto">
                @csrf

                <!-- Error -->
                @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                    <ul class="list-disc list-inside text-red-800">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Success -->
                @if (session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4 text-green-800">
                    {{ session('success') }}
                </div>
                @endif

                <!-- Upload Box -->
                <div class="relative">
                    <div id="dropZone"
                        class="border-2 border-dashed border-gray-300 rounded-xl p-12 text-center hover:border-red-400 cursor-pointer bg-white">

                        <input type="file"
                               id="fileInput"
                               name="tomato_image"
                               accept="image/jpeg,image/jpg,image/png"
                               class="hidden"
                               required>

                        <div class="mb-6">
                            <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                        </div>

                        <h3 class="text-xl font-semibold text-gray-700 mb-2">Seret & Lepas Gambar</h3>
                        <p class="text-gray-500 mb-4">atau klik untuk mengunggah</p>
                        <p class="text-sm text-gray-400">Format JPG atau PNG</p>
                    </div>

                    <!-- Preview -->
                    <div id="filePreview" class="hidden mt-4">
                        <div class="bg-white rounded-lg p-4 shadow-sm flex items-center space-x-4">
                            <img id="previewImage" src="" class="h-20 w-20 object-cover rounded-lg">
                            <div class="flex-grow">
                                <p id="fileName" class="text-sm font-medium text-gray-900"></p>
                                <p id="fileSize" class="text-sm text-gray-500"></p>
                            </div>

                            <button type="button" id="removeFile" class="text-red-500 hover:text-red-700">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <p class="mt-8 text-center text-gray-600">
                    Pastikan gambar jelas dan tidak blur.
                </p>

                <div class="mt-8 text-center">
                    <button type="submit" id="submitBtn"
                        class="bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-8 rounded-lg shadow-lg disabled:bg-gray-400 disabled:cursor-not-allowed"
                        disabled>
                        <span id="btnText">Unggah Gambar</span>
                        <span id="btnLoading" class="hidden">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                      d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Mengunggah...
                        </span>
                    </button>
                </div>
            </form>

        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-6 mt-auto">
        <div class="max-w-7xl mx-auto text-center text-gray-400 text-sm">
            © 2026 MaturityScanTomat. All rights reserved.
        </div>
    </footer>

    <!-- JS -->
    <script>
        const dropZone = document.getElementById('dropZone');
        const fileInput = document.getElementById('fileInput');
        const filePreview = document.getElementById('filePreview');
        const previewImage = document.getElementById('previewImage');
        const fileName = document.getElementById('fileName');
        const fileSize = document.getElementById('fileSize');
        const removeFileBtn = document.getElementById('removeFile');
        const submitBtn = document.getElementById('submitBtn');
        const btnText = document.getElementById('btnText');
        const btnLoading = document.getElementById('btnLoading');

        dropZone.onclick = () => fileInput.click();

        dropZone.ondragover = e => {
            e.preventDefault();
            dropZone.classList.add('border-red-400', 'bg-red-50');
        };

        dropZone.ondragleave = e => {
            e.preventDefault();
            dropZone.classList.remove('border-red-400', 'bg-red-50');
        };

        dropZone.ondrop = e => {
            e.preventDefault();
            dropZone.classList.remove('border-red-400', 'bg-red-50');
            handleFile(e.dataTransfer.files[0]);
        };

        fileInput.onchange = e => {
            if (e.target.files.length > 0) handleFile(e.target.files[0]);
        };

        function handleFile(file) {
            const validTypes = ['image/jpeg', 'image/jpg', 'image/png'];
            if (!validTypes.includes(file.type)) {
                alert('Hanya file JPG dan PNG yang diperbolehkan.');
                return resetFile();
            }

            if (file.size > 5 * 1024 * 1024) {
                alert('Ukuran maksimal 5MB.');
                return resetFile();
            }

            const reader = new FileReader();
            reader.onload = e => {
                previewImage.src = e.target.result;
                fileName.textContent = file.name;
                fileSize.textContent = (file.size / 1024).toFixed(1) + " KB";

                dropZone.classList.add('hidden');
                filePreview.classList.remove('hidden');
                submitBtn.disabled = false;
            }
            reader.readAsDataURL(file);
        }

        removeFileBtn.onclick = () => resetFile();

        function resetFile() {
            fileInput.value = "";
            dropZone.classList.remove('hidden');
            filePreview.classList.add('hidden');
            submitBtn.disabled = true;
        }

        document.querySelector("form").onsubmit = () => {
            submitBtn.disabled = true;
            btnText.classList.add('hidden');
            btnLoading.classList.remove('hidden');
        };
    </script>

</body>
</html>
