<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita - Tasty Food</title>
    <link rel="stylesheet" href="{{ asset('css/berita.css') }}">
    <link rel="stylesheet" href="css/responsive.css">
</head>

<body>

    <header>
        <div class="logo">TASTY FOOD</div>
        <nav>
            <ul>
                <li><a href="http://127.0.0.1:8000/">HOME</a></li>
                <li><a href="tentang-kami">TENTANG</a></li>
                <li><a href="berita-kami">BERITA</a></li>
                <li><a href="galeri-kami">GALERI</a></li>
                <li><a href="kontak-kami">KONTAK</a></li>
            </ul>
        </nav>
    </header>

    <section class="hero">
        <img src="asd.png" alt="Hero Image">
        <div class="hero-text">BERITA KAMI</div>
    </section>

    <main>
        <section class="main-article">
            <img src="imm3.jpg" alt="Main Article Image">
            <div class="main-article-content">
                <h3>APA SAJA MAKANAN KHAS </h3>
                <h3>NUSANTARA?</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo,
                    dui diam convallis arcu, eget consectetur ex sem eget lacus. Nullam vitae dignissim neque, vel
                    luctus ex. Fusce sit amet viverra ante.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo,
                    dui diam convallis arcu, eget consectetur ex sem eget lacus. Nullam vitae dignissim neque, vel
                    luctus ex. Fusce sit amet viverra ante.</p>
                <a href="#" class="btn">Baca Selengkapnya</a>
            </div>
        </section>

        <section class="other-articles">
            <h3>Berita Lainnya</h3>

            <div class="article-grid">
                @foreach ($berita as $item)
                    <div class="article-card">
                        @if ($item->gambar)
                            <img src="{{ asset('storage/gambar/' . $item->gambar) }}" alt="{{ $item->gambar }}">
                        @else
                            <img src="{{ asset('images/....') }}" alt="Gambar Default">
                        @endif
                        <div class="article-content">
                            <h4>{{ $item->judul }}</h4>
                            <p>{{ Str::limit($item->isi, 100) }}</p>
                            <a href="#" class="btn">Baca Selengkapnya</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>Tasty Food</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut enim ad minim veniam, quis nostrud
                    exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                <div class="social-icons">
                    <a href="#"><img src="{{ asset('001-facebook.png') }}" alt="Facebook"></a>
                    <a href="#"><img src="{{ asset('002-twitter.png') }}" alt="Twitter"></a>
                </div>
            </div>
            <div class="footer-section">
                <h3>Useful links</h3>
                <ul>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Hewan</a></li>
                    <li><a href="#">Galeri</a></li>
                    <li><a href="#">Testimonial</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Privacy</h3>
                <ul>
                    <li><a href="#">Karir</a></li>
                    <li><a href="#">Tentang Kami</a></li>
                    <li><a href="#">Kontak Kami</a></li>
                    <li><a href="#">Servis</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Contact Info</h3>
                <p>tastyfood@gmail.com</p>
                <p>+62 812 3456 7890</p>
                <p>Kota Bandung, Jawa Barat</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2023 All rights reserved</p>
        </div>
    </footer>

</body>

</html>
