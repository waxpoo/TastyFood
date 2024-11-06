<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav class="sidebar">
            <h2>Admin Panel</h2>
            <ul>
                <li><a href="#" onclick="showModal('dashboard')">Dashboard</a></li>
                <li><a href="#" onclick="showModal('create-berita')">Tambah Berita</a></li>
                <li><a href="#" onclick="showModal('create-galeri')">Tambah Galeri</a></li>
                <li><a href="#" onclick="showModal('edit-kontak')">Edit KontakInfo</a></li>
                <li><a href="#" onclick="showModal('edit-tentang')">Edit Tentang Kami</a></li>
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                </li>
            </ul>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </nav>

        <div class="main-content">
            <header>
                <div class="header-content">
                    <h1>Dashboard Admin</h1>
                    <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
                    <a href="{{ route('home') }}" class="btn btn-primary">Kembali ke Halaman Utama</a>
                </div>
            </header>

            <main>
                <section class="dashboard-overview">
                    <h2>Selamat Datang, Admin</h2>
                    <div class="dashboard-cards d-flex justify-content-around">
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

    <!-- Modal -->
    <div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div id="modal-body">
                    <!-- Konten modal akan dimuat di sini -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showModal(modalName) {
            const modalBody = document.getElementById('modal-body');

            // Muat konten dari file partials
            fetch(`/partials/${modalName}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text();
                })
                .then(data => {
                    modalBody.innerHTML = data;
                    const modal = new bootstrap.Modal(document.getElementById('modal'));
                    modal.show();
                })
                .catch(error => console.error('Error loading modal:', error));
        }
        //fungsi sidebar
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('active');
        }
    </script>

</body>

</html>
