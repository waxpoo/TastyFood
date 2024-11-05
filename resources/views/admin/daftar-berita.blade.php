<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Berita</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>

<body>
    <div class="container mt-4">
        <h2>Daftar Berita</h2>
      <li><a href="#" onclick="showModal('create-berita')">Tambah Berita</a></li>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Isi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($allBerita as $berita)
                    <tr>
                        <td>{{ $berita->id }}</td>
                        <td>{{ $berita->judul }}</td>
                        <td>{{ Str::limit($berita->isi, 50) }}</td>
                        <td>
                            <a href="{{ route('berita.edit', $berita->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('berita.destroy', $berita->id) }}" method="POST" style="display:inline;">
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
