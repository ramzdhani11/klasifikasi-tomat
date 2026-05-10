@extends('Admin.layouts.app')

@section('title', 'Riwayat Klasifikasi')
@section('page-title', 'Riwayat Klasifikasi')

@section('content')
<div class="mb-6 md:mb-8">
    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-1 md:mb-2">Riwayat Klasifikasi</h1>
    <p class="text-sm md:text-base text-gray-600">Lihat semua riwayat klasifikasi tomat yang telah dilakukan</p>
</div>

<!-- Search and Filter -->
<form method="GET" action="{{ route('admin.classification-history') }}">
<div class="flex flex-col gap-3 md:gap-4 md:flex-row md:items-center md:justify-between mb-4 md:mb-6">
    <div class="relative flex-1 md:max-w-md">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i class="fas fa-search text-gray-400 text-sm md:text-base"></i>
        </div>
        <input type="text" name="search" value="{{ request('search') }}"
               placeholder="Cari riwayat…" 
               class="w-full pl-10 pr-4 py-2 md:py-3 text-sm md:text-base border border-gray-300 rounded-lg md:rounded-xl focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all">
    </div>
    
    <div class="flex flex-wrap gap-1 md:gap-2">
        <a href="{{ route('admin.classification-history') }}" 
           class="px-3 md:px-4 py-2 rounded-full border text-xs md:text-sm font-medium transition-all {{ !request('filter') ? 'bg-red-500 text-white border-red-500' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50' }}">
            Semua
        </a>
        <a href="{{ route('admin.classification-history', ['filter' => 'mentah']) }}" 
           class="px-3 md:px-4 py-2 rounded-full border text-xs md:text-sm font-medium transition-all {{ request('filter') == 'mentah' ? 'bg-red-500 text-white border-red-500' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50' }}">
            Mentah
        </a>
        <a href="{{ route('admin.classification-history', ['filter' => 'setengah_matang']) }}" 
           class="px-3 md:px-4 py-2 rounded-full border text-xs md:text-sm font-medium transition-all {{ request('filter') == 'setengah_matang' ? 'bg-red-500 text-white border-red-500' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50' }}">
            <span class="hidden sm:inline">Setengah Matang</span><span class="sm:hidden">Setengah</span>
        </a>
        <a href="{{ route('admin.classification-history', ['filter' => 'matang']) }}" 
           class="px-3 md:px-4 py-2 rounded-full border text-xs md:text-sm font-medium transition-all {{ request('filter') == 'matang' ? 'bg-red-500 text-white border-red-500' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50' }}">
            Matang
        </a>
        <button type="submit"
                class="px-3 md:px-4 py-2 rounded-full border text-xs md:text-sm font-medium bg-gray-800 text-white border-gray-800 hover:bg-gray-700 transition-all">
            <i class="fas fa-search mr-1"></i><span class="hidden sm:inline">Cari</span>
        </button>
    </div>
</div>
</form>

<!-- Table Container - Responsive -->
<div class="bg-white rounded-xl md:rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm md:text-base">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
                    <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Klasifikasi</th>
                    <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Skor</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($uploads as $index => $upload)
                <tr class="hover:bg-gray-50 transition-colors">
                    <!-- No Urut -->
                    <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-xs md:text-sm text-gray-500">
                        {{ ($uploads->currentPage() - 1) * $uploads->perPage() + $index + 1 }}
                    </td>

                    <!-- Gambar -->
                    <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap">
                        <img src="{{ asset('storage/' . $upload->image_path) }}" 
                             alt="Tomato" 
                             class="w-8 h-8 md:w-12 md:h-12 rounded-lg object-cover border-2 border-gray-200">
                    </td>

                    <!-- Tanggal -->
                    <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-xs md:text-sm text-gray-900">
                        <span class="hidden md:inline">{{ $upload->created_at->format('d M Y, H:i') }}</span>
                        <span class="md:hidden">{{ $upload->created_at->format('d M Y') }}</span>
                    </td>

                    <!-- Klasifikasi -->
                    <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap">
                        @php
                            $badgeClass = match($upload->category) {
                                'matang'          => 'bg-pink-100 text-pink-800',
                                'mentah'          => 'bg-green-100 text-green-800',
                                'setengah_matang' => 'bg-yellow-100 text-yellow-800',
                                default           => 'bg-gray-100 text-gray-800'
                            };
                        @endphp
                        <span class="px-2 md:px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $badgeClass }}">
                            {{ str_replace('_', ' ', $upload->category) }}
                        </span>
                    </td>

                    <!-- Confidence -->
                    <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-xs md:text-sm text-gray-900">
                        <div class="flex items-center gap-1 md:gap-2">
                            <span class="w-10 md:w-14 font-medium">{{ $upload->confidence }}%</span>
                            <div class="w-16 md:w-24 bg-gray-200 rounded-full h-2">
                                <div class="h-2 rounded-full {{ $upload->confidence >= 80 ? 'bg-green-500' : ($upload->confidence >= 60 ? 'bg-yellow-500' : 'bg-red-400') }}" 
                                     style="width: {{ min($upload->confidence, 100) }}%"></div>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-3 md:px-6 py-6 md:py-8 text-center text-gray-500">
                        <i class="fas fa-inbox text-3xl md:text-4xl mb-2 text-gray-300 block"></i>
                        <p class="text-sm md:text-base">Belum ada data klasifikasi</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
        <div class="flex items-center justify-between">
            <div class="text-sm text-gray-700">
                Menampilkan <span class="font-medium">{{ $uploads->firstItem() ?? 0 }}</span> 
                hingga <span class="font-medium">{{ $uploads->lastItem() ?? 0 }}</span> 
                dari <span class="font-medium">{{ $uploads->total() }}</span> hasil
            </div>

            <div class="flex items-center space-x-1">
                {{-- Prev --}}
                @if ($uploads->onFirstPage())
                    <span class="px-3 py-2 text-sm text-gray-400 bg-white border border-gray-300 rounded-lg cursor-not-allowed">
                        <i class="fas fa-chevron-left"></i>
                    </span>
                @else
                    <a href="{{ $uploads->previousPageUrl() }}" 
                       class="px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                @endif

                {{-- Page Numbers --}}
                @foreach ($uploads->getUrlRange(1, $uploads->lastPage()) as $page => $url)
                    @if ($page == $uploads->currentPage())
                        <span class="px-3 py-2 text-sm font-medium text-white bg-red-500 border border-red-500 rounded-lg">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}" 
                           class="px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach

                {{-- Next --}}
                @if ($uploads->hasMorePages())
                    <a href="{{ $uploads->nextPageUrl() }}" 
                       class="px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                @else
                    <span class="px-3 py-2 text-sm text-gray-400 bg-white border border-gray-300 rounded-lg cursor-not-allowed">
                        <i class="fas fa-chevron-right"></i>
                    </span>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Filter button functionality
    document.querySelectorAll('.filter-btn').forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('active');
                btn.classList.add('bg-white', 'text-gray-700');
            });
            
            // Add active class to clicked button
            this.classList.add('active');
            this.classList.remove('bg-white', 'text-gray-700');
            
            // Filter table rows
            const filter = this.dataset.filter;
            const rows = document.querySelectorAll('.table-row');
            
            rows.forEach(row => {
                if (filter === 'all' || row.dataset.classification === filter) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
    
    // Pagination functionality
    document.querySelectorAll('.pagination-btn').forEach(button => {
        button.addEventListener('click', function() {
            // Only handle number buttons
            if (!this.innerHTML.includes('fa-chevron')) {
                // Remove active class from all pagination buttons
                document.querySelectorAll('.pagination-btn').forEach(btn => {
                    btn.classList.remove('active');
                    btn.classList.add('bg-white', 'text-gray-700');
                });
                
                // Add active class to clicked button
                this.classList.add('active');
                this.classList.remove('bg-white', 'text-gray-700');
            }
        });
    });
    
    // Search functionality
    const searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('.table-row');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            if (text.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
@endsection
