@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')
<div class="max-w-2xl mx-auto w-full pb-10">

    <!-- Header & Action -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-[#334155]">Edit Kategori</h2>
            <p class="text-sm text-[#64748b] mt-1">Perbarui nama klasifikasi barang</p>
        </div>
        <a href="{{ route('categories.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-white border border-[#e2e8f0] text-[#64748b] text-sm font-medium rounded-[6px] transition-all duration-200 hover:bg-[#f8fafc] hover:text-[#334155] shadow-sm">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white border border-[#e2e8f0] rounded-[8px] shadow-[0_1px_3px_rgba(0,0,0,0.1)] overflow-hidden">
        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="p-6 sm:p-8">

                <!-- Nama Kategori -->
                <div>
                    <label for="name" class="block text-sm font-medium text-[#334155] mb-1.5">
                        Nama Kategori <span class="text-[#e11d48]">*</span>
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}" required autofocus maxlength="255" placeholder="Masukkan nama kategori"
                           class="w-full border border-[#e2e8f0] rounded-[6px] px-4 py-2.5 text-sm text-[#334155] bg-[#f8fafc] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#6366f1]/20 focus:border-[#6366f1] transition-all @error('name') border-[#e11d48] ring-[#e11d48]/20 @enderror">
                    @error('name')
                        <p class="mt-1.5 text-xs text-[#e11d48] font-medium">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <!-- Card Footer / Actions -->
            <div class="px-6 py-4 bg-[#f8fafc] border-t border-[#e2e8f0] flex items-center justify-between">

                <!-- Tombol Hapus (Kiri) - Hanya muncul jika tidak ada barang yang terikat -->
                <div>
                    @if($category->items_count == 0)
                        <!-- Jika controller passing variable count, tapi kita gunakan dummy action delete disini jika perlu.
                             Namun karena form ini khusus PUT, lebih rapi jika hapus di index saja. -->
                    @endif
                </div>

                <!-- Buttons (Kanan) -->
                <div class="flex items-center gap-3 w-full sm:w-auto justify-end">
                    <a href="{{ route('categories.index') }}" class="inline-flex items-center justify-center px-6 py-2.5 bg-white border border-[#e2e8f0] text-[#64748b] text-sm font-medium rounded-[6px] transition-all duration-200 hover:bg-[#f1f5f9] hover:text-[#334155]">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center justify-center px-6 py-2.5 bg-[#6366f1] text-white text-sm font-medium rounded-[6px] transition-all duration-200 hover:bg-[#4f46e5] shadow-sm focus:outline-none focus:ring-2 focus:ring-[#6366f1]/50 focus:ring-offset-2">
                        <i class="fas fa-save mr-2"></i> Update Kategori
                    </button>
                </div>
            </div>
        </form>
    </div>

</div>
@endsection
