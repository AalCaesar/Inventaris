@extends('layouts.app')

@section('title', 'Edit Barang')

@section('content')
<div class="max-w-3xl mx-auto w-full pb-10">

    <!-- Header & Action -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-[#334155]">Edit Data Barang</h2>
            <p class="text-sm md:text-base text-[#64748b] mt-1">Perbarui informasi barang <span class="font-semibold text-[#6366f1]">{{ $item->item_code }}</span></p>
        </div>
        <a href="{{ route('items.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-white border border-[#e2e8f0] text-[#64748b] text-sm font-medium rounded-[6px] transition-all duration-200 hover:bg-[#f8fafc] hover:text-[#334155] shadow-sm">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white border border-[#e2e8f0] rounded-[8px] shadow-[0_1px_3px_rgba(0,0,0,0.1)] overflow-hidden">
        <form action="{{ route('items.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')

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
                                <option value="{{ $category->id }}" {{ (old('category_id', $item->category_id) == $category->id) ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1.5 text-xs text-[#e11d48] font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kode Barang (Readonly) -->
                    <div>
                        <label for="item_code" class="block text-sm font-medium text-[#334155] mb-1.5">
                            Kode Barang <span class="text-[#e11d48]">*</span>
                        </label>
                        <input type="text" id="item_code" name="item_code" value="{{ old('item_code', $item->item_code) }}" readonly
                               class="w-full border border-[#e2e8f0] rounded-[6px] px-4 py-2.5 text-sm text-[#64748b] bg-[#f1f5f9] cursor-not-allowed uppercase">
                        @error('item_code')
                            <p class="mt-1.5 text-xs text-[#e11d48] font-medium">{{ $message }}</p>
                        @enderror
                        <p class="mt-1.5 text-xs text-[#64748b]">Kode barang tidak dapat diubah.</p>
                    </div>
                </div>

                <!-- Row 2: Nama Barang -->
                <div>
                    <label for="name" class="block text-sm font-medium text-[#334155] mb-1.5">
                        Nama Barang <span class="text-[#e11d48]">*</span>
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name', $item->name) }}" required maxlength="255" placeholder="Masukkan nama barang"
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
                        <input type="number" id="stock" name="stock" value="{{ old('stock', $item->stock) }}" min="0" required
                               class="w-full border border-[#e2e8f0] rounded-[6px] px-4 py-2.5 text-sm text-[#334155] bg-[#f8fafc] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#6366f1]/20 focus:border-[#6366f1] transition-all @error('stock') border-[#e11d48] ring-[#e11d48]/20 @enderror">
                        @error('stock')
                            <p class="mt-1.5 text-xs text-[#e11d48] font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Harga -->
                    <div>
                        <label for="price" class="block text-sm font-medium text-[#334155] mb-1.5">
                            Harga (Rp) <span class="text-[#e11d48]">*</span>
                        </label>
                        <input type="number" id="price" name="price" value="{{ old('price', $item->price) }}" min="0" required placeholder="Contoh: 50000"
                               class="w-full border border-[#e2e8f0] rounded-[6px] px-4 py-2.5 text-sm text-[#334155] bg-[#f8fafc] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#6366f1]/20 focus:border-[#6366f1] transition-all @error('price') border-[#e11d48] ring-[#e11d48]/20 @enderror">
                        @error('price')
                            <p class="mt-1.5 text-xs text-[#e11d48] font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

            </div>

            <!-- Card Footer / Actions -->
            <div class="px-6 py-4 bg-[#f8fafc] border-t border-[#e2e8f0] flex items-center justify-between">

                <!-- Info Meta (Kiri) -->
                <div class="hidden md:block text-xs text-[#94a3b8]">
                    Dibuat: {{ $item->created_at->format('d M Y, H:i') }}<br>
                    Diupdate: {{ $item->updated_at->format('d M Y, H:i') }}
                </div>

                <!-- Buttons (Kanan) -->
                <div class="flex items-center gap-3 w-full md:w-auto justify-end">
                    <a href="{{ route('items.index') }}" class="inline-flex items-center justify-center px-6 py-2.5 bg-white border border-[#e2e8f0] text-[#64748b] text-sm font-medium rounded-[6px] transition-all duration-200 hover:bg-[#f1f5f9] hover:text-[#334155]">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center justify-center px-6 py-2.5 bg-[#6366f1] text-white text-sm font-medium rounded-[6px] transition-all duration-200 hover:bg-[#4f46e5] shadow-sm focus:outline-none focus:ring-2 focus:ring-[#6366f1]/50 focus:ring-offset-2">
                        <i class="fas fa-save mr-2"></i> Update Barang
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
