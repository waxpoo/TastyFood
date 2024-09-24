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

<style>
   /* Header CSS */
header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 50px;
    background-color: transparent;
    color: #fff;
    position: fixed;
    width: 100%;
    z-index: 1000;
}

header .logo {
    font-size: 24px;
    font-weight: bold;
}

header nav ul {
    display: flex;
    list-style: none;
}

header nav ul li {
    margin-left: 20px;
}

header nav ul li a {
    text-decoration: none;
    color: #fff;
    font-weight: bold;
    transition: color 0.3s ease;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
}

header nav ul li a:hover {
    color: #f4f4f4;
}

/* Hero Section CSS */
.hero {
    position: relative;
    text-align: center;
    color: white;
}

.hero img {
    width: 100%;
    height: 500px;
    object-fit: cover;
}

.hero .hero-text {
    position: absolute;
    top: 50%;
    left: 13%;
    transform: translate(-50%, -50%);
    font-size: 48px;
    font-weight: bold;
}