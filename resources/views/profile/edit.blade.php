@extends('layouts.main')
@section('title', 'DelCafe - Profile')

<section class="vh-100 d-flex align-items-center justify-content-center" style="background-color: #37517e;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-10">
                <div class="card" id="card-login">
                    <div class="card-body p-4 text-black">
                        <h5 class="section-title">Edit Profil</h5>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Form Update Profil -->
                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-outline mb-3">
                                        <input type="text" id="name" class="form-control form-control-lg" name="name" value="{{ old('name', $user->name) }}" required>
                                        <label class="form-label" for="name">Nama</label>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-outline mb-3">
                                        <input type="email" id="email" class="form-control form-control-lg" name="email" value="{{ old('email', $user->email) }}" required>
                                        <label class="form-label" for="email">Alamat email</label>
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-outline mb-3">
                                        <input type="password" id="password" class="form-control form-control-lg" name="password">
                                        <label class="form-label" for="password">Kata Sandi Baru (Kosongkan jika tidak ingin mengganti)</label>
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-outline mb-3">
                                        <input type="password" id="password_confirmation" class="form-control form-control-lg" name="password_confirmation">
                                        <label class="form-label" for="password_confirmation">Konfirmasi Kata Sandi Baru</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="profile_picture" class="form-label">Foto Profil</label>
                                        <div class="d-flex align-items-center">
                                            @if($user->profile_picture)
                                                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Foto Profil" class="img-thumbnail me-2" width="100">
                                            @else
                                                <p>Tidak ada foto profil.</p>
                                            @endif
                                        </div>
                                        <input type="file" id="profile_picture" class="form-control" name="profile_picture">
                                        @error('profile_picture')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="button-container">
                                <a href="{{ route('home') }}" class="btn btn-secondary btn-custom">Kembali</a>
                                <button type="submit" class="btn btn-dark btn-custom">Update Profil</button>
                            </div>
                        </form>

                        @if($user->profile_picture)
                        <!-- Form Hapus Foto Profil (di luar form update) -->
                        <form method="POST" action="{{ route('profile.remove_picture') }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto profil Anda?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-custom">Hapus Foto Profil</button>
                        </form>
                        @endif

                        <!-- Form Hapus Akun -->
                        <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun Anda?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-custom">Hapus Akun</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    #card-login {
        border-radius: 1rem;
        max-width: 900px;
        margin: auto;
    }

    .img-thumbnail {
        max-width: 100px;
        height: auto;
    }

    .container {
        padding-top: 5rem;
        padding-bottom: 5rem;
    }

    .d-flex {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .button-container {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .btn-custom {
        width: 150px;
        margin-bottom: 5px;
        border-radius: 0.5rem;
        padding: 0.75rem 1.25rem;
        text-align: center;
    }
</style>
