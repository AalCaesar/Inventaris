<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display dashboard with inventory statistics.
     */
    public function index()
    {
        // 1. Total Kategori
        $totalCategories = Category::count();

        // 2. Total Barang
        $totalItems = Item::count();

        // 3. Total Nilai Inventaris (SUM stock * price)
        $totalInventoryValue = Item::sum(DB::raw('stock * price'));

        // 4. Barang Stok Rendah (stock < 10) dengan eager loading category
        $lowStockItems = Item::with('category')
            ->lowStock()
            ->orderBy('stock', 'asc')
            ->limit(10)
            ->get();

        // 5. Data untuk Chart.js - kategori dengan jumlah barang
        $categoriesWithCount = Category::withCount('items')
            ->orderBy('items_count', 'desc')
            ->get();

        // Prepare data untuk Chart.js
        $chartLabels = $categoriesWithCount->pluck('name')->toArray();
        $chartData = $categoriesWithCount->pluck('items_count')->toArray();

        return view('dashboard', compact(
            'totalCategories',
            'totalItems',
            'totalInventoryValue',
            'lowStockItems',
            'chartLabels',
            'chartData'
        ));
    }
}
