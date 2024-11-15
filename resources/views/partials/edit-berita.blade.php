<div class="modal-header">
    <h5 class="modal-title" id="createBeritaLabel">Edit Berita</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
    <form id="editFormBerita" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Menentukan method PUT -->

        <!-- Judul -->
        <div class="mb-3">
            <label for="editJudul" class="form-label">Judul:</label>
            <input type="text" id="editJudul" name="judul" class="form-control" required>
        </div>

        <!-- Isi Berita -->
        <div class="mb-3">
            <label for="editIsi" class="form-label">Isi Berita:</label>
            <textarea id="editIsi" name="isi" class="form-control" rows="5" required></textarea>
        </div>

        <!-- Gambar -->
        <div class="mb-3">
            <label for="editGambar" class="form-label">Gambar:</label>
            <input type="file" id="editGambar" name="gambar" class="form-control" accept="image/*">
        </div>

        <!-- Tombol Submit -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>
