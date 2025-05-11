<style>
    #sidebar .sidebar-link {
        text-decoration: none;
    }
</style>

<div class="wrapper">
    <aside id="sidebar">
        <div class="d-flex">
            <button class="toggle-btn" type="button">
                <i class="bi bi-grid"></i> <!-- Ikon grid dari Bootstrap Icons -->
            </button>
            <div class="sidebar-logo">
                <a href="#">DelCafe</a>
            </div>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a href="{{route('menus.tampilan')}}" class="sidebar-link">
                    <i class="bi bi-menu-up"></i>  <!-- Ikon menu makanan -->
                    <span>Menu Makanan</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{route('jadwals.tampilan')}}" class="sidebar-link">
                    <i class="bi bi-clock"></i> <!-- Ikon jadwal/jam -->
                    <span>Jadwal</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{route('tentangs.tampilan')}}" class="sidebar-link">
                    <i class="bi bi-info-circle"></i> <!-- Ikon about -->
                    <span>Tentang</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{route('galeris.tampilan')}}" class="sidebar-link">
                    <i class="bi bi-images"></i> <!-- Ikon galeri -->
                    <span>Galeri</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{route('testimonis.index')}}" class="sidebar-link">
                    <i class="bi bi-chat-quote"></i>
                    <span>Testimoni</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{route('pengumumans.tampilan')}}" class="sidebar-link">
                    <i class="bi bi-megaphone"></i>
                    <span>Pengumuman</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="{{route('kontaks.tampilan')}}" class="sidebar-link">
                    <i class="bi bi-bell"></i>
                    <span>Notifikasi Pesan</span>
                </a>
                <li class="sidebar-item">
                    <a href="{{route('riwayat.tampilan')}}" class="sidebar-link">
                        <i class="bi bi-clock-history"></i>
                        <span>Riwayat Pemesanan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{route('home')}}" class="sidebar-link">
                        <i class="bi bi-house"></i>
                        <span>Home User</span>
                    </a>
                </li>
            </li>
            <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">Login</a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">Register</a>
                </li>
            </ul>
        </li>
    </ul>
    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="sidebar-link" style="border: none; background: none; padding: 0; margin: 0; color: inherit; cursor: pointer;">
                <a class="sidebar-link">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </a>
            </button>
        </form>
    </div>
</aside>
<div class="main p-3">
    <div class="text-center">
    </div>
</div>
</div>


{{-- <li class="sidebar-item">
    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
    data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
    <i class="bi bi-shield-lock"></i> <!-- Ikon auth -->
    <span>Auth</span>
</a> --}}
