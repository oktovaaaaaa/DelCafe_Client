

<footer id="footer" class="footer">

    {{-- <div class="footer-newsletter">
      <div class="container">
        <div class="row justify-content-center text-center">
          <div class="col-lg-6">
            <h4>Join Our Newsletter</h4>
            <p>Subscribe to our newsletter and receive the latest news about our products and services!</p>
            <form action="forms/newsletter.php" method="post" class="php-email-form">
              <div class="newsletter-form"><input type="email" name="email"><input type="submit" value="Subscribe"></div>
              <div class="loading">Loading</div>
              <div class="error-message"></div>
              <div class="sent-message">Your subscription request has been sent. Thank you!</div>
            </form>
          </div>
        </div>
      </div>
    </div> --}}

<div class="container footer-top">
    <div class="row gy-4">
      <div class="col-lg-4 col-md-6 footer-about">
        <a href="index.html" class="d-flex align-items-center">
          <span class="sitename">DEL Cafe</span>
        </a>
        <div class="footer-contact pt-3">
          <p>Institut Teknologi DEL</p>
          <p> Sitoluama, Kec. Balige, Toba, Sumatera Utara 22381</p>
          <p class="mt-3"><strong>Phone:</strong> <span>+62 881 0808 11110</span></p>
          <p><strong>Email:</strong> <span>delcafe@gmail.com</span></p>
        </div>
      </div>

      <div class="col-lg-2 col-md-3 footer-links">
        <h4>Tautan Berguna</h4>
        <ul>
          <li><i class="bi bi-chevron-right"></i> <a href="{{ url('') }}">Beranda</a></li>
          <li><i class="bi bi-chevron-right"></i> <a href="{{route('userr.tentang')}}">Tentang Del Cafe</a></li>
          <li><i class="bi bi-chevron-right"></i> <a href="{{route('userr.galeri')}}">Galeri</a></li>
          {{-- <li><i class="bi bi-chevron-right"></i> <a href="#">Terms of service</a></li> --}}
        </ul>
      </div>

      <div class="col-lg-2 col-md-3 footer-links">
        <h4>Layanan</h4>
        <ul>
          <li><i class="bi bi-chevron-right"></i> <a href="{{ route('kontakuserr') }}">Kontak</a></li>
          <li><i class="bi bi-chevron-right"></i> <a href="{{ route('testimoni.index') }}">Testimoni</a></li>
          {{-- <li><i class="bi bi-chevron-right"></i> <a href="#">Product Management</a></li>
          <li><i class="bi bi-chevron-right"></i> <a href="#">Marketing</a></li> --}}
        </ul>
      </div>

      <div class="col-lg-4 col-md-12">
        <h4>Ikuti kami</h4>
        <p>Kontak dan media sosial</p>
        <div class="social-links d-flex">
            <a href=""><i class="bi bi-whatsapp"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            {{-- <a href=""><i class="bi bi-twitter-x"></i></a> --}}
        </div>
      </div>

    </div>
  </div>

  <div class="container copyright text-center mt-4">
    <p>© <span>Copyright</span> <strong class="px-1 sitename">PA-1</strong> <span>Kelompok 11</span></p>
    <div class="credits">

      Dibuat oleh <a href="https://www.linkedin.com/in/oktova-samosir-2a838334a/">Oktova Samosir</a>
    </div>
  </div>

</footer>

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>




