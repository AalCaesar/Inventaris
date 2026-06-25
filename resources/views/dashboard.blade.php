@extends('layouts.app')

@section('title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Statistics Cards Row -->
    <div class="row mb-4">
        <!-- Card 1: Total Kategori -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start border-primary border-4 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-primary fw-bold text-uppercase mb-1" style="font-size: 0.85rem;">
                                Total Kategori
                            </div>
                            <div class="h3 mb-0 fw-bold text-gray-800">
                                {{ $totalCategories }}
                            </div>
                        </div>
                        <div class="text-primary" style="font-size: 2rem;">
                            <i class="fas fa-folder"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2: Total Barang -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start border-success border-4 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-success fw-bold text-uppercase mb-1" style="font-size: 0.85rem;">
                                Total Barang
                            </div>
                            <div class="h3 mb-0 fw-bold text-gray-800">
                                {{ $totalItems }}
                            </div>
                        </div>
                        <div class="text-success" style="font-size: 2rem;">
                            <i class="fas fa-box"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 3: Total Nilai Inventaris -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start border-info border-4 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-info fw-bold text-uppercase mb-1" style="font-size: 0.85rem;">
                                Total Nilai Inventaris
                            </div>
                            <div class="h5 mb-0 fw-bold text-gray-800">
                                Rp {{ number_format($totalInventoryValue, 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="text-info" style="font-size: 2rem;">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 4: Barang Stok Rendah -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start border-warning border-4 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-warning fw-bold text-uppercase mb-1" style="font-size: 0.85rem;">
                                Barang Stok Rendah
                            </div>
                            <div class="h3 mb-0 fw-bold text-gray-800">
                                {{ $lowStockItems->count() }}
                            </div>
                            <small class="text-muted">Items (stok &lt; 10)</small>
                        </div>
                        <div class="text-warning" style="font-size: 2rem;">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Low Stock Items & Chart Row -->
    <div class="row">
        <!-- Section: Barang Perlu Restock -->
        <div class="col-xl-7 col-lg-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 fw-bold text-warning">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        Barang Perlu Restock
                    </h6>
                    @if($lowStockItems->count() > 0)
                        <a href="{{ route('items.index') }}" class="btn btn-sm btn-outline-warning">
                            <i class="fas fa-list me-1"></i> Lihat Semua
                        </a>
                    @endif
                </div>
                <div class="card-body">
                    @if($lowStockItems->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover table-sm align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 15%;">Kode</th>
                                        <th style="width: 35%;">Nama Barang</th>
                                        <th style="width: 25%;">Kategori</th>
                                        <th class="text-center" style="width: 15%;">Stok</th>
                                        <th class="text-center" style="width: 10%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($lowStockItems as $item)
                                    <tr>
                                        <td data-label="Kode"><code class="text-primary">{{ $item->item_code }}</code></td>
                                        <td data-label="Nama Barang">{{ $item->name }}</td>
                                        <td data-label="Kategori">
                                            <span class="badge bg-secondary">{{ $item->category->name }}</span>
                                        </td>
                                        <td data-label="Stok" class="text-center">
                                            <span class="badge bg-warning text-dark">
                                                <i class="fas fa-exclamation-triangle me-1"></i>
                                                {{ $item->stock }}
                                            </span>
                                        </td>
                                        <td data-label="Aksi" class="text-center">
                                            <a href="{{ route('items.edit', $item->id) }}" class="btn btn-sm btn-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-check-circle text-success mb-3" style="font-size: 3rem;"></i>
                            <h5 class="text-muted">Semua Barang Memiliki Stok Cukup</h5>
                            <p class="text-muted mb-0">Tidak ada barang dengan stok di bawah 10 unit.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Section: Chart - Distribusi Barang per Kategori -->
        <div class="col-xl-5 col-lg-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white py-3">
                    <h6 class="m-0 fw-bold text-primary">
                        <i class="fas fa-chart-bar me-2"></i>
                        Distribusi Barang per Kategori
                    </h6>
                </div>
                <div class="card-body">
                    @if(count($chartLabels) > 0)
                        <canvas id="categoryChart" style="max-height: 300px;"></canvas>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-chart-bar text-muted mb-3" style="font-size: 3rem;"></i>
                            <h5 class="text-muted">Belum Ada Data</h5>
                            <p class="text-muted mb-0">Tambahkan kategori dan barang untuk melihat statistik.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    @if(count($chartLabels) > 0)
    // Get canvas context
    const ctx = document.getElementById('categoryChart');

    if (ctx) {
        // Create chart
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($chartLabels),
                datasets: [{
                    label: 'Jumlah Barang',
                    data: @json($chartData),
                    backgroundColor: 'rgba(13, 110, 253, 0.7)',
                    borderColor: 'rgba(13, 110, 253, 1)',
                    borderWidth: 1,
                    borderRadius: 4,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            color: '#e5e7eb',
                            font: {
                                size: 13,
                                weight: '600'
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.parsed.y + ' items';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            precision: 0,
                            color: '#cbd5e1',
                            font: {
                                weight: '600'
                            }
                        },
                        grid: {
                            display: true,
                            drawBorder: true,
                            color: 'rgba(148, 163, 184, .18)'
                        }
                    },
                    x: {
                        ticks: {
                            color: '#cbd5e1',
                            maxRotation: 0,
                            minRotation: 0,
                            autoSkip: false,
                            font: {
                                size: 11,
                                weight: '600'
                            }
                        },
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    }
    @endif
});
</script>
@endpush
