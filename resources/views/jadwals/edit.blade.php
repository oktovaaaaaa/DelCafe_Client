@extends('layouts.main')



<div class="d-flex justify-content-center align-items-center vh-10">
    <h2 class="fw-semibold fs-4 text-center">Tambah jadwal</h2>
</div>
<br>
<div class="text-end">
@include('jadwals.delete')
</div>


<div class="container mt-4" x-data="{imageUrl: '/storage/noimage.png'}">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form enctype="multipart/form-data" method="POST" action="{{ route('jadwals.update', $jadwal) }}" class="p-4 border rounded shadow">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="hari" class="form-label">Hari</label>
                    <input id="hari" class="form-control" type="text" name="hari" value="{{ $jadwal->hari }}"/>
                </div>

                <div class="mb-3">
                    <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
                    <input id="waktu_mulai" class="form-control" type="time" name="waktu_mulai" value="{{ $jadwal->waktu_mulai }}" required/>
                </div>

                <div class="mb-3">
                    <label for="waktu_selesai" class="form-label">Waktu Selesai</label>
                    <input id="waktu_selesai" class="form-control" type="time" name="waktu_selesai" value="{{ $jadwal->waktu_selesai }}" required/>
                </div>

                <input type="hidden" name="waktu" id="waktu" value="{{ old('waktu') }}">

                <div id="waktu_display"></div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const waktuMulaiInput = document.getElementById('waktu_mulai');
                        const waktuSelesaiInput = document.getElementById('waktu_selesai');
                        const waktuInput = document.getElementById('waktu');
                        const waktuDisplay = document.getElementById('waktu_display');

                        function updateWaktu() {
                            const waktuMulai = waktuMulaiInput.value;
                            const waktuSelesai = waktuSelesaiInput.value;

                            if (waktuMulai && waktuSelesai) {
                                const waktuGabungan = waktuMulai + "-" + waktuSelesai;
                                waktuInput.value = waktuGabungan;
                                waktuDisplay.textContent = "Waktu: " + waktuGabungan; // Menampilkan di div waktu_display
                            } else {
                                waktuInput.value = "";
                                waktuDisplay.textContent = "";
                            }
                        }

                        waktuMulaiInput.addEventListener('change', updateWaktu);
                        waktuSelesaiInput.addEventListener('change', updateWaktu);
                    });
                </script>


                <button type="submit" class="btn btn-dark w-100">Submit</button>
            </form>
        </div>
    </div>
</div>
