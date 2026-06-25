<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataInventarisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
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

        // 2. Tambahkan Barang
        // Pastikan nama kolom 'category_id', 'stock', 'name' sesuai dengan database kamu
        DB::table('items')->insert([
            [
                'name' => 'Laptop Asus',
                'category_id' => $categoryIds['Elektronik'],
                'stock' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Meja Kantor',
                'category_id' => $categoryIds['Furniture'],
                'stock' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kertas A4',
                'category_id' => $categoryIds['Alat Tulis'],
                'stock' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}