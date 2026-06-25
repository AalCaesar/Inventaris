<!--
    IMPLEMENTASI CLEAN MINIMALISM DASHBOARD
    File: resources/views/dashboard.blade.php

    Contoh implementasi lengkap untuk mengganti style lama
-->

@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="mb-4">
        <h2>Dashboard Inventaris</h2>
        <p class="text-muted">Ringkasan data inventaris Anda</p>
    </div>

    <!-- Statistics Cards -->
    <div class="row">
        <!-- Card 1: Total Kategori -->
        <div class="col-4">
            <div class="stats-card">
                <div class="icon">
                    <i class="fas fa-folder"></i>
                </div>
                <div class="value">{{ $totalCategories }}</div>
                <div class="label">Total Kategori</div>
            </div>
        </div>

        <!-- Card 2: Total Barang -->
        <div class="col-4">
            <div class="stats-card">
                <div class="icon">
                    <i class="fas fa-box"></i>
                </div>
                <div class="value">{{ $totalItems }}</div>
                <div class="label">Total Barang</div>
            </div>
        </div>

        <!-- Card 3: Total Nilai Inventaris -->
        <div class="col-4">
            <div class="stats-card">
                <div class="icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="value">Rp {{ number_format($totalInventoryValue / 1000000, 1) }}M</div>
                <div class="label">Nilai Inventaris</div>
            </div>
        </div>

        <!-- Card 4: Stok Rendah -->
        <div class="col-4">
            <div class="stats-card">
                <div class="icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="value">{{ $lowStockItems->count() }}</div>
                <div class="label">Stok Rendah</div>
            </div>
        </div>
    </div>

    <!-- Main Content Row -->
    <div class="row">
        <!-- Low Stock Table -->
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Barang Stok Rendah</h3>
                    <p class="card-subtitle">Items dengan stok kurang dari 10</p>
                </div>
                <div class="card-body">
                    @if($lowStockItems->count() > 0)
                        <div class="table-container">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th class="text-center">Stok</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($lowStockItems as $item)
                                    <tr>
                                        <td><span class="badge badge-secondary">{{ $item->item_code }}</span></td>
                                        <td>{{ $item->name }}</td>
                                        <td class="text-center">
                                            <span class="badge badge-warning">{{ $item->stock }}</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('items.edit', $item->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center p-4">
                            <i class="fas fa-check-circle text-success" style="font-size: 48px; opacity: 0.3;"></i>
                            <p class="text-muted mt-2">Semua barang memiliki stok yang cukup!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Chart Visualization -->
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Distribusi Barang</h3>
                    <p class="card-subtitle">Per kategori</p>
                </div>
                <div class="card-body">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('categoryChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($chartLabels),
            datasets: [{
                label: 'Jumlah Barang',
                data: @json($chartData),
                backgroundColor: '#6366f1',
                borderRadius: 6,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        font: {
                            family: 'Inter, sans-serif',
                            size: 12
                        },
                        color: '#64748b'
                    },
                    grid: {
                        color: '#f1f5f9',
                        drawBorder: false
                    }
                },
                x: {
                    ticks: {
                        font: {
                            family: 'Inter, sans-serif',
                            size: 12
                        },
                        color: '#64748b'
                    },
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
});
</script>
@endpush
@endsection
