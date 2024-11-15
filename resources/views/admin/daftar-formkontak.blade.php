<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar formKontak</title>
    <!-- Pastikan Bootstrap versi terbaru -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>

<body>
    <div class="container mt-4">
        <h2>Daftar Kontak</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Subject</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allKontak as $FormKontak)
                    <tr>
                        <td>{{ $FormKontak->id }}</td>
                        <td>{{ $FormKontak->subject }}</td>
                        <td>{{ $FormKontak->name }}</td>
                        <td>{{ $FormKontak->email }}</td>
                        <td>{{ Str::limit($FormKontak->message, 255) }}</td>
                        <td>
                            <!-- Tombol Edit -->
                            <button class="btn btn-warning"
                            onclick="openEditModal({{ $FormKontak->id }})">Edit</button>

                            <!-- Form Hapus -->
                            <form action="{{ route('formkontak.destroy', $FormKontak->id) }}" method="POST"
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

    <!-- Modal Edit Kontak -->
    <div class="modal fade" id="editModalKontak" tabindex="-1" aria-labelledby="editKontakLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                @include('partials.edit-formkontak') <!-- Menyertakan form edit -->
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function openEditModal(id) {
            $.get('/admin/formkontak/' + id + '/edit', function(data) {
                $('#editFormKontak').attr('action', '/admin/formkontak/' + id);

                // Isi form dengan data yang diperoleh
                $('#editSubject').val(data.subject);
                $('#editName').val(data.name);
                $('#editEmail').val(data.email);
                $('#editMessage').val(data.message);

              // Tampilkan modal
              $('#editModalKontak').modal('show');
            });
        }

        // Konfirmasi penghapusan kontak
        function confirmDeletion(event) {
            if (!confirm('Apakah Anda yakin ingin menghapus kontak ini?')) {
                event.preventDefault(); // Batalkan penghapusan jika tidak yakin
            }
        }
    </script>
</body>

</html>
