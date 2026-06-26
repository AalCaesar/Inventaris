@extends('layouts.app')

@section('title', 'Daftar Barang')

@section('content')
<div class="max-w-7xl mx-auto w-full">

    <!-- Header & Action -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-[#334155]">Daftar Barang</h2>
            <p class="text-sm md:text-base text-[#64748b] mt-1">Kelola semua data barang inventaris Anda</p>
        </div>

        <!-- Tombol Aksi Utama (Solid Indigo) -->
        <a href="{{ route('items.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-[#6366f1] text-white text-sm font-medium rounded-[6px] transition-all duration-200 hover:bg-[#4f46e5] shadow-sm">
            <i class="fas fa-plus mr-2"></i> Tambah Barang
        </a>
    </div>

    <!-- Search & Filter Card -->
    <div class="bg-white border border-[#e2e8f0] rounded-[8px] shadow-[0_1px_3px_rgba(0,0,0,0.1)] p-6 mb-6">
        <form method="GET" action="{{ route('items.index') }}">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">

                <!-- Search Input -->
                <div class="md:col-span-5">
                    <label class="block text-sm font-medium text-[#334155] mb-1.5">Pencarian</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode atau nama barang..."
                           class="w-full border border-[#e2e8f0] rounded-[6px] px-4 py-2 text-sm text-[#334155] bg-[#f8fafc] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#6366f1]/20 focus:border-[#6366f1] transition-all">
                </div>

                <!-- Category Filter -->
                <div class="md:col-span-4">
                    <label class="block text-sm font-medium text-[#334155] mb-1.5">Filter Kategori</label>
                    <select name="category_id" class="w-full border border-[#e2e8f0] rounded-[6px] px-4 py-2 text-sm text-[#334155] bg-[#f8fafc] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#6366f1]/20 focus:border-[#6366f1] transition-all cursor-pointer">
                        <option value="">-- Semua Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Search Buttons -->
                <div class="md:col-span-3 flex items-center gap-2">
                    <button type="submit" class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-[#6366f1] text-white text-sm font-medium rounded-[6px] transition-all duration-200 hover:bg-[#4f46e5]">
                        <i class="fas fa-search mr-2"></i> Cari
                    </button>
                    <a href="{{ route('items.index') }}" title="Reset" class="inline-flex items-center justify-center px-4 py-2 bg-white border border-[#e2e8f0] text-[#64748b] text-sm font-medium rounded-[6px] transition-all duration-200 hover:bg-[#f8fafc] hover:text-[#334155]">
                        <i class="fas fa-redo"></i>
                    </a>
                </div>

            </div>
        </form>
    </div>

    <!-- Items Table Card -->
    <div class="bg-white border border-[#e2e8f0] rounded-[8px] shadow-[0_1px_3px_rgba(0,0,0,0.1)] overflow-hidden flex flex-col">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-[#e2e8f0]">
                <thead class="bg-[#f8fafc]">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-[#64748b] uppercase tracking-wider w-[5%]">No</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-[#64748b] uppercase tracking-wider w-[12%]">Kode</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-[#64748b] uppercase tracking-wider">Nama Barang</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-[#64748b] uppercase tracking-wider w-[15%]">Kategori</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-semibold text-[#64748b] uppercase tracking-wider w-[10%]">Stok</th>
                        <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-[#64748b] uppercase tracking-wider w-[15%]">Harga</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-semibold text-[#64748b] uppercase tracking-wider w-[18%]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-[#e2e8f0]">
                    @forelse($items as $index => $item)
                        <tr class="hover:bg-[#f8fafc] transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-[#64748b]">
                                {{ $items->firstItem() + $index }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="font-mono text-sm font-semibold text-[#6366f1] bg-[#6366f1]/10 px-2 py-1 rounded">{{ $item->item_code }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-[#334155]">
                                {{ $item->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#f1f5f9] text-[#475569] border border-[#e2e8f0]">
                                    {{ $item->category->name }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if($item->stock < 10)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-700 border border-amber-200">
                                        <i class="fas fa-exclamation-triangle mr-1.5"></i>{{ $item->stock }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700 border border-emerald-200">
                                        {{ $item->stock }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-[#334155] text-right">
                                {{ $item->price_formatted }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">

                                <!-- Container Tombol (flex gap-2) -->
                                <div class="flex items-center justify-center gap-2">

                                    <!-- Tombol Detail (Ghost Info) -->
                                    <a href="{{ route('items.show', $item->id) }}" title="Detail"
                                       class="inline-flex items-center justify-center p-2 text-sm font-medium text-[#0ea5e9] bg-[#0ea5e9]/10 rounded-[6px] transition-all duration-200 hover:bg-[#0ea5e9]/20">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <!-- Tombol Edit (Ghost Primary/Indigo) -->
                                    <a href="{{ route('items.edit', $item->id) }}" title="Edit"
                                       class="inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-[#6366f1] bg-[#6366f1]/10 rounded-[6px] transition-all duration-200 hover:bg-[#6366f1]/20">
                                        <i class="fas fa-edit"></i>
                                        <!-- Responsivitas Teks -->
                                        <span class="ml-1.5 hidden sm:inline-block">Edit</span>
                                    </a>

                                    <!-- Tombol Hapus (Ghost Danger/Merah Lembut) -->
                                    <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="inline-block delete-form m-0">
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
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 bg-[#f1f5f9] rounded-full flex items-center justify-center mb-4">
                                        <i class="fas fa-box-open text-2xl text-[#94a3b8]"></i>
                                    </div>
                                    <h3 class="text-base font-semibold text-[#334155]">Tidak ada data barang</h3>
                                    <p class="text-sm text-[#64748b] mt-1 mb-4">Mulai dengan menambahkan barang baru ke dalam inventaris Anda.</p>
                                    @if(request('search') || request('category_id'))
                                        <a href="{{ route('items.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-white border border-[#e2e8f0] text-[#334155] text-sm font-medium rounded-[6px] transition-all duration-200 hover:bg-[#f8fafc]">
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
        @if($items->hasPages())
            <div class="px-6 py-4 border-t border-[#e2e8f0] bg-white">
                {{ $items->appends(request()->query())->links() }}
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
                    title: 'Hapus Barang?',
                    text: "Data barang akan dihapus permanen!",
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
