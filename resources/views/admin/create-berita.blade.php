<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Berita</title>
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
</head>
<body>
    <header>
        <div class="header-content">
            <h1>Tambah Berita</h1>
            <a href="{{ route('admin.dashboard') }}" class="btn">Kembali ke Dashboard</a>
        </div>
    </header>

    <main>
        <!-- Formulir Create Berita -->
        <section>
            <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <label for="judul">Judul:</label>
                <input type="text" id="judul" name="judul" required>

                <label for="isi">Isi Berita:</label>
                <textarea id="isi" name="isi" rows="5" required></textarea>

                <label for="gambar">Gambar:</label>
                <input type="file" id="gambar" name="gambar" accept="image/*">
                
                <button type="submit" class="btn">Simpan Berita</button>
            </form>
        </section>
    </main>
</body>
</html>
