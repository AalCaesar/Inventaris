<!--
    CONTOH: ITEMS INDEX (LIST BARANG) - CLEAN MINIMALISM
    File: resources/views/items/index.blade.php
-->

@extends('layouts.app')

@section('title', 'Daftar Barang')

@section('content')
<div class="container-fluid">
    <!-- Page Header with Action -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>Daftar Barang</h2>
            <p class="text-muted">Kelola data barang inventaris</p>
        </div>
        <a href="{{ route('items.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Barang
        </a>
    </div>

    <!-- Search & Filter Card -->
    <div class="card mb-3">
        <div class="card-body">
            <form method="GET" action="{{ route('items.index') }}">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-label">Cari Barang</label>
                            <input
                                type="text"
                                name="search"
                                class="form-control"
                                placeholder="Cari kode atau nama barang..."
                                value="{{ request('search') }}"
                            >
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label class="form-label">Filter Kategori</label>
                            <select name="category_id" class="form-control">
                                <option value="">-- Semua Kategori --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-2">
                        <label class="form-label" style="visibility: hidden;">Action</label>
                        <div class="d-flex gap-1">
                            <button type="submit" class="btn btn-primary" style="flex: 1;">
                                <i class="fas fa-search"></i> Cari
                            </button>
                            <a href="{{ route('items.index') }}" class="btn btn-outline">
                                <i class="fas fa-redo"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Items Table -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="12%">Kode</th>
                    <th>Nama Barang</th>
                    <th width="15%">Kategori</th>
                    <th width="10%" class="text-center">Stok</th>
                    <th width="15%" class="text-right">Harga</th>
                    <th width="18%" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $index => $item)
                <tr>
                    <td>{{ $items->firstItem() + $index }}</td>
                    <td>
                        <span class="badge badge-secondary">{{ $item->item_code }}</span>
                    </td>
                    <td>{{ $item->name }}</td>
                    <td>
                        <span class="badge badge-info">{{ $item->category->name }}</span>
                    </td>
                    <td class="text-center">
                        @if($item->stock < 10)
                            <span class="badge badge-warning">
                                <i class="fas fa-exclamation-triangle"></i> {{ $item->stock }}
                            </span>
                        @else
                            <span class="badge badge-success">{{ $item->stock }}</span>
                        @endif
                    </td>
                    <td class="text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td>
                        <div class="d-flex justify-content-center gap-1">
                            <a href="{{ route('items.show', $item->id) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('items.edit', $item->id) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="delete-form" style="margin: 0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center p-4">
                        <i class="fas fa-inbox text-muted" style="font-size: 48px; opacity: 0.3;"></i>
                        <p class="text-muted mt-2">Tidak ada data barang</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($items->hasPages())
    <div class="mt-3">
        {{ $items->links() }}
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
// SweetAlert confirmation for delete
document.querySelectorAll('.delete-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Hapus Barang?',
            text: 'Data yang dihapus tidak dapat dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>
@endpush
