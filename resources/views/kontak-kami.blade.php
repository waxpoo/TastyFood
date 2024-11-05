<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasty Food - Kontak Kami</title>
    <link rel="stylesheet" href="{{ asset('css/kontak.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .popup {
            display: flex;
            align-items: center;
            justify-content: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7); /* Background semi-transparan */
            z-index: 1000; /* Memastikan popup berada di atas elemen lain */
        }

        .popup-content {
            background-color: #fff; /* Warna latar belakang popup */
            border-radius: 10px; /* Sudut melengkung */
            padding: 20px;
            text-align: center; /* Teks terpusat */
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5); /* Bayangan untuk efek kedalaman */
            width: 300px; /* Lebar popup */
        }

        .popup h2 {
            margin-bottom: 10px; /* Jarak bawah untuk heading */
        }

        .popup p {
            margin-bottom: 20px; /* Jarak bawah untuk teks */
        }

        .popup button {
            background-color: #f76c6c; /* Warna tombol */
            color: #fff; /* Warna teks tombol */
            border: none;
            border-radius: 5px; /* Sudut tombol melengkung */
            padding: 10px 15px; /* Padding tombol */
            cursor: pointer;
            transition: background-color 0.3s; /* Transisi warna tombol */
        }

        .popup button:hover {
            background-color: #e65c5c; /* Warna tombol saat hover */
        }

        .checkmark {
            width: 50px; /* Sesuaikan ukuran sesuai kebutuhan */
            animation: fadeIn 0.5s ease-in-out; /* Animasi muncul */
            margin-bottom: 15px; /* Jarak bawah untuk gambar centang */
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.8); /* Mulai dari ukuran kecil */
            }
            to {
                opacity: 1;
                transform: scale(1); /* Ukuran penuh */
            }
        }
    </style>
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
        <div class="hero-text">KONTAK KAMI</div>
    </section>

    <main>
        <section class="contact-form">
            <h2>KONTAK KAMI</h2>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form id="contactForm" action="{{ route('kontak.store') }}" method="POST">
                @csrf
                <div class="form-left">
                    <div class="form-group">
                        <input type="text" id="subject" name="subject" placeholder="Subject" required>
                    </div>
                    <div class="form-group">
                        <input type="text" id="name" name="name" placeholder="Name" required>
                    </div>
                    <div class="form-group">
                        <input type="email" id="email" name="email" placeholder="Email" required>
                    </div>
                </div>
                <div class="form-right">
                    <div class="form-group">
                        <textarea id="message" name="message" placeholder="Message" required></textarea>
                    </div>
                </div>
                <button type="submit" onclick="showPopup(event)">KIRIM</button>
            </form>

            <!-- Popup Konfirmasi -->
            <div class="popup" id="popup" style="display: none;">
                <div class="popup-content">
                    <img src="{{ asset('checkmark.png') }}" alt="Centang" class="checkmark" id="checkmark" style="display: none;">
                    <h2>Konfirmasi</h2>
                    <p>Apakah Anda yakin ingin mengirim pesan?</p>
                    <button onclick="confirmSubmit()">Ya, Kirim</button>
                    <button class="close" onclick="hidePopup()">Batal</button>
                </div>
            </div>
        </section>

        <section class="kontak-kami-content">
            <div class="container">
                @if (session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="contact-info">
                    <div>
                        <img src="{{ asset('email.png') }}" alt="Email Icon" class="contact-icon">
                        <i class="fas fa-envelope"></i>
                        <h3>EMAIL</h3>
                        <p>{{ $contact->email }}</p>
                    </div>
                    <div>
                        <img src="{{ asset('telephone.png') }}" alt="Phone Icon" class="contact-icon">
                        <i class="fas fa-phone"></i>
                        <h3>TELEPON</h3>
                        <p>{{ $contact->phone }}</p>
                    </div>
                    <div>
                        <img src="{{ asset('lokasi.png') }}" alt="Location Icon" class="contact-icon">
                        <i class="fas fa-map-marker-alt"></i>
                        <h3>LOKASI</h3>
                        <p>{{ $contact->location }}</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="map-container">
            <div class="map-wrapper">
                <iframe
                    src="https://www.google.com/maps/embed/v1/place?q={{ urlencode($contact->location) }}&key=AIzaSyCtQ8aYQTRFo4aCLv5n2O5L5RI_KcBGY0Y"
                    allowfullscreen="" loading="lazy">
                </iframe>
            </div>
        </section>

        <footer>
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Tasty Food</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                        commodo consequat.</p>
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
    </main>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>

<script>
    function showPopup(event) {
        event.preventDefault(); // Mencegah pengiriman formulir
        document.getElementById('popup').style.display = 'flex'; // Tampilkan popup
    }

    function hidePopup() {
        document.getElementById('popup').style.display = 'none'; // Sembunyikan popup
    }

    function confirmSubmit() {
        document.getElementById('checkmark').style.display = 'block'; // Tampilkan gambar centang
        setTimeout(function() {
            document.getElementById('contactForm').submit(); // Kirim formulir setelah 1 detik
        }, 1000); // Waktu delay sebelum mengirim formulir
    }
</script>

</html>
