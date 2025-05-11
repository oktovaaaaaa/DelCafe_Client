@extends('layouts.main')
@section('title', 'DelCafe - Testimoni')

@include('layouts.navbar')

<br><br>

@auth
@if (auth()->user()->role == 'user')
<div class="text-center mt-5">
    <br>
    <a href="{{ route('testimoni.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Testimoni
    </a>
</div>
@endif
<br>
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@else
    <div class="alert alert-info text-center pt-5 ">
        <p>Login terlebih dahulu jika ingin menambahkan ulasan.</p>
        <a href="{{ route('login') }}" class="btn btn-primary">
            <i class="fas fa-sign-in-alt"></i> Login
        </a>
    </div>
@endauth

<section id="testimonials" class="testimonials section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Testimoni</h2>
        <p>Apa kata mereka tentang kami?</p>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="swiper init-swiper">
            <script type="application/json" class="swiper-config">
            {
                "loop": true,
                "speed": 600,
                "autoplay": {
                "delay": 5000
                },
                "slidesPerView": "auto",
                "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
                }
            }
            </script>
            <div class="swiper-wrapper">
                @if(isset($testimonis) && count($testimonis) > 0)
                @foreach ($testimonis as $testimoni)
                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <!-- Dropdown Menu -->
                            @auth
                                @if (auth()->user()->role == 'user' && auth()->user()->id == $testimoni->user_id)
                                    <div class="dropdown" style="position: absolute; top: 10px; right: 10px;">
                                        <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="dropdownMenuButton{{ $testimoni->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton{{ $testimoni->id }}">
                                            <li><a class="dropdown-item" href="{{ route('testimoni.edit', $testimoni->id) }}"><i class="fas fa-edit me-2"></i>Edit</a></li>
                                            <li>
                                                <form action="{{ route('testimoni.destroy', $testimoni->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus testimoni ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item"><i class="fas fa-trash me-2"></i>Hapus</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                @endif
                            @endauth

                            <div style="width: 100px; height: 100px; overflow: hidden; border-radius: 50%; margin: 0 auto;">
                                @if($testimoni->user && $testimoni->user->profile_picture)
                                    <img src="{{ asset('storage/' . $testimoni->user->profile_picture) }}" class="testimonial-img" alt="Foto Profil {{ $testimoni->nama }}" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <img src="{{ asset('assets/img/profil.jpg') }}" class="testimonial-img" alt="Foto Profil {{ $testimoni->nama }}" style="width: 100%; height: 100%; object-fit: cover;">
                                @endif
                            </div>

                            <h3>{{ $testimoni->nama }}</h3>
                            <h4>Pengguna Layanan</h4>
                            <div class="stars">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $testimoni->rating)
                                        <i class="bi bi-star-fill"></i>
                                    @else
                                        <i class="bi bi-star"></i>
                                    @endif
                                @endfor
                            </div>
                            <p>
                                <i class="bi bi-quote quote-icon-left"></i>
                                <span>{{ $testimoni->deskripsi }}</span>
                                <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            <div class="swiper-pagination"></div>
        </div>

    </div>

    @else
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 300px;">
        <div class="text-center py-5">
            <i class="fas fa-comments fa-3x text-secondary mb-4"></i>
            <h5 class="fw-medium text-secondary">Belum ada testimoni tersedia</h5>
            <p class="text-muted">Jadilah yang pertama memberikan pendapat tentang layanan kami</p>
        </div>
    </div>
    @endif

</section>

@include('layouts.footer')
