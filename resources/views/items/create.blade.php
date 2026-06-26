@extends('layouts.app')

@section('title', 'Tambah Barang')

@section('content')
<div class="max-w-3xl mx-auto w-full pb-10">

    <!-- Header & Action -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-[#334155]">Tambah Barang Baru</h2>
            <p class="text-sm md:text-base text-[#64748b] mt-1">Masukkan detail informasi barang ke dalam inventaris</p>
        </div>
        <a href="{{ route('items.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-white border border-[#e2e8f0] text-[#64748b] text-sm font-medium rounded-[6px] transition-all duration-200 hover:bg-[#f8fafc] hover:text-[#334155] shadow-sm">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white border border-[#e2e8f0] rounded-[8px] shadow-[0_1px_3px_rgba(0,0,0,0.1)] overflow-hidden">
        <form action="{{ route('items.store') }}" method="POST">
            @csrf

            <div class="p-6 sm:p-8 space-y-6">

                <!-- Row 1: Kategori & Kode Barang -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Kategori -->
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-[#334155] mb-1.5">
                            Kategori <span class="text-[#e11d48]">*</span>
                        </label>
                        <select id="category_id" name="category_id" required
                                class="w-full border border-[#e2e8f0] rounded-[6px] px-4 py-2.5 text-sm text-[#334155] bg-[#f8fafc] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#6366f1]/20 focus:border-[#6366f1] transition-all cursor-pointer @error('category_id') border-[#e11d48] ring-[#e11d48]/20 @enderror">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1.5 text-xs text-[#e11d48] font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kode Barang -->
                    <div>
                        <label for="item_code" class="block text-sm font-medium text-[#334155] mb-1.5">
                            Kode Barang <span class="text-[#e11d48]">*</span>
                        </label>
                        <input type="text" id="item_code" name="item_code" value="{{ old('item_code') }}" required maxlength="50" placeholder="Contoh: BRG-2026-0001"
                               class="w-full border border-[#e2e8f0] rounded-[6px] px-4 py-2.5 text-sm text-[#334155] bg-[#f8fafc] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#6366f1]/20 focus:border-[#6366f1] transition-all uppercase placeholder:normal-case @error('item_code') border-[#e11d48] ring-[#e11d48]/20 @enderror">
                        @error('item_code')
                            <p class="mt-1.5 text-xs text-[#e11d48] font-medium">{{ $message }}</p>
                        @enderror
                        <p class="mt-1.5 text-xs text-[#64748b]">Kode unik, akan otomatis menjadi HURUF BESAR.</p>
                    </div>
                </div>

                <!-- Row 2: Nama Barang -->
                <div>
                    <label for="name" class="block text-sm font-medium text-[#334155] mb-1.5">
                        Nama Barang <span class="text-[#e11d48]">*</span>
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required maxlength="255" placeholder="Masukkan nama barang"
                           class="w-full border border-[#e2e8f0] rounded-[6px] px-4 py-2.5 text-sm text-[#334155] bg-[#f8fafc] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#6366f1]/20 focus:border-[#6366f1] transition-all @error('name') border-[#e11d48] ring-[#e11d48]/20 @enderror">
                    @error('name')
                        <p class="mt-1.5 text-xs text-[#e11d48] font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Row 3: Stok & Harga -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Stok -->
                    <div>
                        <label for="stock" class="block text-sm font-medium text-[#334155] mb-1.5">
                            Stok <span class="text-[#e11d48]">*</span>
                        </label>
                        <input type="number" id="stock" name="stock" value="{{ old('stock', 0) }}" min="0" required
                               class="w-full border border-[#e2e8f0] rounded-[6px] px-4 py-2.5 text-sm text-[#334155] bg-[#f8fafc] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#6366f1]/20 focus:border-[#6366f1] transition-all @error('stock') border-[#e11d48] ring-[#e11d48]/20 @enderror">
                        @error('stock')
                            <p class="mt-1.5 text-xs text-[#e11d48] font-medium">{{ $message }}</p>
                        @enderror
                        <p class="mt-1.5 text-xs text-[#64748b]">Jumlah fisik barang saat ini.</p>
                    </div>

                    <!-- Harga -->
                    <div>
                        <label for="price" class="block text-sm font-medium text-[#334155] mb-1.5">
                            Harga (Rp) <span class="text-[#e11d48]">*</span>
                        </label>
                        <input type="number" id="price" name="price" value="{{ old('price') }}" min="0" required placeholder="Contoh: 50000"
                               class="w-full border border-[#e2e8f0] rounded-[6px] px-4 py-2.5 text-sm text-[#334155] bg-[#f8fafc] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#6366f1]/20 focus:border-[#6366f1] transition-all @error('price') border-[#e11d48] ring-[#e11d48]/20 @enderror">
                        @error('price')
                            <p class="mt-1.5 text-xs text-[#e11d48] font-medium">{{ $message }}</p>
                        @enderror
                        <p class="mt-1.5 text-xs text-[#64748b]">Harga satuan dalam Rupiah.</p>
                    </div>
                </div>

            </div>

            <!-- Card Footer / Actions -->
            <div class="px-6 py-4 bg-[#f8fafc] border-t border-[#e2e8f0] flex items-center justify-end gap-3">
                <a href="{{ route('items.index') }}" class="inline-flex items-center justify-center px-6 py-2.5 bg-white border border-[#e2e8f0] text-[#64748b] text-sm font-medium rounded-[6px] transition-all duration-200 hover:bg-[#f1f5f9] hover:text-[#334155]">
                    Batal
                </a>
                <button type="submit" class="inline-flex items-center justify-center px-6 py-2.5 bg-[#6366f1] text-white text-sm font-medium rounded-[6px] transition-all duration-200 hover:bg-[#4f46e5] shadow-sm focus:outline-none focus:ring-2 focus:ring-[#6366f1]/50 focus:ring-offset-2">
                    <i class="fas fa-save mr-2"></i> Simpan Barang
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Auto uppercase for item_code
    document.getElementById('item_code').addEventListener('input', function() {
        this.value = this.value.toUpperCase();
    });
</script>
@endpush
