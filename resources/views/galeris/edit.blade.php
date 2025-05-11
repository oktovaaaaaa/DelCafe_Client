@extends('layouts.main')



    <div class="d-flex justify-content-center align-items-center vh-10">
        <h2 class="fw-semibold fs-4 text-center">Edit Galeri</h2>
    </div>

    <div class="text-end">
        @include('galeris.delete')
    </div>
    <br><br>

    <div class="mt-4">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-6 d-flex flex-column gap-3">
                    <form enctype="multipart/form-data" method="POST" action="{{ route('galeris.update', $galeri) }}"
                        class="p-4 border rounded shadow w-100">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ $galeri->nama }}"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3">{{ $galeri->deskripsi }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto</label>
                            <input type="file" class="form-control" id="foto" name="foto" accept="image/*"
                                onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])">
                        </div>

                        <button type="submit" class="btn btn-dark w-100">Simpan Perubahan</button>
                    </form>
                </div>

                <div class="col-lg-6 d-flex justify-content-center">
                    <div class="card shadow-lg p-3" style="max-width: 80%;">
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold">Preview Gambar</h5>
                            <img id="preview" class="rounded-md img-fluid" style="max-width: 100%;"
                                src="{{ asset('storage/images/' . $galeri->foto) }}" alt="Preview Gambar">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
