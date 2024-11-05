<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Berita</title>
    <link rel="stylesheet" href="{{ asset('css/edit-berita.css') }}">
</head>
<body>
    <header>
        <div class="header-content">
            <h1>Edit Berita</h1>
            <a href="{{ route('admin.dashboard') }}" class="btn">Kembali ke Dashboard</a>
        </div>
    </header>

    <main>
        <!-- Formulir Edit Berita -->
        <section>
            <form action="{{ route('berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <label for="judul">Judul:</label>
                <input type="text" id="judul" name="judul" value="{{ old('judul', $berita->judul) }}" required>

                <label for="isi">Isi Berita:</label>
                <textarea id="isi" name="isi" rows="5" required>{{ old('isi', $berita->isi) }}</textarea>

                <label for="gambar">Gambar:</label>
                <input type="file" id="gambar" name="gambar" accept="image/*">

                <button type="submit" class="btn">Perbarui Berita</button>
            </form>
        </section>
    </main>
</body>
</html>
