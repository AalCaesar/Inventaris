@extends('layouts.app')

@section('title', 'Daftar Kategori')

@section('content')
<div class="max-w-7xl mx-auto w-full">

    <!-- Header & Action -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-[#334155]">Daftar Kategori</h2>
            <p class="text-sm text-[#64748b] mt-1">Kelola daftar klasifikasi barang inventaris Anda</p>
        </div>

        <!-- Tombol Aksi Utama (Solid Indigo) -->
        <a href="{{ route('categories.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-[#6366f1] text-white text-sm font-medium rounded-[6px] transition-all duration-200 hover:bg-[#4f46e5] shadow-sm">
            <i class="fas fa-plus mr-2"></i> Tambah Kategori
        </a>
    </div>

    <!-- Search Section -->
    <div class="bg-white border border-[#e2e8f0] rounded-[8px] shadow-[0_1px_3px_rgba(0,0,0,0.1)] p-6 mb-6">
        <form method="GET" action="{{ route('categories.index') }}">
            <div class="flex flex-col md:flex-row gap-4 items-end">

                <!-- Search Input -->
                <div class="flex-1 w-full">
                    <label class="block text-sm font-medium text-[#334155] mb-1.5">Pencarian</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama kategori..."
                           class="w-full border border-[#e2e8f0] rounded-[6px] px-4 py-2 text-sm text-[#334155] bg-[#f8fafc] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#6366f1]/20 focus:border-[#6366f1] transition-all">
                </div>

                <!-- Search Buttons -->
                <div class="flex items-center gap-2 w-full md:w-auto">
                    <button type="submit" class="flex-1 md:flex-none inline-flex items-center justify-center px-6 py-2 bg-[#6366f1] text-white text-sm font-medium rounded-[6px] transition-all duration-200 hover:bg-[#4f46e5]">
                        <i class="fas fa-search mr-2"></i> Cari
                    </button>
                    @if(request('search'))
                        <a href="{{ route('categories.index') }}" title="Reset Pencarian" class="inline-flex items-center justify-center px-4 py-2 bg-white border border-[#e2e8f0] text-[#64748b] text-sm font-medium rounded-[6px] transition-all duration-200 hover:bg-[#f8fafc] hover:text-[#334155]">
                            <i class="fas fa-redo"></i>
                        </a>
                    @endif
                </div>

            </div>
        </form>
    </div>

    <!-- Categories Table Card -->
    <div class="bg-white border border-[#e2e8f0] rounded-[8px] shadow-[0_1px_3px_rgba(0,0,0,0.1)] overflow-hidden flex flex-col">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-[#e2e8f0]">
                <thead class="bg-[#f8fafc]">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-[#64748b] uppercase tracking-wider w-[5%]">No</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-[#64748b] uppercase tracking-wider">Nama Kategori</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-semibold text-[#64748b] uppercase tracking-wider w-[20%]">Jumlah Barang</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-semibold text-[#64748b] uppercase tracking-wider w-[20%]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-[#e2e8f0]">
                    @forelse($categories as $index => $category)
                        <tr class="hover:bg-[#f8fafc] transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-[#64748b]">
                                {{ $categories->firstItem() + $index }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-[#334155]">
                                {{ $category->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-[#f1f5f9] text-[#475569] border border-[#e2e8f0]">
                                    <i class="fas fa-box mr-1.5 text-[#94a3b8]"></i>{{ $category->items_count }} Items
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">

                                <!-- Container Tombol (flex gap-2) -->
                                <div class="flex items-center justify-center gap-2">

                                    <!-- Tombol Edit (Ghost Primary/Indigo) -->
                                    <a href="{{ route('categories.edit', $category->id) }}" title="Edit"
                                       class="inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-[#6366f1] bg-[#6366f1]/10 rounded-[6px] transition-all duration-200 hover:bg-[#6366f1]/20">
                                        <i class="fas fa-edit"></i>
                                        <!-- Responsivitas Teks -->
                                        <span class="ml-1.5 hidden sm:inline-block">Edit</span>
                                    </a>

                                    <!-- Tombol Hapus (Ghost Danger/Merah Lembut) -->
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline-block delete-form m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" title="Hapus"
                                                class="delete-btn inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-[#e11d48] bg-[#e11d48]/10 rounded-[6px] transition-all duration-200 hover:bg-[#e11d48]/20">
                                            <i class="fas fa-trash"></i>
                                            <!-- Responsivitas Teks -->
                                            <span class="ml-1.5 hidden sm:inline-block">Hapus</span>
                                        </button>
                                    </form>

                                </div>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 bg-[#f1f5f9] rounded-full flex items-center justify-center mb-4">
                                        <i class="fas fa-folder-open text-2xl text-[#94a3b8]"></i>
                                    </div>
                                    <h3 class="text-base font-semibold text-[#334155]">Tidak ada data kategori</h3>
                                    <p class="text-sm text-[#64748b] mt-1 mb-4">Mulai klasifikasi dengan menambahkan kategori baru.</p>
                                    @if(request('search'))
                                        <a href="{{ route('categories.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-white border border-[#e2e8f0] text-[#334155] text-sm font-medium rounded-[6px] transition-all duration-200 hover:bg-[#f8fafc]">
                                            Reset Pencarian
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Section -->
        @if($categories->hasPages())
            <div class="px-6 py-4 border-t border-[#e2e8f0] bg-white">
                {{ $categories->appends(request()->query())->links() }}
            </div>
        @endif
    </div>

</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Delete confirmation with SweetAlert2
        const deleteButtons = document.querySelectorAll('.delete-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const form = this.closest('.delete-form');

                Swal.fire({
                    title: 'Hapus Kategori?',
                    text: "Data kategori akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e11d48',
                    cancelButtonColor: '#64748b',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    customClass: {
                        popup: 'rounded-lg',
                        confirmButton: 'rounded-md',
                        cancelButton: 'rounded-md'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endpush
