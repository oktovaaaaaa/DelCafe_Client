@extends('layouts.main')
@section('title', 'DelCafe - Register')


<section class="vh-100 d-flex align-items-center justify-content-center" style="background-color: #37517e;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card" id="card-login">
                    <div class="row g-0">
                        <div class="col-md-6 d-none d-md-block">
                            <img src="{{ asset('assets/img/delcafe.jpg') }}"
                                 alt="login form" class="img-fluid" id="login-image"/>
                        </div>
                        <div class="col-md-6 d-flex align-items-center">
                            <div class="card-body p-4 text-black">
                                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="text-center mb-3">
                                        <span class="h2 fw-bold">Del Cafe</span>
                                    </div>
                                    <h5 class="fw-normal mb-3 text-center">Buat akun baru</h5>
                                    <div class="form-outline mb-3">
                                        <input type="text" id="name" class="form-control form-control-lg" name="name" value="{{ old('name') }}" required>
                                        <label class="form-label" for="name">Nama</label>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-outline mb-3">
                                        <input type="email" id="email" class="form-control form-control-lg" name="email" value="{{ old('email') }}" required>
                                        <label class="form-label" for="email">Alamat email</label>
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-outline mb-3">
                                        <input type="password" id="password" class="form-control form-control-lg" name="password" required>
                                        <label class="form-label" for="password">Kata sandi</label>
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-outline mb-3">
                                        <input type="password" id="password_confirmation" class="form-control form-control-lg" name="password_confirmation" required>
                                        <label class="form-label" for="password_confirmation">Konfirmasi kata sandi</label>
                                        @error('password_confirmation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-outline mb-3">
                                        <input type="file" id="profile_picture" class="form-control form-control-lg" name="profile_picture">
                                        <label class="form-label" for="profile_picture">Foto Profil</label>
                                        @error('profile_picture')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="text-center">
                                        <button class="btn btn-dark btn-lg btn-block" type="submit">Buat akun</button>
                                    </div>
                                    <p class="mt-3 text-center" style="color: #393f81;">Sudah punya akun? <a href="{{ route('login') }}" style="color: #393f81;">Masuk disini</a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    #card-login {
        border-radius: 1rem;
        max-width: 500px;
        margin: auto;
    }

    #login-image {
        border-radius: 1rem 0 0 1rem;
        height: 100%;
        object-fit: cover;
    }

    .container {
        padding-top: 5rem;
        padding-bottom: 5rem;
    }
</style>
