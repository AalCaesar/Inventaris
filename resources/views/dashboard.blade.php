@extends('layouts.app')

@section('title', 'Ringkasan Inventaris')

@section('content')
<div class="max-w-7xl mx-auto w-full">

    <!-- Statistics Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

        <!-- Card 1: Total Kategori -->
        <div class="bg-white border border-[#e2e8f0] rounded-[8px] shadow-[0_1px_3px_rgba(0,0,0,0.1)] p-6 flex items-center justify-between group hover:shadow-md transition-shadow">
            <div>
                <p class="text-xs font-semibold text-[#64748b] uppercase tracking-wide mb-1">Total Kategori</p>
                <h3 class="text-3xl font-bold text-[#334155]">{{ $totalCategories }}</h3>
            </div>
            <div class="w-12 h-12 rounded-full bg-[#f1f5f9] flex items-center justify-center text-[#6366f1] group-hover:scale-110 transition-transform">
                <i class="fas fa-folder text-xl"></i>
            </div>
        </div>

        <!-- Card 2: Total Barang -->
        <div class="bg-white border border-[#e2e8f0] rounded-[8px] shadow-[0_1px_3px_rgba(0,0,0,0.1)] p-6 flex items-center justify-between group hover:shadow-md transition-shadow">
            <div>
                <p class="text-xs font-semibold text-[#64748b] uppercase tracking-wide mb-1">Total Barang</p>
                <h3 class="text-3xl font-bold text-[#334155]">{{ $totalItems }}</h3>
            </div>
            <div class="w-12 h-12 rounded-full bg-[#f1f5f9] flex items-center justify-center text-[#10b981] group-hover:scale-110 transition-transform">
                <i class="fas fa-box text-xl"></i>
            </div>
        </div>

        <!-- Card 3: Nilai Inventaris -->
        <div class="bg-white border border-[#e2e8f0] rounded-[8px] shadow-[0_1px_3px_rgba(0,0,0,0.1)] p-6 flex items-center justify-between group hover:shadow-md transition-shadow">
            <div>
                <p class="text-xs font-semibold text-[#64748b] uppercase tracking-wide mb-1">Total Nilai (Rp)</p>
                <h3 class="text-2xl font-bold text-[#334155]">{{ number_format($totalInventoryValue, 0, ',', '.') }}</h3>
            </div>
            <div class="w-12 h-12 rounded-full bg-[#f1f5f9] flex items-center justify-center text-[#3b82f6] group-hover:scale-110 transition-transform">
                <i class="fas fa-money-bill-wave text-xl"></i>
            </div>
        </div>

        <!-- Card 4: Stok Rendah -->
        <div class="bg-amber-50 border border-amber-200 rounded-[8px] shadow-sm p-6 flex items-center justify-between group hover:shadow-md transition-shadow">
            <div>
                <p class="text-xs font-semibold text-amber-700 uppercase tracking-wide mb-1">Stok Perlu Perhatian</p>
                <h3 class="text-3xl font-bold text-amber-900">{{ $lowStockItems->count() }}</h3>
            </div>
            <div class="w-12 h-12 rounded-full bg-amber-100 flex items-center justify-center text-amber-600 group-hover:scale-110 transition-transform">
                <i class="fas fa-exclamation-triangle text-xl"></i>
            </div>
        </div>

    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Left Column: Low Stock Table -->
        <div class="lg:col-span-2">
            <div class="bg-white border border-[#e2e8f0] rounded-[8px] shadow-[0_1px_3px_rgba(0,0,0,0.1)] overflow-hidden h-full flex flex-col">
                <!-- Header -->
                <div class="px-6 py-5 border-b border-[#e2e8f0] bg-white flex justify-between items-center">
                    <div>
                        <h3 class="text-base font-semibold text-[#334155] flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                            Barang Perlu Restock
                        </h3>
                        <p class="text-sm md:text-base text-[#64748b] mt-1">Item dengan stok kurang dari 10 unit.</p>
                    </div>
                    @if($lowStockItems->count() > 0)
                        <a href="{{ route('items.index') }}" class="text-sm font-medium text-[#6366f1] hover:text-[#4f46e5] transition-colors">
                            Lihat Semua &rarr;
                        </a>
                    @endif
                </div>

                <!-- Body / Table -->
                <div class="flex-1 overflow-x-auto">
                    @if($lowStockItems->count() > 0)
                        <table class="min-w-full divide-y divide-[#e2e8f0]">
                            <thead class="bg-[#f8fafc]">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-[#64748b] uppercase tracking-wider">Kode</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-[#64748b] uppercase tracking-wider">Nama Barang</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-semibold text-[#64748b] uppercase tracking-wider">Stok</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-semibold text-[#64748b] uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-[#e2e8f0]">
                                @foreach($lowStockItems as $item)
                                <tr class="hover:bg-[#f8fafc] transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="font-mono text-sm text-[#6366f1]">{{ $item->item_code }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-[#334155]">{{ $item->name }}</div>
                                        <div class="text-xs text-[#64748b] mt-0.5">{{ $item->category->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-700 border border-amber-200">
                                            {{ $item->stock }} Unit
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        <a href="{{ route('items.edit', $item->id) }}" class="inline-flex items-center justify-center p-1.5 rounded-[6px] text-[#64748b] hover:bg-[#f1f5f9] hover:text-[#6366f1] transition-colors" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="flex flex-col items-center justify-center h-full py-12 px-4 text-center">
                            <div class="w-16 h-16 bg-emerald-50 rounded-full flex items-center justify-center mb-4">
                                <i class="fas fa-check text-2xl text-emerald-500"></i>
                            </div>
                            <h3 class="text-base font-semibold text-[#334155]">Stok Terkendali</h3>
                            <p class="text-sm text-[#64748b] mt-1 max-w-sm">Tidak ada barang yang memerlukan restock saat ini. Semua item berada di atas batas minimum.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column: Chart -->
        <div class="lg:col-span-1">
            <div class="bg-white border border-[#e2e8f0] rounded-[8px] shadow-[0_1px_3px_rgba(0,0,0,0.1)] overflow-hidden h-full flex flex-col">
                <!-- Header -->
                <div class="px-6 py-5 border-b border-[#e2e8f0] bg-white">
                    <h3 class="text-base font-semibold text-[#334155]">Distribusi Kategori</h3>
                    <p class="text-sm text-[#64748b] mt-1">Komposisi barang per kategori.</p>
                </div>

                <!-- Body -->
                <div class="p-6 flex-1 flex flex-col items-center justify-center min-h-[300px]">
                    @if(count($chartLabels) > 0)
                        <div class="w-full relative h-64">
                            <canvas id="categoryChart"></canvas>
                        </div>
                    @else
                        <div class="text-center">
                            <div class="w-16 h-16 bg-[#f1f5f9] rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-chart-pie text-2xl text-[#94a3b8]"></i>
                            </div>
                            <p class="text-sm text-[#64748b]">Belum ada data untuk ditampilkan.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
@if(count($chartLabels) > 0)
<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('categoryChart');
    if (ctx) {
        new Chart(ctx, {
            type: 'doughnut', // Changed to doughnut for a cleaner look in a sidebar column
            data: {
                labels: @json($chartLabels),
                datasets: [{
                    data: @json($chartData),
                    backgroundColor: [
                        '#6366f1', '#3b82f6', '#0ea5e9', '#10b981', '#f59e0b', '#f43f5e', '#8b5cf6', '#d946ef'
                    ],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%', // Creates a clean modern ring
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            pointStyle: 'circle',
                            font: {
                                family: 'Inter, sans-serif',
                                size: 12
                            },
                            color: '#64748b'
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1e293b',
                        padding: 12,
                        titleFont: { family: 'Inter, sans-serif', size: 13 },
                        bodyFont: { family: 'Inter, sans-serif', size: 13 },
                        cornerRadius: 8,
                    }
                }
            }
        });
    }
});
</script>
@endif
@endpush
