@extends('layouts.main')
@section('title', 'DelCafe - Login')


<section class="d-flex align-items-center justify-content-center" style="background-color: #37517e; min-height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-xl-8 col-lg-8 col-md-10 col-sm-12">
                <div class="card" id="card-login" style="max-width: 600px; margin: auto;">
                    <div class="row g-0">
                        <div class="col-md-6 col-lg-5 d-none d-md-block">
                            <img src="{{ asset('assets/img/delcafe.jpg') }}"
                                 alt="login form" class="img-fluid" id="login-image"/>
                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-4 text-black">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                                        <span class="h1 fw-bold mb-0">Del Cafe</span>
                                    </div>

                                    <h5 class="fw-normal mb-3 pb-2" style="letter-spacing: 1px;">Masuk ke akun anda</h5>

                                    <div data-mdb-input-init class="form-outline mb-3"> <!-- Kurangi margin-bottom -->
                                        <input type="email" id="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        <label class="form-label" for="email">Alamat email</label>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-3">
                                        <input type="password" id="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                        <label class="form-label" for="password">Kata sandi</label>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="pt-1 mb-3">
                                        <button data-mdb-button-init data-mdb-ripple-init class="btn btn-dark btn-lg btn-block" type="submit">{{ __('Masuk') }}</button>
                                    </div>

                                    <p class="mb-4 pb-lg-2" style="color: #393f81;">Belum punya akun? <a href="{{ route('register') }}" style="color: #393f81;">Daftar disini</a></p>
                                </form>
                                <a href="{{ url('') }}" class="btn btn-dark btn-lg btn-block" role="button">{{ __('Kembali') }}</a>
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
    }

    #login-image {
        border-radius: 1rem 0 0 1rem;
        height: 100%;
        object-fit: cover;
        width: 100%;
    }

    section {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .container {
        padding-top: 2rem;
        padding-bottom: 2rem;
    }

    #card-login {
        max-width: 600px;
        width: 100%;
    }

    .card-body {
        padding: 1.5rem;
    }

    .form-control-lg {
        font-size: 1rem;
        padding: 0.5rem 1rem;
    }

    .btn-lg {
        font-size: 1rem;
        padding: 0.5rem 1rem;
    }
</style>
