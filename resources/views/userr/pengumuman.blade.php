@extends('layouts.main')
@section('title', 'DelCafe - Pengumuman')

@include('layouts.navbar')

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9fa;
    }

    /* Styling FAQ Structure */
    .content h3 {
        font-size: 2rem;
        margin-bottom: 1.5rem;
    }

    .content h3 span {
        color: #6c757d;
        margin-right: 10px;
    }

    .content h3 strong {
        color: #343a40;
        display: block;
        margin-top: 0.5rem;
    }

    .faq-container {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .faq-item {
        border-bottom: 1px solid #eee;
        padding: 1.5rem;
        position: relative;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .faq-item:last-child {
        border-bottom: none;
    }

    .faq-item h3 {
        font-size: 1.1rem;
        margin: 0;
        padding-right: 40px;
    }

    .faq-item h3 span {
        color: #007bff;
    }

    .faq-content {
        max-height: 0;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .faq-active .faq-content {
        max-height: 500px;
        padding-top: 1rem;
    }

    .faq-toggle {
        position: absolute;
        right: 20px;
        top: 20px;
        transition: transform 0.3s ease;
    }

    .faq-active .faq-toggle {
        transform: rotate(90deg);
    }

    .text-muted {
        font-size: 0.9rem;
        margin-top: 1rem;
        display: block;
    }

    .tautan-link {
        color: #007bff;
        text-decoration: underline;
        display: inline-block;
        margin-top: 0.5rem;
    }

    /* Tambahkan style ini */
    .empty-announcement-container {
        min-height: 50vh; /* Atau sesuaikan dengan kebutuhan Anda */
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>

<div class="container pt-5 my-5" data-aos="fade-up">
    <div class="content px-xl-5" data-aos="fade-up" data-aos-delay="100">
        <div class="container section-title" data-aos="fade-up">
            <br>
            <h2>Pengumuman</h2>
        </div>
    </div>

    @if(isset($pengumumans) && count($pengumumans) > 0)
    <div class="container pt-5 my-5" data-aos="fade-up">
        <div class="content px-xl-5" data-aos="fade-up" data-aos-delay="100">
            <div class="container section-title" data-aos="fade-up">
    <p>
        Temukan informasi terbaru    penting seputar aktivitas kami
    </p>
</div>
</div>
    <div class="faq-container px-xl-5" data-aos="fade-up" data-aos-delay="200">
        @foreach ($pengumumans as $index => $pengumuman)
        <div class="faq-item {{ $loop->first ? 'faq-active' : '' }}">
            <h3><span>{{ sprintf('%02d', $index + 1) }}</span>{{ $pengumuman->judul }}</h3>
            <div class="faq-content">
                <p>{{ $pengumuman->teks }}</p>
                @if ($pengumuman->tautan)
                <a href="{{ $pengumuman->tautan }}" target="_blank" class="tautan-link">
                    Klik di sini untuk informasi selengkapnya
                </a>
                @endif
                <small class="text-muted">
                    Dipublikasikan pada {{ date('d-m-Y', strtotime($pengumuman->tanggal)) }}
                </small>
            </div>
            <i class="faq-toggle bi bi-chevron-right"></i>
        </div>
        @endforeach
    </div>
    @else
    <div class="container pt-5 my-5 empty-announcement-container" data-aos="fade-up">
        <div class="d-flex justify-content-center align-items-center">
            <div class="text-center">
                <i class="fas fa-bullhorn fa-3x text-secondary mb-4"></i>
                <h5 class="fw-medium text-secondary">Belum ada pengumuman yang tersedia</h5>
                <p class="text-muted">Klik tombol Tambah untuk membuat pengumuman baru</p>
            </div>
        </div>
    </div>
    @endif
</div>

<script>

    document.querySelectorAll('.faq-item').forEach(item => {
        item.addEventListener('click', () => {
            item.classList.toggle('faq-active');
        });
    });
</script>

@include('layouts.footer')
