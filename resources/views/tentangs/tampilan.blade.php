@extends('layouts.mainadmin')

@section('contents')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <div class="container pt-5 my-5 text-center">
        <h1>Daftar Tentang</h1>

        <div class="mt-4">
            <form action="" method="GET" class="d-flex justify-content-center">
                <input type="text" name="search" class="form-control me-2" style="max-width: 300px;"
                    placeholder="Cari tentang..." value="{{ request('search') }}">
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

        @if (isset($tentangs) && $tentangs->isEmpty() && request('search'))
            <div class="alert alert-info mt-4 d-flex justify-content-center">
                Tidak ada tentang yang ditemukan "{{ request('search') }}".
            </div>
        @endif
        <br>
        <a href="{{ route('tentangs.create') }}" class="btn btn-primary btn-sm px-3 py-1">
            <i class="fas fa-plus-circle me-2"></i>Tambah Tentang
        </a>

        @if (isset($tentangs) && count($tentangs) > 0)
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @foreach ($tentangs as $tentang)
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold">{{ $tentang->judul }}</h5>
                                <p class="card-text flex-grow-1 text-secondary">{{ $tentang->deskripsi }}</p>
                                <p class="text-muted fw-bold fs-6 mb-3">{{ $tentang->tanggal->format('d-m-Y') }}</p>
                                <a href="{{ route('tentangs.edit', $tentang) }}"
                                    class="btn btn-outline-primary w-100 mt-auto">Edit</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if ($tentangs->hasPages())
                <div class="mt-5 d-flex justify-content-center">
                    {{ $tentangs->links() }}
                </div>
            @endif
        @else
            <div class="d-flex justify-content-center align-items-center" style="min-height: 300px;">
                <div class="text-center">
                    <i class="fas fa-file-alt fa-3x text-secondary mb-4"></i>
                    <h5 class="fw-medium text-secondary">Belum ada data tentang yang tersedia</h5>
                    <p class="text-muted">Klik tombol "Tambah" untuk membuat data tentang baru</p>
                </div>
            </div>
        @endif
    </div>
@endsection
