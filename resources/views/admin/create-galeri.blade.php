<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Gambar Galeri</title>
    <link rel="stylesheet" href="{{ asset('css/create-galeri.css') }}">
</head>
<body>
    <div class="container">
        <h1>Tambah Gambar Galeri</h1>

        <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="gambar">Unggah Gambar</label>
                <input type="file" name="gambar" class="form-control-file" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</body>
</html>
