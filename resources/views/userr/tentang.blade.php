@include('layouts.navbar')
@section('title', 'DelCafe - Tentang')
@extends('layouts.main')


<section id="about" class="about section">


    <div class="container section-title pt-5" data-aos="fade-up">
        <br>
        <h2>Tentang</h2>
    </div>

    <div class="container">
        <div class="row gy-4 pt-5">
            <!-- Kolom kiri (9) -->
            <div class="col-lg-9" data-aos="fade-up" data-aos-delay="100">
                @if (isset($tentangs) && count($tentangs) > 0)
                    @foreach ($tentangs as $tentang)
                        <div class="mb-4">
                            <h5 class="fw-bold">{{ $tentang->judul }}</h5>
                            <p>{{ $tentang->deskripsi }}</p>
                            <small class="text-muted d-block text-end mt-3">Dibuat pada
                                {{ date('d-m-Y', strtotime($tentang->tanggal)) }}</small>
                        </div>
                    @endforeach
                @else
                <div class="text-center py-5">
                    <div class="py-5">
                        <i class="fas fa-file-alt fa-3x text-secondary mb-4"></i>
                        <h5 class="fw-medium text-secondary">Belum ada data tentang yang tersedia</h5>
                        <p class="text-muted">Klik tombol "Tambah" untuk membuat data tentang baru</p>
                    </div>
                </div>
                @endif
            </div>

            <!-- Kolom kanan (3) -->
            <div class="col-lg-3" data-aos="fade-up" data-aos-delay="200">

                <p>Informasi lainnya bisa ditaruh di sini.</p>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')
