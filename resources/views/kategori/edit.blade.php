@extends('layouts.dashboard')
@section('content')
    @include('partials.breadcrumb', [
        'title' => 'Kategori',
        'menus' => [
          ['title' => 'Kategori', 'route' => route('kategori.index')],
          ['title' => 'Edit'],
          ['title' => $category->name],
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

            @error('name')
                <div class="alert alert-danger shadow-sm border {{ session('success') ? 'text-success' : 'text-danger' }}"
                    role="alert">
                    {{ $message }}
                </div>
            @enderror

            <div class="card">
                <div class="card-header">
                    <div class="card-title d-flex">
                        <a href="{{ route('kategori.index') }}">
                            <button class="btn btn-dark btn-sm border d-flex align-items-center">
                                <i class="icon-refresh"></i>
                                <span class="icon-class ms-2">Kembali</span>
                            </button>
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-6">
                            <form action="{{ route('kategori.update', $category->id) }}" method="post">
                                @method('put')
                                @csrf
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Kategori <span
                                            class="text-danger">*</span></label>
                                    <input value="{{ old('name', $category->name) }}" name="name" type="text" class="form-control" placeholder="Nama kategori">
                                </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="reset" class="btn btn-light border">Reset</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
