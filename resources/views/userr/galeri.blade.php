@include('layouts.navbar')
@section('title', 'DelCafe - Galeri')

@extends('layouts.main')
<style>
    /* Tambahkan styling dari work process section */
    .work-process .steps-item {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        overflow: hidden;
    }

    .work-process .steps-item:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 12px rgba(0, 0, 0, 0.15);
    }

    .steps-image {
        height: 220px;
        overflow: hidden;
        position: relative;
    }

    .steps-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .steps-item:hover .steps-image img {
        transform: scale(1.05);
    }

    .steps-content {
        padding: 1.5rem;
        position: relative;
    }

    .steps-number {
        position: absolute;
        top: -20px;
        right: 20px;
        background: #fff;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Pertahankan styling modal yang ada */
    .modal-content { border-radius: 15px; }
    .modal-header { border-bottom: none; }
    .modal-title { font-size: 1.5rem; font-weight: bold; }
</style>

<section id="gallery" class="gallery section pt-5 mt-5">
    <div class="container section-title" data-aos="fade-up">
        <br>
        <h2>Galeri DEL Cafe</h2>
    </div>

<div class="container" data-aos="fade-up" data-aos-delay="100">
        <div id="galleryCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-inner">
                @if(isset($galeris) && count($galeris) > 0)
                <div class="text-center">
                    <p>Koleksi terbaik di DEL Cafe</p>
                </div>
                <br>

                    @php
                        $galerisPerSlide = 3;
                        $galeriChunks = array_chunk($galeris->all(), $galerisPerSlide);
                    @endphp

                    @foreach ($galeriChunks as $key => $galeriChunk)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <div class="row gy-5">
                                @foreach ($galeriChunk as $index => $galeri)
                                    <div class="col-lg-4"
                                         data-aos="fade-up"
                                         data-aos-delay="{{ 100 + ($index * 100) }}"
                                         data-bs-toggle="modal"
                                         data-bs-target="#galeriModal{{ $galeri->id }}">
                                        <div class="steps-item">
                                            <div class="steps-image">
                                                <img src="{{ url('storage/images/' . $galeri->foto) }}"
                                                     alt="{{ $galeri->nama }}"
                                                     loading="lazy">
                                            </div>
                                            <div class="steps-content">
                                                <div class="steps-number">{{ sprintf('%02d', $index + 1) }}</div>
                                                <h3>{{ $galeri->nama }}</h3>
                                                <p>{{ $galeri->deskripsi }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @else
                <div class="text-center py-5 pt-5">
                    <div class="py-5">
                        <i class="fas fa-images fa-3x text-secondary mb-4"></i>
                        <h5 class="fw-medium text-secondary">Belum ada galeri yang tersedia</h5>
                        <p class="text-muted">Klik tombol "Tambah" untuk membuat galeri baru</p>
                    </div>
                </div>
                @endif
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#galleryCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#galleryCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>

<!-- Modals tetap sama seperti sebelumnya -->
@foreach ($galeris as $galeri)
<div class="modal fade" id="galeriModal{{ $galeri->id }}" tabindex="-1" aria-labelledby="galeriModalLabel{{ $galeri->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="galeriModalLabel{{ $galeri->id }}">{{ $galeri->nama }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="{{ url('storage/images/' . $galeri->foto) }}" class="img-fluid w-100" alt="{{ $galeri->nama }}">
                <p class="mt-3">{{ $galeri->deskripsi }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach

@include('layouts.footer')
