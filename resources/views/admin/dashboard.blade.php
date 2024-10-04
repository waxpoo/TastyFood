<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <script>
        function confirmDeletion(event) {
            event.preventDefault();
            const form = event.target.closest('form');
            const confirmation = confirm('Apakah Anda yakin ingin menghapus item ini?');
            if (confirmation) {
                form.submit();
            }
        }
    </script>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav class="sidebar">
            <h2>Admin Panel</h2>
            <ul>
                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('berita.create') }}">Tambah Berita</a></li>
                <li><a href="{{ route('galeri.create') }}">Tambah Galeri</a></li>
                <li><a href="{{ route('edit.map') }}">Edit Peta</a></li>
                <li><a href="{{ route('edit-tentang') }}">Edit Tentang Kami</a></li>
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                </li>
            </ul>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </nav>

        <!-- Main Content -->
        <div class="main-content">
            <header>
                <div class="header-content">
                    <h1>Dashboard Admin</h1>
                    <a href="{{ route('home') }}" class="btn">Kembali ke Halaman Utama</a>
                    <a href="{{ route('daftar-berita') }}" class="btn">Daftar Berita</a>
                    <a href="{{ route('daftar-galeri') }}" class="btn">Daftar Galeri</a>
                </div>
            </header>

            <main>
                <section class="dashboard-overview">
                    <h2>Selamat Datang, Admin</h2>
                    <div class="dashboard-cards">
                        <div class="card">
                            <h3>Total Berita</h3>
                            <p>{{ $totalBerita }}</p>
                        </div>
                        <div class="card">
                            <h3>Total Galeri</h3>
                            <p>{{ $totalGaleri }}</p>
                        </div>
                    </div>
                </section>

                <!-- Sertakan Daftar Berita -->
                @include('admin.daftar-berita')

                <!-- Sertakan Daftar Galeri -->
                @include('admin.daftar-galeri')

            </main>
        </div>
    </div>
</body>

</html>
