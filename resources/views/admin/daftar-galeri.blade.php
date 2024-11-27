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
        <a href="#" class="btn btn-primary" onclick="showModal('create-galeri')">Tambah galeri</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Gambar</th> <!-- Kolom untuk menampilkan gambar -->
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allGaleri as $galeri)
                    <tr>
                        <td>{{ $galeri->id }}</td>
                        <td>
                            <!-- Menampilkan gambar galeri dengan ukuran yang sama -->
                            <img src="{{ asset('storage/galeri/' . $galeri->gambar) }}" alt="Gambar Galeri"
                                style="width: 80px; height: 80px; object-fit: cover;">
                        </td>
                        <td>
                            <!-- Tombol untuk membuka modal edit gambar galeri -->
                            <form action="{{ route('galeri.destroy', $galeri->id) }}" method="POST"
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

    <!-- Modal Create Galeri -->
    <div id="create-galeri" class="modal fade" tabindex="-1" aria-labelledby="createGaleriLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                @include('partials.create-galeri')
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
        // Fungsi untuk membuka modal tambah atau edit galeri
        function showModal(modalId) {
            const modalElement = document.getElementById(modalId);
            const bootstrapModal = new bootstrap.Modal(modalElement);
            bootstrapModal.show();
        }


        // Konfirmasi penghapusan galeri
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
