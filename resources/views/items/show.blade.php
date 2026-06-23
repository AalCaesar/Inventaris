@extends('layouts.app')

@section('title', 'Detail Barang')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('items.index') }}">Barang</a></li>
    <li class="breadcrumb-item active" aria-current="page">Detail</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-box me-2"></i>Detail Barang</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong class="text-muted">Kode Barang</strong>
                        </div>
                        <div class="col-md-8">
                            <h5><span class="badge bg-dark">{{ $item->item_code }}</span></h5>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong class="text-muted">Nama Barang</strong>
                        </div>
                        <div class="col-md-8">
                            <h5>{{ $item->name }}</h5>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong class="text-muted">Kategori</strong>
                        </div>
                        <div class="col-md-8">
                            <span class="badge bg-secondary fs-6">{{ $item->category->name }}</span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong class="text-muted">Stok</strong>
                        </div>
                        <div class="col-md-8">
                            @if($item->stock < 10)
                                <span class="badge bg-warning text-dark fs-6">
                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                    {{ $item->stock }} unit (Stok Rendah)
                                </span>
                            @else
                                <span class="badge bg-success fs-6">
                                    <i class="fas fa-check-circle me-1"></i>
                                    {{ $item->stock }} unit
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong class="text-muted">Harga</strong>
                        </div>
                        <div class="col-md-8">
                            <h4 class="text-primary mb-0">{{ $item->price_formatted }}</h4>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="row mb-2">
                        <div class="col-md-6">
                            <small class="text-muted">Dibuat pada:</small><br>
                            <strong>{{ $item->created_at->format('d F Y, H:i') }} WIB</strong>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted">Terakhir diupdate:</small><br>
                            <strong>{{ $item->updated_at->format('d F Y, H:i') }} WIB</strong>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('items.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
                        </a>
                        <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>Edit Barang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
