<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasty Food - Galeri Kami</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/galeri.css">
    <link rel="stylesheet" href="css/responsive.css">
</head>

<body>
    <header>
        <div class="logo">TASTY FOOD</div>
        <nav>
            <ul>
                <li><a href="/">HOME</a></li>
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

    <section class="gallery-section">
        <div class="gallery-container2">
            @foreach ($galeriList as $galeri)
                <div class="gallery-item2">
                    <img src="{{ asset('storage/galeri/' . $galeri->gambar) }}" alt="Image {{ $loop->index + 1 }}" class="img-fluid">
                </div>
            @endforeach
        </div>

        <div class="pagination-controls">
            {{ $galeriList->links() }} <!-- Memanggil links() pada objek paginasi -->
        </div>
    </section>

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
        const images = ['imm2.jpg', 'imm1.jpg', 'imm3.jpg'];
        let currentIndex = 0;
        const galleryImage = document.getElementById('galleryImage');
        const indicators = document.querySelectorAll('.indicator div');

        function showImage(index, direction) {
            const currentImage = document.createElement('img');
            currentImage.src = images[currentIndex];
            currentImage.classList.add('active'); // Tambahkan kelas 'active' untuk gambar yang sedang ditampilkan

            const nextImage = document.createElement('img');
            nextImage.src = images[index];
            nextImage.classList.add(direction === 'next' ? 'next' : 'prev'); // Tentukan arah pergeseran

            const galleryItem = document.querySelector('.gallery-item');
            galleryItem.appendChild(nextImage);

            setTimeout(() => {
                currentImage.classList.remove('active');
                nextImage.classList.add('active'); // Jadikan gambar baru sebagai 'active'
                nextImage.classList.remove(direction === 'next' ? 'next' : 'prev'); // Hilangkan kelas 'next' atau 'prev'

                setTimeout(() => {
                    galleryItem.removeChild(currentImage); // Hapus gambar lama setelah transisi selesai
                }, 500); // Durasi transisi sesuai dengan CSS
            }, 0);

            currentIndex = index; // Update indeks gambar aktif

            indicators.forEach((indicator, i) => {
                indicator.classList.toggle('active', i === index); // Ubah indikator aktif
            });
        }

        document.getElementById('prev').addEventListener('click', () => {
            const newIndex = (currentIndex > 0) ? currentIndex - 1 : images.length - 1;
            showImage(newIndex, 'prev');
        });

        document.getElementById('next').addEventListener('click', () => {
            const newIndex = (currentIndex < images.length - 1) ? currentIndex + 1 : 0;
            showImage(newIndex, 'next');
        });

        indicators.forEach((indicator, i) => {
            indicator.addEventListener('click', () => {
                const direction = (i > currentIndex) ? 'next' : 'prev';
                showImage(i, direction);
            });
        });

        showImage(currentIndex, 'next'); // Tampilkan gambar pertama dengan transisi ke kanan
    </script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
