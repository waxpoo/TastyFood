<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Galeri</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>

<body>
    <div class="container mt-4">
        <h2>Daftar Galeri</h2>
        <a href="{{ route('galeri.create') }}" class="btn btn-primary mb-3">Tambah Galeri</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($allGaleri as $galeri)
                    <tr>
                        <td>{{ $galeri->id }}</td>
                        <td>
                            <a href="{{ route('galeri.edit', $galeri->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('galeri.destroy', $galeri->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="confirmDeletion(event)">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

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
</body>

</html>
