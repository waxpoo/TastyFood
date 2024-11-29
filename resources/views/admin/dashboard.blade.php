<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>

<body class="light-mode"> <!-- Default to light mode -->
    <div class="wrapper">
        <!-- Sidebar -->
        <nav class="sidebar">
            <h2>Admin Panel</h2>
            <ul>
                <li><a href="#" onclick="showModal('create-berita')">Tambah Berita</a></li>
                <li><a href="#" onclick="showModal('create-galeri')">Tambah Galeri</a></li>
                <li><a href="#" onclick="showModal('edit-kontak')">Edit KontakInfo</a></li>
                <li><a href="#" onclick="showModal('edit-tentang')">Edit Tentang Kami</a></li>
                <li><a href="#" onclick="toggleDarkMode()">🌓 Dark Mode</a></li>
            </ul>
            <!-- Tombol logout di bawah -->
            <div class="logout-container">
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </nav>


        <div class="main-content">
            <header>
                <div class="header-content">
                    <h1>Dashboard Admin</h1>
                    <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
                    <a href="{{ route('home') }}" class="btn btn-primary">Lihat halaman utama</a>
                </div>
            </header>

            <main>
                <section class="dashboard-overview">
                    <h2>Selamat Datang, Admin</h2>
                    <div class="dashboard-cards d-flex justify-content-around">
                        <div class="card" onclick="window.location.href='{{ route('admin.daftar-berita') }}'">
                            <h3>Total Berita</h3>
                            <p><a href="{{ route('admin.daftar-berita') }}">{{ $totalBerita }}</a></p>
                        </div>
                        <div class="card" onclick="window.location.href='{{ route('admin.daftar-galeri') }}'">
                            <h3>Total Galeri</h3>
                            <p><a href="{{ route('admin.daftar-galeri') }}">{{ $totalGaleri }}</a></p>
                        </div>
                        <div class="card" onclick="window.location.href='{{ route('admin.daftar-formkontak') }}'">
                            <h3>Total Kontak</h3>
                            <p><a href="{{ route('admin.daftar-formkontak') }}">{{ $totalKontak }}</a></p>
                        </div>
                    </div>
                </section>

                @include('admin.daftar-berita')
                @include('admin.daftar-galeri')
                @include('admin.daftar-formkontak')
            </main>
        </div>
    </div>

    {{-- buat berita --}}
    <div class="modal fade" id="create-berita" tabindex="-1" aria-labelledby="createBeritaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">@include('partials.create-berita')</div>
            </div>
        </div>
    </div>

    {{-- buat galeri --}}
    <div class="modal fade" id="create-galeri" tabindex="-1" aria-labelledby="createGaleriLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">@include('partials.create-galeri')</div>
            </div>
        </div>
    </div>

    {{-- edit kontak --}}
    <div class="modal fade" id="edit-kontak" tabindex="-1" aria-labelledby="editKontakLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    @include('partials.edit-kontak')
                </div>
            </div>
        </div>
    </div>

    {{-- edit tentang --}}
    <div class="modal fade" id="edit-tentang" tabindex="-1" aria-labelledby="editTentangLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">@include('partials.edit-tentang')</div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Berita -->
    <div class="modal fade" id="editModalBerita" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                @include('partials.edit-berita')
            </div>
        </div>
    </div>

    <!-- Modal Edit Kontak -->
    <div class="modal fade" id="editModalKontak" tabindex="-1" aria-labelledby="editKontakLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                @include('partials.edit-formkontak')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Fungsi Sidebar
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('active');
        }

        // Fungsi Menampilkan Modal
        function showModal(modalId) {
            const modal = new bootstrap.Modal(document.getElementById(modalId));
            modal.show();
        }

     

        // Konfirmasi Penghapusan
        function confirmDeletion(event) {
            if (!confirm('Apakah Anda yakin ingin menghapus item ini?')) {
                event.preventDefault(); // Membatalkan aksi jika tidak yakin
            }
        }

        // Fungsi Dark Mode
        function toggleDarkMode() {
            const body = document.body;

            // Toggle class dark mode dan light mode
            body.classList.toggle('dark-mode');
            body.classList.toggle('light-mode');

            // Menyimpan preferensi tema ke localStorage
            if (body.classList.contains('dark-mode')) {
                localStorage.setItem('theme', 'dark');
            } else {
                localStorage.setItem('theme', 'light');
            }
        }

        // Memuat Preferensi Tema saat Halaman Dimuat
        window.onload = function() {
            const theme = localStorage.getItem('theme');
            const body = document.body;

            // Jika preferensi dark mode ditemukan, menerapkannya
            if (theme === 'dark') {
                body.classList.add('dark-mode');
                body.classList.remove('light-mode');
            } else {
                body.classList.remove('dark-mode');
                body.classList.add('light-mode');
            }
        }

        // Fungsi untuk Membuka Modal Create Berita
        function openCreateBerita() {
            const modal = new bootstrap.Modal(document.getElementById('create-berita'));
            modal.show();
        }

        // Fungsi untuk Membuka Modal Create Galeri
        function openCreateGaleri() {
            const modal = new bootstrap.Modal(document.getElementById('create-galeri'));
            modal.show();
        }

        // Fungsi Global untuk Memuat Data Modal Secara Dinamis
        function loadModalContent(modalId, url) {
            $.get(url, function(data) {
                $(`#${modalId} .modal-body`).html(data);

                // Menampilkan modal
                const modal = new bootstrap.Modal(document.getElementById(modalId));
                modal.show();
            }).fail(function() {
                alert('Gagal memuat konten modal. Silakan coba lagi.');
            });
        }
    </script>

</body>

</html>
