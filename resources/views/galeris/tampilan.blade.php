@extends('layouts.mainadmin')

@section('contents')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />



    <div class="container pt-5 my-5 text-center">
        <h1>Daftar Galeri</h1>

        <div class="mt-4">
            <form action="{{-- {{ route('galeris.index') }} --}}" method="GET" class="d-flex justify-content-center">
                <input type="text" name="search" class="form-control me-2" style="max-width: 300px;"
                    placeholder="Cari galeri..." value="{{ request('search') }}">
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

        @if (isset($galeris) && $galeris->isEmpty() && request('search'))
            <div class="alert alert-info mt-4 d-flex justify-content-center">
                Tidak ada galeri yang ditemukan "{{ request('search') }}".
            </div>
        @endif
        <br>
        <a href="{{ route('galeris.create') }}" class="btn btn-primary btn-sm px-3 py-1">
            <i class="fas fa-plus-circle me-2"></i>Tambah Galeri
        </a>

        @if (isset($galeris) && count($galeris) > 0)
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-6 g-4">
                @foreach ($galeris as $galeri)
                    <div class="col pt-5">
                        <div class="card h-100 shadow-sm rounded-4 overflow-hidden">
                            <div class="ratio ratio-1x1">
                                <img src="{{ asset('storage/images/' . $galeri->foto) }}"
                                    class="card-img-top img-fluid rounded-top-4" alt="galeri Image" style="object-fit: cover;">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold">{{ $galeri->nama }}</h5>
                                <p class="card-text flex-grow-1">{{ $galeri->deskripsi }}</p>
                                <a href="{{ route('galeris.edit', $galeri) }}"
                                    class="btn btn-outline-primary w-100 mt-auto rounded-3">Edit</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if($galeris->hasPages())
                <div class="mt-5 d-flex justify-content-center">
                    {{ $galeris->links() }}
                </div>
            @endif
        @else
            <div class="text-center py-5">
                <div class="py-5">
                    <i class="fas fa-images fa-3x text-secondary mb-4"></i>
                    <h5 class="fw-medium text-secondary">Belum ada galeri yang tersedia</h5>
                    <p class="text-muted">Klik tombol "Tambah" untuk membuat galeri baru</p>
                </div>
            </div>
        @endif
    </div>
@endsection
