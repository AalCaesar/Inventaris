@extends('layouts.app')

@section('title', 'Daftar Barang')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Barang</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-md-8">
            <h2>Daftar Barang</h2>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('items.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Tambah Barang
            </a>
        </div>
    </div>

    <!-- Search & Filter Section -->
    <div class="card mb-3">
        <div class="card-body">
            <form method="GET" action="{{ route('items.index') }}" class="row g-3">
                <div class="col-md-5">
                    <input type="text" name="search" class="form-control" placeholder="Cari kode atau nama barang..." value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
                    <select name="category_id" class="form-select">
                        <option value="">-- Semua Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-50">
                        <i class="fas fa-search me-2"></i>Cari
                    </button>
                    <a href="{{ route('items.index') }}" class="btn btn-secondary w-45">
                        <i class="fas fa-redo me-2"></i>Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Items Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="12%">Kode Barang</th>
                            <th>Nama Barang</th>
                            <th width="15%">Kategori</th>
                            <th width="10%" class="text-center">Stok</th>
                            <th width="15%" class="text-end">Harga</th>
                            <th width="18%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $index => $item)
                            <tr>
                                <td>{{ $items->firstItem() + $index }}</td>
                                <td><strong>{{ $item->item_code }}</strong></td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <span class="badge bg-secondary">{{ $item->category->name }}</span>
                                </td>
                                <td class="text-center">
                                    @if($item->stock < 10)
                                        <span class="badge bg-warning text-dark">
                                            <i class="fas fa-exclamation-triangle me-1"></i>{{ $item->stock }}
                                        </span>
                                    @else
                                        <span class="badge bg-success">{{ $item->stock }}</span>
                                    @endif
                                </td>
                                <td class="text-end">{{ $item->price_formatted }}</td>
                                <td class="text-center">
                                    <a href="{{ route('items.show', $item->id) }}" class="btn btn-info btn-sm" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm delete-btn" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">Tidak ada data barang</p>
                                    @if(request('search') || request('category_id'))
                                        <a href="{{ route('items.index') }}" class="btn btn-sm btn-primary">Reset Filter</a>
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-3">
                {{ $items->appends(request()->query())->links() }}
            </div>
        </div>
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
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
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
