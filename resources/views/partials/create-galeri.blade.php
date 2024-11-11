<div class="modal-header">
    <h5 class="modal-title" id="createGaleriLabel">Tambah Galeri</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
    <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="gambar">Unggah Gambar</label>
            <input type="file" name="gambar" class="form-control-file" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
