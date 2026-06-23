@extends('layouts.app')

@section('title', 'Tambah Barang')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('items.index') }}">Barang</a></li>
    <li class="breadcrumb-item active" aria-current="page">Tambah</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Tambah Barang Baru</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('items.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="category_id" class="form-label">Kategori <span class="text-danger">*</span></label>
                                <select class="form-select @error('category_id') is-invalid @enderror" 
                                        id="category_id" 
                                        name="category_id" 
                                        required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="item_code" class="form-label">Kode Barang <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control text-uppercase @error('item_code') is-invalid @enderror" 
                                       id="item_code" 
                                       name="item_code" 
                                       value="{{ old('item_code') }}" 
                                       placeholder="Contoh: BRG-2026-0001"
                                       required
                                       maxlength="50">
                                @error('item_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Kode unik, akan otomatis UPPERCASE</small>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Barang <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   placeholder="Masukkan nama barang"
                                   required
                                   maxlength="255">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="stock" class="form-label">Stok <span class="text-danger">*</span></label>
                                <input type="number" 
                                       class="form-control @error('stock') is-invalid @enderror" 
                                       id="stock" 
                                       name="stock" 
                                       value="{{ old('stock', 0) }}" 
                                       min="0"
                                       required>
                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Jumlah stok barang</small>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                                <input type="number" 
                                       class="form-control @error('price') is-invalid @enderror" 
                                       id="price" 
                                       name="price" 
                                       value="{{ old('price') }}" 
                                       min="0"
                                       placeholder="Contoh: 50000"
                                       required>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Harga satuan dalam Rupiah</small>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('items.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-2"></i>Simpan Barang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
