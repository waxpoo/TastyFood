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
                <li><a href="{{ route('home') }}">Halaman Utama</a></li>
                <li><a href="{{ route('logout') }}"
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

                <!-- Daftar berita -->
                <section class="all-articles">
                    <h2>Daftar Berita</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Isi</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allBerita as $berita)
                                <tr>
                                    <td>{{ $berita->judul }}</td>
                                    <td>{{ Str::limit($berita->isi, 100) }}</td>
                                    <td>{{ $berita->created_at->format('d-m-Y') }}</td>
                                    <td class="action-buttons">
                                        <a href="{{ route('berita.edit', $berita->id) }}" class="btn">Edit</a>
                                        <form action="{{ route('berita.destroy', $berita->id) }}" method="POST"
                                            style="display:inline;" onsubmit="confirmDeletion(event);">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>

                <!-- Daftar Galeri -->
                <section class="all-galleries">
                    <h2>Daftar Galeri</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Gambar</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allGaleri as $galeri)
                                <tr>
                                    <td>
                                        <img src="{{ Storage::url($galeri->gambar) }}" alt="Galeri Image"
                                            style="width: 100px; height: auto;">
                                    </td>
                                    <td>{{ $galeri->created_at->format('d-m-Y') }}</td>
                                    <td class="action-buttons">
                                        <a href="{{ route('galeri.edit', $galeri->id) }}" class="btn">Edit</a>
                                        <form action="{{ route('galeri.destroy', $galeri->id) }}" method="POST"
                                            style="display:inline;" onsubmit="confirmDeletion(event);">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>

            </main>
        </div>
    </div>
</body>

</html>
