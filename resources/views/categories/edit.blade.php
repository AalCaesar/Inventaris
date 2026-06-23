@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Kategori</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Kategori</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $category->name) }}" 
                                   placeholder="Masukkan nama kategori"
                                   required
                                   autofocus>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <small class="form-text text-muted">Maksimal 255 karakter</small>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-2"></i>Update Kategori
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
