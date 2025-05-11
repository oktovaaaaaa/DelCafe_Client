@extends('layouts.mainadmin')

@section('contents')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />



    <div class="container pt-5 my-5 text-center">
        <h1>Daftar Pesan</h1>

        <div class="mt-4">
            <form action="{{ route('kontaks.tampilan') }}" method="GET" class="d-flex justify-content-center">
                <input type="text" name="search" class="form-control me-2" style="max-width: 300px;"
                    placeholder="Cari pesan..." value="{{ request('search') }}">
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

        @if (isset($kontaks) && $kontaks->isEmpty() && request('search'))
            <div class="alert alert-info mt-4 d-flex justify-content-center">
                Tidak ada pesan yang ditemukan "{{ request('search') }}".
            </div>
        @endif

        @if (isset($kontaks) && count($kontaks) > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" class="text-center" style="width: 10%;">Nama</th>
                            <th scope="col" class="text-center" style="width: 15%;">Email</th>
                            <th scope="col" class="text-center" style="width: 15%;">Subjek</th>
                            <th scope="col" class="text-center" style="width: 50%;">Pesan</th>
                            <th scope="col" class="text-center" style="width: 10%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kontaks as $kontak)
                            <tr>
                                <td class="text-center">{{ $kontak->nama }}</td>
                                <td class="text-center">{{ $kontak->email }}</td>
                                <td class="text-center">{{ $kontak->subjek }}</td>
                                <td>{{ $kontak->pesan }}</td>
                                <td class="text-center">
                                    @include('kontaks.delete')
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                <div class="py-5">
                    <i class="fas fa-envelope fa-3x text-secondary mb-4"></i>
                    <h5 class="fw-medium text-secondary">Belum ada pesan yang masuk</h5>
                    <p class="text-muted">Pesan dari pengunjung akan ditampilkan di sini</p>
                </div>
            </div>
        @endif
    </div>
@endsection
