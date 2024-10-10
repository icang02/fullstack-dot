<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    private function generateSlug($string)
    {
        $uuid = substr(hash('sha256', Str::uuid()), 0, 6);
        return Str::slug($string) .  '-' . $uuid;
    }

    public function index()
    {
        $search = request('q');
        $products = Product::with('category')
            ->orderBy('name')
            ->where('name', 'like', "%$search%")
            ->orWhereHas('category', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            })
            ->get();

        $title = 'Hapus produk?';
        $text = "Data produk akan dihapus!";
        confirmDelete($title, $text);

        return view('produk.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('produk.create', compact('categories'));
    }

    public function edit($id)
    {
        $categories = Category::orderBy('name')->get();
        $product = Product::findOrFail($id);
        return view('produk.edit', compact('categories', 'product'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => ['required'],
            'price'       => ['required'],
            'category_id' => ['required'],
            'image'       => ['required', 'image', 'max:2048'],
        ], [
            'name.required'        => 'Nama tidak boleh kosong.',
            'price.required'       => 'Harga tidak boleh kosong.',
            'category_id.required' => 'Kategori tidak boleh kosong.',
            'image.required'       => 'Gambar tidak boleh kosong.',
            'image.image'          => 'File harus berformat gambar.',
            'image.max'            => 'Ukuran gambar maksimal 2Mb.'
        ], $request->all());

        Product::create([
            'name'        => ucfirst($request->name),
            'slug'        => $this->generateSlug($request->name),
            'price'       => $request->price,
            'category_id' => $request->category_id,
            'image'       => $request->file('image')->store('upload'),
        ]);
        return back()->with('success', 'Produk baru ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'        => ['required'],
            'price'       => ['required'],
            'category_id' => ['required'],
            'image'       => ['image', 'max:2048'],
        ], [
            'name.required'        => 'Nama tidak boleh kosong.',
            'price.required'       => 'Harga tidak boleh kosong.',
            'category_id.required' => 'Kategori tidak boleh kosong.',
            'image.image'          => 'File harus berformat gambar.',
            'image.max'            => 'Ukuran gambar maksimal 2Mb.'
        ], $request->all());

        $product = Product::findOrFail($id);
        $img     = $product->image;
        if ($request->file('image')) {
            if ($product->image && Storage::exists($product->image))
                Storage::delete($product->image);
            $img = $request->file('image')->store('upload');
        }
        $product->update([
            'name'        => ucfirst($request->name),
            'slug'        => $this->generateSlug($request->name),
            'price'       => $request->price,
            'category_id' => $request->category_id,
            'image'       => $img,
        ]);
        return back()->with('success', 'Produk berhasil diupdate.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->image && Storage::exists($product->image))
            Storage::delete($product->image);
        $product->delete();
        return back()->with('success', 'Produk berhasil dihapus.');
    }
}
