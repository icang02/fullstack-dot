<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert as Alert;

class CategoryController extends Controller
{
    public function index()
    {
        $search = request('q');
        $categories = Category::orderBy('name')
            ->where('name', 'like', "%$search%")
            ->get();

        $title = 'Hapus kategori?';
        $text = "Seluruh data yang berelasi dengan kategori ini akan ikut terhapus!";
        confirmDelete($title, $text);

        return view('kategori.index', compact('categories'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('kategori.edit', compact('category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:categories']
        ], [
            'name.required' => 'Nama kategori tidak boleh kosong.',
            'name.unique'   => 'Kategori sudah ada di database.'
        ], $request->all());

        Category::create(['name' => ucfirst($request->name)]);
        return back()->with('success', 'Kategori baru ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $rules = ['required'];
        $category = Category::findOrFail($id);
        if ($request->name !== $category->name)
            array_push($rules, 'unique:categories');

        $request->validate([
            'name' => $rules
        ], [
            'name.required' => 'Nama kategori tidak boleh kosong.',
            'name.unique'   => 'Kategori sudah ada di database.'
        ], $request->all());

        $category->update(['name' => ucfirst($request->name)]);
        return back()->with('success', 'Kategori berhasil diupdate.');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $products = $category->products;
        if ($products) {
            foreach ($products as $product) {
                if ($product->image && Storage::exists($product->image))
                    Storage::delete($product->image);
            }
        }

        $category->delete();
        return back()->with('success', 'Kategori berhasil dihapus.');
    }
}
