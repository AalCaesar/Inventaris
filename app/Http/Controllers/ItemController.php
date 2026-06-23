<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Item::with('category');

        // Search functionality (item_code or name)
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('item_code', 'like', '%' . $search . '%')
                  ->orWhere('name', 'like', '%' . $search . '%');
            });
        }

        // Filter by category
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        $items = $query->latest()->paginate(15);
        $categories = Category::all();

        return view('items.index', compact('items', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('items.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'item_code' => 'required|string|max:50|unique:items,item_code',
            'name' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'price' => 'required|integer|min:0',
        ], [
            'category_id.required' => 'Kategori harus dipilih.',
            'category_id.exists' => 'Kategori yang dipilih tidak valid.',
            'item_code.required' => 'Kode barang harus diisi.',
            'item_code.unique' => 'Kode barang sudah digunakan.',
            'name.required' => 'Nama barang harus diisi.',
            'stock.required' => 'Stok harus diisi.',
            'stock.min' => 'Stok tidak boleh negatif.',
            'price.required' => 'Harga harus diisi.',
            'price.min' => 'Harga tidak boleh negatif.',
        ]);

        // Convert item_code to uppercase
        $validated['item_code'] = strtoupper($validated['item_code']);

        Item::create($validated);

        return redirect()->route('items.index')
            ->with('success', 'Barang berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Item::with('category')->findOrFail($id);
        return view('items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Item::findOrFail($id);
        $categories = Category::all();
        return view('items.edit', compact('item', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Item::findOrFail($id);

        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'item_code' => 'required|string|max:50|unique:items,item_code,' . $id,
            'name' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'price' => 'required|integer|min:0',
        ], [
            'category_id.required' => 'Kategori harus dipilih.',
            'category_id.exists' => 'Kategori yang dipilih tidak valid.',
            'item_code.required' => 'Kode barang harus diisi.',
            'item_code.unique' => 'Kode barang sudah digunakan.',
            'name.required' => 'Nama barang harus diisi.',
            'stock.required' => 'Stok harus diisi.',
            'stock.min' => 'Stok tidak boleh negatif.',
            'price.required' => 'Harga harus diisi.',
            'price.min' => 'Harga tidak boleh negatif.',
        ]);

        // Convert item_code to uppercase
        $validated['item_code'] = strtoupper($validated['item_code']);

        $item->update($validated);

        return redirect()->route('items.index')
            ->with('success', 'Barang berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect()->route('items.index')
            ->with('success', 'Barang berhasil dihapus.');
    }
}
