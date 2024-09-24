<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasty Food</title>
    <link rel="stylesheet" href="css/tentang.css">
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
        <div class="hero-text">TENTANG KAMI</div>
    </section>

        <section class="about">
            <h2>TASTY FOOD</h2>
            <div class="about-content">
                <div class="about-text">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare,
                         augue eu rutrum commodo, dui diam convallis arcu, eget consectetur ex sem 
                         eget lacus. Nullam vitae dignissim neque, vel luctus ex. Fusce sit amet viverra ante.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu 
                        rutrum commodo, dui diam convallis arcu, eget consectetur ex sem eget lacus.</p>
                </div>
                <div class="about-images">
                    <img src="{{ asset('imm1.jpg') }}" alt="Food 1">
                    <img src="{{ asset('gambar7.jpg') }}" alt="Chef">
                </div>
            </div>
        </section>

        <section class="vision">
            <div class="vision-images">
                <img src="{{ asset('gambar8.jpg') }}" alt="Food 2">
                <img src="{{ asset('abcd.jpg') }}" alt="Food 3">
            </div>
            <div class="vision-text">
                <h2>VISI</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing. Fusce 
                    scelerisque magna nec cursus tempus. Duis viverra et turpis elementum,
                     vestibulum erat at, semper convallis dui. Pellentesque facilisis lectus vitae semper commodo.
                      Ut posuere eros ac consequat. Duis nec accumsan tortor. Nulla facilisi. dan bla bla bla blaaaaa banyak bangetttt ini i
                      sii asal aja saya juga gak tau mau apaa hahahaahhaha</p>
            </div>
        </section>

        <section class="mission">
            <div class="mission-text">
                <h2>MISI</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing
                    . Fusce scelerisque magna nec cursus tempus.
                     Duis viverra et turpis elementum, vestibulum erat at, semper convallis dui.
                      Pellentesque facilisis lectus vitae semper commodo. Ut posuere eros ac consequat.
                       Duis nec accumsan tortor. Nulla facilisi.</p>
            </div>
            <div class="mission-image">
                <img src="{{ asset('gambar6.jpg') }}" alt="Ingredients">
            </div>
        </section>
    </main>

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
</body>
</html>