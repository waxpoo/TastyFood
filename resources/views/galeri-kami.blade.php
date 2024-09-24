<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasty Food - Galeri Kami</title>
    <link rel="stylesheet" href="css/galeri.css">
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
        <div class="hero-text">GALERI KAMI</div>
    </section>

    <div class="gallery-container">
        <div class="gallery-item">
            <img id="galleryImage" src="https://via.placeholder.com/600x400" alt="Gallery Image">
            <div class="controls">
                <button id="prev">&lt;</button>
                <button id="next">&gt;</button>
            </div>
            <div class="indicator" id="indicator">
                <div class="active"></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>

    <div class="gallery-container2">
        @foreach ($galeriList as $galeri)
            <div class="gallery-item2">
                <img src="{{ asset('storage/galeri/' . $galeri->gambar) }}" alt="Image {{ $loop->index + 1 }}">
            </div>
        @endforeach
    </div>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>Tasty Food</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut enim ad minim veniam...</p>
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

    <script>
        const images = ['imm2.jpg'];
        let currentIndex = 0;
        const galleryImage = document.getElementById('galleryImage');
        const indicators = document.querySelectorAll('.indicator div');

        function showImage(index) {
            galleryImage.src = images[index];
            indicators.forEach((indicator, i) => {
                indicator.classList.toggle('active', i === index);
            });
        }

        document.getElementById('prev').addEventListener('click', () => {
            currentIndex = (currentIndex > 0) ? currentIndex - 1 : images.length - 1;
            showImage(currentIndex);
        });

        document.getElementById('next').addEventListener('click', () => {
            currentIndex = (currentIndex < images.length - 1) ? currentIndex + 1 : 0;
            showImage(currentIndex);
        });

        indicators.forEach((indicator, i) => {
            indicator.addEventListener('click', () => {
                currentIndex = i;
                showImage(currentIndex);
            });
        });

        showImage(currentIndex);
    </script>
</body>
</html>
