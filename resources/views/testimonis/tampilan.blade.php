@extends('layouts.mainadmin')

@section('contents')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <div class="container pt-5 my-5 text-center">
        <h1>Daftar Testimoni</h1>

        <div class="mt-4">
            <form action="{{ route('testimonis.index') }}" method="GET" class="d-flex justify-content-center">
                <input type="text" name="search" class="form-control me-2" style="max-width: 300px;" placeholder="Cari testimoni..." value="{{ $search ?? '' }}">
                <button type="submit" class="btn btn-outline-primary">Cari</button>
            </form>
        </div>
        <br>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show d-flex justify-content-center" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (isset($testimonis) && $testimonis->isEmpty() && request('search'))
            <div class="alert alert-info mt-4 d-flex justify-content-center">
                Tidak ada testimoni yang ditemukan "{{ request('search') }}".
            </div>
        @endif


        @auth
            @if (auth()->user()->role == 'user')
                <a href="{{ route('userr.testimoni.create') }}" class="btn btn-primary mb-3">Tambah Testimoni</a>
            @endauth
        @else
            <div>
                <a>Login Terlebih dahulu jika ingin menambahkan Ulasan</a>
                <br>
                <a href="{{ route('login') }}" class="btn btn-primary mb-3">Login</a>
            </div>
        @endif

        @if(isset($testimonis) && count($testimonis) > 0)
            <table class="table table-striped pt-5 my-5">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Rating</th>
                        <th>Deskripsi</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($testimonis as $testimoni)
                        <tr>
                            <td>{{ $testimoni->nama }}</td>
                            <td>
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $testimoni->rating)
                                        <span class="fa fa-star" style="color: gold;"></span>
                                    @else
                                        <span class="fa fa-star" style="color: black;"></span>
                                    @endif
                                @endfor
                            </td>
                            <td>{{ $testimoni->deskripsi }}</td>
                            <td>
                                @include('testimonis.delete')
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="text-center py-5">
                <div class="py-5">
                    <i class="fas fa-comments fa-3x text-secondary mb-4"></i>
                    <h5 class="fw-medium text-secondary">Belum ada testimoni yang tersedia</h5>
                    <p class="text-muted">Testimoni akan muncul di sini setelah ditambahkan</p>
                </div>
            </div>
        @endif
    </div>
@endsection
