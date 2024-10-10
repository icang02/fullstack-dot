@extends('layouts.dashboard')
@section('content')
    @include('partials.breadcrumb', [
        'title' => 'Produk',
        'menus' => [['title' => 'Produk', 'route' => route('kategori.index')]],
    ])

    <div class="row">
        <div class="col-md-12">
            @if (session('success'))
                <div class="alert alert-danger shadow-sm border {{ session('success') ? 'text-success' : 'text-danger' }}"
                    role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <div class="card-title d-flex">
                        <a href="{{ route('produk.create') }}"
                            class="text-white btn btn-secondary btn-sm border d-flex align-items-center me-2">
                            <i class="icon-plus"></i>
                            <span class="icon-class ms-2">Tambah Produk</span>
                        </a>
                        <a href="{{ route('produk.index') }}">
                            <button class="btn btn-dark btn-sm border d-flex align-items-center">
                                <i class="icon-refresh"></i>
                                <span class="icon-class ms-2">Refresh halaman</span>
                            </button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-4 d-flex align-items-center justify-content-between">
                        <div class="text-muted">Menampilkan data produk.</div>
                        <div style="width: 300px; float: right;">
                            <form action="{{ route('produk.index') }}" method="get">
                                <div class="input-group">
                                    <input value="{{ request('q') }}" name="q" type="text" class="form-control"
                                        placeholder="Cari..." autocomplete="off"
                                        @if (request('q')) autofocus @endif>
                                    <button class="btn btn-sm btn-primary" id="button-addon2">
                                        <i class="fa fa-search search-icon" style="font-size: 0.8rem;"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}.
                                    </td>
                                    </td>
                                    <td>
                                        @php
                                            $img =
                                                $product->image != null
                                                    ? asset("storage/$product->image")
                                                    : asset('img/no-image.jpg');
                                        @endphp
                                        <img src="{{ $img }}" alt="image" class="img-fluid" width="80"
                                            style="aspect-ratio: 16/9; object-fit: cover;">
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>
                                        <a href="{{ route('produk.edit', $product->id) }}"
                                            class="btn btn-sm btn-primary edit-btn d-inline-flex align-items-center"
                                            style="padding: 6px 9px;">
                                            <i class="icon-note" style="font-size: 1.2em;"></i>
                                        </a>
                                        <a href="{{ route('produk.destroy', $product->id) }}" data-confirm-delete="true"
                                            class="btn btn-danger btn-sm delete-btn d-inline-flex align-items-center"
                                            style="padding: 6px 9px">
                                            <i class="icon-trash" style="font-size: 1.2em;"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">
                                        {{ request('q') ? 'Data yang dicari tidak ditemukan.' : 'Belum ada data produk.' }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
