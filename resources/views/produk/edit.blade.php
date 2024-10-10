@extends('layouts.dashboard')
@section('content')
    @include('partials.breadcrumb', [
        'title' => 'Produk',
        'menus' => [
            ['title' => 'Produk', 'route' => route('produk.index')],
            ['title' => 'Edit'],
            ['title' => $product->name],
        ],
    ])

    <div class="row">
        <div class="col-md-12">
            @if (session('success'))
                <div class="alert alert-danger shadow-sm border {{ session('success') ? 'text-success' : 'text-danger' }}"
                    role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger shadow-sm border {{ session('success') ? 'text-success' : 'text-danger' }}"
                    role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @enderror

            <div class="card">
                <div class="card-header">
                    <div class="card-title d-flex">
                        <a href="{{ route('produk.index') }}">
                            <button class="btn btn-dark btn-sm border d-flex align-items-center">
                                <i class="icon-refresh"></i>
                                <span class="icon-class ms-2">Kembali</span>
                            </button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('produk.update', $product->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="row">

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama <span
                                                    class="text-danger">*</span></label>
                                            <input value="{{ old('name', $product->name) }}" name="name" type="text"
                                                class="form-control" placeholder="Nama produk">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="price" class="form-label">Harga <span
                                                    class="text-danger">*</span></label>
                                            <input value="{{ old('price', $product->price) }}" name="price" type="number"
                                                min="500" step="500" class="form-control"
                                                placeholder="Harga produk">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Kategori <span
                                                    class="text-danger">*</span></label>
                                            <select name="category_id" id="category_id" class="form-control">
                                                <option value="">Pilih kategori</option>
                                                @foreach ($categories as $item)
                                                    <option @if ($item->id == old('category_id', $product->category_id)) selected @endif
                                                        value="{{ $item->id }}">
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Gambar <span
                                                    class="text-dark">*</span></label>
                                            <input accept="image/*" name="image" type="file" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <button type="reset" class="btn btn-light border">Reset</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <img src="{{ asset("storage/$product->image") }}" alt="image" class="img-fluid rounded"
                                    style="aspect-ratio: 16/9; object-fit: cover;">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>
</div>
@endsection
