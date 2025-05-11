@extends('layouts.mainadmin')

@section('contents')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <div class="container pt-5 my-5 text-center">
        <h1>Daftar Menu</h1>

        <div class="mt-4">
            <form action="{{-- {{ route('menus.index') }} --}}" method="GET" class="d-flex justify-content-center">
                <input type="text" name="search" class="form-control me-2" style="max-width: 300px;" placeholder="Cari menu..."
                       value="{{ request('search') }}">
                <button type="submit" class="btn btn-outline-primary btn-sm">Cari</button>
            </form>
        </div>
        <br>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show d-flex justify-content-center" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (isset($menus) && $menus->isEmpty() && request('search'))
            <div class="alert alert-info mt-4 d-flex justify-content-center">
                Tidak ada menu yang ditemukan "{{ request('search') }}".
            </div>
        @endif
        <br>

        <a href="{{ route('menus.create') }}" class="btn btn-primary btn-sm px-3 py-1 pt">
            <i class="fas fa-plus-circle me-2"></i>Tambah Menu
        </a>


        @if (isset($menus) && count($menus) > 0)
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 g-4 mt-5">
                            @foreach ($menus as $menu)
                    <div class="col-lg-2 col-md-6 col-sm-12">
                        <div class="card h-100 shadow-sm rounded-4 overflow-hidden">
                            <div class="ratio ratio-1x1">
                                <img src="{{ url('storage/images/' . $menu->foto) }}"
                                     class="card-img-top img-fluid rounded-top-4" alt="Menu Image" style="object-fit: cover;">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold">{{ $menu->nama }}</h5>
                                <p class="card-text flex-grow-1">{{ $menu->deskripsi }}</p>
                                <p class="text-muted fw-bold fs-6">Rp {{ $menu->harga }}</p>
                                <a href="{{ route('menus.edit', $menu) }}" class="btn btn-outline-primary w-100 mt-auto rounded-3 fs-7">Edit</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if($menus->hasPages())
                <div class="mt-5 d-flex justify-content-center">
                    {{ $menus->links() }}
                </div>
            @endif
        @else
        
            <div class="text-center py-5">
                <div class="py-5">
                    <i class="fas fa-utensils fa-3x text-secondary mb-4"></i>
                    <h5 class="fw-medium text-secondary">Belum ada menu yang tersedia</h5>
                    <p class="text-muted">Klik tombol "Tambah" untuk membuat menu baru</p>
                </div>
            </div>
        @endif
    </div>
@endsection
