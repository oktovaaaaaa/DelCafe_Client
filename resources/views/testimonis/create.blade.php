
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Berikan Testimoni Anda</h5>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif

                    <form action="{{ route('testimoni.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="rating">Rating (Bintang)</label>
                            <select class="form-control @error('rating') is-invalid @enderror" id="rating" name="rating">
                                <option value="">Pilih Rating</option>
                                <option value="1" @if(old('rating') == 1) selected @endif>★☆☆☆☆ (1 Bintang)</option>
                                <option value="2" @if(old('rating') == 2) selected @endif>★★☆☆☆ (2 Bintang)</option>
                                <option value="3" @if(old('rating') == 3) selected @endif>★★★☆☆ (3 Bintang)</option>
                                <option value="4" @if(old('rating') == 4) selected @endif>★★★★☆ (4 Bintang)</option>
                                <option value="5" @if(old('rating') == 5) selected @endif>★★★★★ (5 Bintang)</option>
                            </select>
                            @error('rating')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="ulasan">Ulasan</label>
                            <textarea class="form-control @error('ulasan') is-invalid @enderror" id="ulasan" name="ulasan" rows="4">{{ old('ulasan') }}</textarea>
                            @error('ulasan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Kirim Testimoni</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    #rating option {
        font-size: 1.2em; /* Ukuran font bintang */
    }

    #rating option:hover {
        background-color: #f0f0f0; /* Warna latar belakang saat di-hover */
    }

    #rating option:checked {
        color: gold; /* Warna teks saat dipilih */
    }
</style>
