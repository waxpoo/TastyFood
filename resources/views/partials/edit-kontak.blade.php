{{-- resources/views/partials/edit-kontak.blade.php --}}
<div class="container mt-5">
    <h2>Edit Informasi Kontak</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('contact-info.update') }}" method="POST" id="contact-form">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $contact->email }}" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Telepon</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ $contact->phone }}" required>
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Lokasi</label>
            <input type="text" name="location" id="location" class="form-control" value="{{ $contact->location }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('contact-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Mencegah pengiriman form default
        const form = this;

        // Tampilkan loading spinner atau beritahu pengguna bahwa proses sedang berlangsung
        const submitButton = form.querySelector('button[type="submit"]');
        submitButton.disabled = true; // Nonaktifkan tombol submit
        submitButton.innerText = 'Mengirim...'; // Ubah teks tombol

        fetch(form.action, {
            method: form.method,
            body: new FormData(form)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Menangani respons sukses
            alert('Informasi kontak berhasil diperbarui!');
            // Jika Anda ingin memuat ulang atau menutup modal, lakukan di sini
            // location.reload(); // Memuat ulang halaman (opsional)
            // const modal = bootstrap.Modal.getInstance(document.getElementById('modal'));
            // modal.hide(); // Menutup modal (opsional)
        })
        .catch(error => {
            console.error('Error updating contact info:', error);
            alert('Terjadi kesalahan saat memperbarui informasi kontak.');
        })
        .finally(() => {
            submitButton.disabled = false; // Aktifkan kembali tombol submit
            submitButton.innerText = 'Simpan Perubahan'; // Kembalikan teks tombol
        });
    });
</script>
