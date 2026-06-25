<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataInventarisSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Tambahkan Kategori
        $categoryIds = [];
        $categories = ['Elektronik', 'Alat Tulis', 'Furniture'];

        foreach ($categories as $cat) {
            $id = DB::table('categories')->insertGetId([
                'name' => $cat,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $categoryIds[$cat] = $id;
        }

        // 2. Tambahkan Barang dengan kolom lengkap
        DB::table('items')->insert([
            [
                'name' => 'Laptop Asus',
                'item_code' => 'BRG-001', // Tambahkan ini
                'price' => 15000000,      // Tambahkan ini
                'category_id' => $categoryIds['Elektronik'],
                'stock' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Meja Kantor',
                'item_code' => 'BRG-002', // Tambahkan ini
                'price' => 500000,        // Tambahkan ini
                'category_id' => $categoryIds['Furniture'],
                'stock' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kertas A4',
                'item_code' => 'BRG-003', // Tambahkan ini
                'price' => 50000,         // Tambahkan ini
                'category_id' => $categoryIds['Alat Tulis'],
                'stock' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}