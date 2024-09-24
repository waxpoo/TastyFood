<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Gambar Galeri</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>

<body>
    <div class="container">
        <h1>Edit Gambar Galeri</h1>

        <form action="{{ route('galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="gambar">Unggah Gambar</label>
                <input type="file" name="gambar" class="form-control-file">
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
</body>

</html>
