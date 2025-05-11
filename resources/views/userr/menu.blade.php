@php
    use Illuminate\Support\Facades\Auth;
@endphp

@extends('layouts.main')
@section('title', 'DelCafe - Menu')
@include('layouts.navbar')


<br>
<div class="container section-title pt-5 mt-5" data-aos="fade-up">
    <h2>Menu</h2>
</div>


@if (isset($menus) && count($menus) > 0)
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-3 mt-4">
                <form action="" method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control me-2" placeholder="Cari menu..."
                        value="">
                    <button type="submit" class="btn btn-outline-primary">Cari</button>
                </form>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @auth
        @if (auth()->user()->role == 'user' && auth()->user()->id)
            <div class="py-3">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
                    @foreach ($menus as $menu)
                        <div class="col" data-menu-id="{{ $menu->id }}">
                            <div class="card h-100 shadow-sm rounded-4 overflow-hidden"
                                style="max-width: 250px; margin: auto;">
                                <div class="ratio ratio-1x1">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#menuModal{{ $menu->id }}">
                                        <img src="{{ url('storage/images/' . $menu->foto) }}"
                                            class="card-img-top img-fluid rounded-top-4" alt="{{ $menu->nama }}"
                                            style="object-fit: cover; height: 220px;">
                                    </a>
                                </div>
                                <div class="card-body d-flex flex-column" style="padding: 0.75rem;">
                                    <h5 class="card-title mb-1" style="font-size: 1rem;">{{ $menu->nama }}</h5>
                                    <p class="card-text mb-1" style="font-size: 0.8rem;">{{ $menu->deskripsi }}</p>
                                    <p class="card-text fw-bold text-primary mb-2" style="font-size: 0.9rem;">Rp
                                        {{ $menu->harga }}</p>

                                    <div class="mb-1">
                                        <label for="jumlah" class="form-label" style="font-size: 0.8rem;">Jumlah</label>
                                        <div class="input-group">
                                            <button class="btn btn-outline-secondary kurangCard" type="button"
                                                data-menu-id="{{ $menu->id }}"
                                                style="font-size: 0.7rem; padding: 0.2rem 0.5rem;">-</button>
                                            <input type="number" name="jumlah" id="jumlahCard{{ $menu->id }}"
                                                class="form-control jumlah-input jumlahCard" value="1" min="1"
                                                style="font-size: 0.8rem; padding: 0.2rem;">
                                            <button class="btn btn-outline-secondary tambahCard" type="button"
                                                data-menu-id="{{ $menu->id }}"
                                                style="font-size: 0.7rem; padding: 0.2rem 0.5rem;">+</button>
                                        </div>
                                    </div>

                                    <p style="font-size: 0.8rem;">Total Harga: <span id="totalHarga{{ $menu->id }}">Rp
                                            {{ $menu->harga }}</span></p>
                                    <!-- Ubah tombol Pesan menjadi tombol yang memicu modal -->
                                    <button type="button" class="btn btn-primary pesanMenuBtn"
                                        data-menu-id="{{ $menu->id }}" data-bs-toggle="modal"
                                        data-bs-target="#confirmOrderModal"
                                        style="font-size: 0.8rem; padding: 0.3rem 0.6rem;">Pesan</button>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Detail Menu -->
                        <div class="modal fade" id="menuModal{{ $menu->id }}" tabindex="-1"
                            aria-labelledby="menuModalLabel{{ $menu->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="menuModalLabel{{ $menu->id }}">{{ $menu->nama }}
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" data-harga="{{ str_replace(['Rp', '.'], '', $menu->harga) }}">
                                        <img src="{{ url('storage/images/' . $menu->foto) }}" class="img-fluid mb-2"
                                            alt="{{ $menu->nama }}">
                                        <p style="font-size: 0.9rem;">{{ $menu->deskripsi }}</p>
                                        <p class="fw-bold" style="font-size: 0.9rem;">Harga: Rp {{ $menu->harga }}</p>

                                        <form action="{{ route('userr.tambahKeranjang', $menu->id) }}" method="POST">
                                            @csrf
                                            <div class="mb-1">
                                                <label for="jumlah" class="form-label"
                                                    style="font-size: 0.8rem;">Jumlah</label>
                                                <div class="input-group">
                                                    <button class="btn btn-outline-secondary kurangModal" type="button"
                                                        data-menu-id="{{ $menu->id }}"
                                                        style="font-size: 0.7rem; padding: 0.2rem 0.5rem;">-</button>
                                                    <input type="number" name="jumlah"
                                                        id="jumlahModal{{ $menu->id }}"
                                                        class="form-control jumlah-input jumlahModal" value="1"
                                                        min="1" style="font-size: 0.8rem; padding: 0.2rem;">
                                                    <button class="btn btn-outline-secondary tambahModal" type="button"
                                                        data-menu-id="{{ $menu->id }}"
                                                        style="font-size: 0.7rem; padding: 0.2rem 0.5rem;">+</button>
                                                </div>
                                            </div>
                                            <p style="font-size: 0.8rem;">Total Harga: <span
                                                    id="totalHargaModal{{ $menu->id }}">Rp {{ $menu->harga }}</span>
                                            </p>
                                            <button type="submit" class="btn btn-primary"
                                                style="font-size: 0.8rem; padding: 0.3rem 0.6rem;">Tambah ke
                                                Keranjang</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endauth
    @else
        <div class="py-3">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
                @foreach ($menus as $menu)
                    <div class="col" data-menu-id="{{ $menu->id }}">
                        <div class="card h-100 shadow-sm rounded-4 overflow-hidden"
                            style="max-width: 250px; margin: auto;">
                            <div class="ratio ratio-1x1">
                                <img src="{{ url('storage/images/' . $menu->foto) }}"
                                    class="card-img-top img-fluid rounded-top-4" alt="{{ $menu->nama }}"
                                    style="object-fit: cover; height: 220px; pointer-events: none;">
                            </div>
                            <div class="card-body d-flex flex-column" style="padding: 0.75rem;">
                                <h5 class="card-title mb-1" style="font-size: 1rem;">{{ $menu->nama }}</h5>
                                <p class="card-text mb-1" style="font-size: 0.8rem;">{{ $menu->deskripsi }}</p>
                                <p class="card-text fw-bold text-primary mb-2" style="font-size: 0.9rem;">Rp
                                    {{ $menu->harga }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @auth
        @if (auth()->user()->role == 'admin')
            <div class="py-3">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
                    @foreach ($menus as $menu)
                        <div class="col" data-menu-id="{{ $menu->id }}">
                            <div class="card h-100 shadow-sm rounded-4 overflow-hidden"
                                style="max-width: 250px; margin: auto;">
                                <div class="ratio ratio-1x1">
                                    <img src="{{ url('storage/images/' . $menu->foto) }}"
                                        class="card-img-top img-fluid rounded-top-4" alt="{{ $menu->nama }}"
                                        style="object-fit: cover; height: 220px; pointer-events: none;">
                                </div>
                                <div class="card-body d-flex flex-column" style="padding: 0.75rem;">
                                    <h5 class="card-title mb-1" style="font-size: 1rem;">{{ $menu->nama }}</h5>
                                    <p class="card-text mb-1" style="font-size: 0.8rem;">{{ $menu->deskripsi }}</p>
                                    <p class="card-text fw-bold text-primary mb-2" style="font-size: 0.9rem;">Rp
                                        {{ $menu->harga }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
        @endif
        </div>
        </div>
        @endauth
    @else
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-3 mt-4">
                <form action="" method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control me-2" placeholder="Cari menu..."
                        value="">
                    <button type="submit" class="btn btn-outline-primary">Cari</button>
                </form>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <div class="text-center py-5 pt-5">
        <div class="py-5">
            <i class="fas fa-utensils fa-3x text-secondary mb-4"></i>
            <h5 class="fw-medium text-secondary">Belum ada menu yang tersedia</h5>
            <p class="text-muted">Klik tombol "Tambah" untuk membuat menu baru</p>
        </div>
    </div>

    @endif

    <div class="modal fade" id="confirmOrderModal" tabindex="-1" aria-labelledby="confirmOrderModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmOrderModalLabel">Konfirmasi Pesanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin memesan menu ini?</p>
                    <img src="{{ asset('assets/images/delivery.png') }}" alt="Ilustrasi Pengiriman"
                        class="img-fluid mb-3">
                    <p>Menu: <span id="namaMenuModal"></span></p>
                    <p>Jumlah: <span id="jumlahMenuModal"></span></p>
                    <p>Total Harga: <span id="totalHargaModal"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="sendOrderToWhatsApp()">Kirim ke
                        WhatsApp</button>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @auth
        @if (auth()->user()->role == 'user' && auth()->user()->id)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                function updateTotalHarga(menuId) {
                    const card = document.querySelector(`.col[data-menu-id="${menuId}"]`);

                    const hargaAwal = card.querySelector('.card-text.fw-bold.text-primary').innerText;
                    const hargaSatuan = parseFloat(hargaAwal.replace(/[^0-9]/g, ''));

                    const jumlahCard = parseInt(card.querySelector(`#jumlahCard${menuId}`).value);
                    const totalHargaCard = hargaSatuan * jumlahCard;

                    card.querySelector(`#totalHarga${menuId}`).innerText = 'Rp ' + totalHargaCard.toLocaleString(
                        'id-ID');

                    const modalBody = document.querySelector(`#menuModal${menuId} .modal-body`);
                    const hargaAwalModal = modalBody.dataset.harga;

                    const jumlahModal = parseInt(modalBody.querySelector(`#jumlahModal${menuId}`).value);
                    const totalHargaModal = hargaSatuan * jumlahModal;

                    modalBody.querySelector(`#totalHargaModal${menuId}`).innerText = 'Rp ' + totalHargaModal
                        .toLocaleString('id-ID');
                }

                document.querySelectorAll('.tambahCard').forEach(button => {
                    button.addEventListener('click', function() {
                        const menuId = this.dataset.menuId;
                        let jumlahInputCard = document.querySelector(
                            `.col[data-menu-id="${menuId}"] #jumlahCard${menuId}`);
                        let jumlahInputModal = document.querySelector(
                            `#menuModal${menuId} .modal-body #jumlahModal${menuId}`);

                        jumlahInputCard.value = parseInt(jumlahInputCard.value) + 1;
                        jumlahInputModal.value = parseInt(jumlahInputModal.value) + 1;

                        updateTotalHarga(menuId);
                    });
                });

                document.querySelectorAll('.kurangCard').forEach(button => {
                    button.addEventListener('click', function() {
                        const menuId = this.dataset.menuId;

                        let jumlahInputCard = document.querySelector(
                            `.col[data-menu-id="${menuId}"] #jumlahCard${menuId}`);
                        let jumlahInputModal = document.querySelector(
                            `#menuModal${menuId} .modal-body #jumlahModal${menuId}`);

                        let currentValue = parseInt(jumlahInputCard.value);
                        if (currentValue > 1) {
                            jumlahInputCard.value = currentValue - 1;
                            jumlahInputModal.value = currentValue - 1;
                            updateTotalHarga(menuId);
                        }
                    });
                });

                document.querySelectorAll('.tambahModal').forEach(button => {
                    button.addEventListener('click', function() {
                        const menuId = this.dataset.menuId;
                        let jumlahInputCard = document.querySelector(
                            `.col[data-menu-id="${menuId}"] #jumlahCard${menuId}`);
                        let jumlahInputModal = document.querySelector(
                            `#menuModal${menuId} .modal-body #jumlahModal${menuId}`);

                        jumlahInputCard.value = parseInt(jumlahInputCard.value) + 1;
                        jumlahInputModal.value = parseInt(jumlahInputModal.value) + 1;
                        updateTotalHarga(menuId);
                    });
                });

                document.querySelectorAll('.kurangModal').forEach(button => {
                    button.addEventListener('click', function() {
                        const menuId = this.dataset.menuId;
                        let jumlahInputCard = document.querySelector(
                            `.col[data-menu-id="${menuId}"] #jumlahCard${menuId}`);
                        let jumlahInputModal = document.querySelector(
                            `#menuModal${menuId} .modal-body #jumlahModal${menuId}`);
                        let currentValue = parseInt(jumlahInputModal.value);
                        if (currentValue > 1) {
                            jumlahInputCard.value = currentValue - 1;
                            jumlahInputModal.value = currentValue - 1;
                            updateTotalHarga(menuId);
                        }
                    });
                });

                const menuModals = document.querySelectorAll('.modal');
                menuModals.forEach(modal => {
                    modal.addEventListener('shown.bs.modal', function() {
                        const menuId = this.id.replace('menuModal', '');
                        updateTotalHarga(menuId);
                    });
                });

                // Event listener untuk tombol Pesan
                document.querySelectorAll('.pesanMenuBtn').forEach(button => {
                    button.addEventListener('click', function() {
                        const menuId = this.dataset.menuId;
                        const card = document.querySelector(`.col[data-menu-id="${menuId}"]`);
                        const namaMenu = card.querySelector('.card-title').innerText;
                        const jumlahMenu = card.querySelector(`#jumlahCard${menuId}`).value;
                        const totalHarga = card.querySelector(`#totalHarga${menuId}`).innerText;

                        document.querySelector('#namaMenuModal').innerText = namaMenu;
                        document.querySelector('#jumlahMenuModal').innerText = jumlahMenu;
                        document.querySelector('#totalHargaModal').innerText = totalHarga;

                        // Simpan data menu yang akan dipesan ke dalam modal
                        document.querySelector('#confirmOrderModal').dataset.menuId = menuId;
                        document.querySelector('#confirmOrderModal').dataset.jumlahMenu = jumlahMenu;
                    });
                });
            });

            async function sendOrderToWhatsApp() {
                const confirmOrderModal = document.querySelector('#confirmOrderModal');
                const menuId = confirmOrderModal.dataset.menuId;
                const jumlahMenu = confirmOrderModal.dataset.jumlahMenu;
                const card = document.querySelector(`.col[data-menu-id="${menuId}"]`);
                const namaMenu = card.querySelector('.card-title').innerText;
                const hargaMenu = card.querySelector('.card-text.fw-bold.text-primary').innerText;
                const totalHarga = card.querySelector(`#totalHarga${menuId}`).innerText; // Ambil total harga dari card


                const namaPengguna = "{{ Auth::user()->name }}";

                let message =
                    `Halo, saya ingin memesan:\n- ${namaMenu} (${jumlahMenu} x ${hargaMenu})\nTotal : ${totalHarga}\nAtas nama: ${namaPengguna}\nBukti pembayaran akan saya kirimkan. Terima kasih!`;

                const phoneNumber = "62881080811110";
                const encodedMessage = encodeURIComponent(message);
                const whatsappURL = `https://wa.me/${phoneNumber}?text=${encodedMessage}`;

                console.log("WhatsApp URL:", whatsappURL); // Tambahkan ini

                window.open(whatsappURL, '_blank');

                try {
                    const response = await fetch('{{ route('userr.prosesPembayaranMenu') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            menu_id: menuId,
                            jumlah: jumlahMenu
                        })
                    });

                    const data = await response.json();

                    if (data.success) {
                        alert(data.message);
                        window.location.href = '{{ route('userr.riwayatPesanan') }}';
                    } else {
                        alert(data.message);
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memproses pesanan.');
                }

                $('#confirmOrderModal').modal('hide');
            }
        </script>
                @endif
    @endauth
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
