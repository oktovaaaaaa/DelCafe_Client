@extends('layouts.main')
@section('title', 'DelCafe - Jadwal')
@include('layouts.navbar')

<div class="container">
    <div class="container pt-2 mt-5" data-aos="fade-up">
        <div class="text-center mb-3">
            <div class="container section-title pt-5 mt-5" data-aos="fade-up">
                <h2>Jadwal</h2>
            </div>
        </div>

        @if(isset($jadwals) && count($jadwals) > 0)
            <div class="card shadow-lg border-0 rounded-3 overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="bg-success text-white">
                            <tr>
                                <th scope="col" class="py-3 text-center"><i class="fas fa-calendar-day me-2"></i>Hari</th>
                                <th scope="col" class="py-3 text-center"><i class="fas fa-clock me-2"></i>Waktu Mulai</th>
                                <th scope="col" class="py-3 text-center"><i class="fas fa-stopwatch me-2"></i>Waktu Selesai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwals as $jadwal)
                                <tr class="align-middle">
                                    <td class="text-center fw-medium">{{ $jadwal->hari }}</td>
                                    <td class="text-center"><span class="badge bg-success bg-opacity-10 text-success py-2 px-3">{{ $jadwal->waktu_mulai }}</span></td>
                                    <td class="text-center"><span class="badge bg-danger bg-opacity-10 text-danger py-2 px-3">{{ $jadwal->waktu_selesai }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @else
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

        <div class="text-center py-5">
            <div class="py-5">
                <i class="fas fa-calendar-times fa-3x text-secondary mb-4"></i>
                <h5 class="fw-medium text-secondary">Belum ada jadwal tersedia</h5>
                <p class="text-muted">Klik tombol "Tambah Jadwal" untuk membuat baru</p>
            </div>
        </div>        @endif
    </div>
</div>

@include('layouts.footer')
