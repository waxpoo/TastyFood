<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Berita</title>
    <!-- Pastikan Bootstrap versi terbaru jika memungkinkan -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>

<body>
    <div class="container mt-4">
        <h2>Daftar Berita</h2>
        <a href="#" class="btn btn-primary" onclick="showModal('create-berita')">Tambah Berita</a>
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
                @foreach ($allBerita as $berita)
                    <tr>
                        <td>{{ $berita->id }}</td>
                        <td>{{ $berita->judul }}</td>
                        <td>{{ Str::limit($berita->isi, 255) }}</td>
                        <td>
                            {{-- tombol edit --}}
                            <button class="btn btn-warning" onclick="openEditModal({{ $berita->id }})">Edit</button>
                            {{-- tombol delete --}}
                            <form action="{{ route('berita.destroy', $berita->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="confirmDeletion(event)">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Edit Berita -->
    <div class="modal fade" id="editModalBerita" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                @include('partials.edit-berita')
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Fungsi untuk membuka modal edit berita
        function openEditModal(id) {
            $.get('/admin/berita/' + id + '/edit', function(data) {
                $('#editFormBerita').attr('action', '/admin/berita/' + id);

                // Isi form dengan data yang didapatkan
                $('#editJudul').val(data.judul);
                $('#editIsi').val(data.isi);

                // Tampilkan modal
                $('#editModalBerita').modal('show');
            });
        }

        // Konfirmasi penghapusan berita
        function confirmDeletion(event) {
            if (!confirm('Apakah Anda yakin ingin menghapus berita ini?')) {
                event.preventDefault(); // Batalkan penghapusan jika tidak yakin
            }
        }
    </script>
</body>

</html>
