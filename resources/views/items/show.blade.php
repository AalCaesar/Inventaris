@extends('layouts.app')

@section('title', 'Detail Barang')

@section('content')
<div class="max-w-3xl mx-auto w-full pb-10">

    <!-- Header & Action -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-[#334155]">Detail Barang</h2>
            <p class="text-sm text-[#64748b] mt-1">Informasi lengkap tentang item inventaris</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('items.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-white border border-[#e2e8f0] text-[#64748b] text-sm font-medium rounded-[6px] transition-all duration-200 hover:bg-[#f8fafc] hover:text-[#334155] shadow-sm">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
            <a href="{{ route('items.edit', $item->id) }}" class="inline-flex items-center justify-center px-4 py-2 bg-[#6366f1] text-white text-sm font-medium rounded-[6px] transition-all duration-200 hover:bg-[#4f46e5] shadow-sm">
                <i class="fas fa-edit mr-2"></i> Edit
            </a>
        </div>
    </div>

    <!-- Main Detail Card -->
    <div class="bg-white border border-[#e2e8f0] rounded-[8px] shadow-[0_1px_3px_rgba(0,0,0,0.1)] overflow-hidden">

        <!-- Info Grid -->
        <div class="p-0">
            <!-- Kode Barang -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 border-b border-[#f1f5f9] p-6 sm:px-8">
                <div class="text-sm font-semibold text-[#64748b] md:mt-1">Kode Barang</div>
                <div class="md:col-span-2">
                    <span class="inline-flex items-center px-3 py-1 rounded-[6px] text-sm font-mono font-medium bg-[#f1f5f9] text-[#334155] border border-[#e2e8f0]">
                        {{ $item->item_code }}
                    </span>
                </div>
            </div>

            <!-- Nama Barang -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 border-b border-[#f1f5f9] p-6 sm:px-8">
                <div class="text-sm font-semibold text-[#64748b]">Nama Barang</div>
                <div class="md:col-span-2 text-base font-medium text-[#334155]">
                    {{ $item->name }}
                </div>
            </div>

            <!-- Kategori -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 border-b border-[#f1f5f9] p-6 sm:px-8">
                <div class="text-sm font-semibold text-[#64748b]">Kategori</div>
                <div class="md:col-span-2">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-[#f1f5f9] text-[#475569] border border-[#e2e8f0]">
                        <i class="fas fa-folder text-[#94a3b8] mr-1.5"></i> {{ $item->category->name }}
                    </span>
                </div>
            </div>

            <!-- Stok -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 border-b border-[#f1f5f9] p-6 sm:px-8">
                <div class="text-sm font-semibold text-[#64748b] md:mt-1">Status Stok</div>
                <div class="md:col-span-2">
                    @if($item->stock < 10)
                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-semibold bg-amber-100 text-amber-700 border border-amber-200">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            {{ $item->stock }} Unit (Stok Rendah)
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-semibold bg-emerald-100 text-emerald-700 border border-emerald-200">
                            <i class="fas fa-check-circle mr-2"></i>
                            {{ $item->stock }} Unit
                        </span>
                    @endif
                </div>
            </div>

            <!-- Harga -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-6 sm:px-8">
                <div class="text-sm font-semibold text-[#64748b] md:mt-1">Harga Satuan</div>
                <div class="md:col-span-2 text-xl font-bold text-[#334155]">
                    {{ $item->price_formatted }}
                </div>
            </div>
        </div>

        <!-- Metadata Footer -->
        <div class="bg-[#f8fafc] border-t border-[#e2e8f0] px-6 py-5 sm:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-[#64748b]">
                <div class="flex items-center gap-2">
                    <i class="fas fa-clock text-[#94a3b8]"></i>
                    <span><strong>Dibuat:</strong> {{ $item->created_at->format('d M Y, H:i') }} WIB</span>
                </div>
                <div class="flex items-center gap-2 sm:justify-end">
                    <i class="fas fa-history text-[#94a3b8]"></i>
                    <span><strong>Diupdate:</strong> {{ $item->updated_at->format('d M Y, H:i') }} WIB</span>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
