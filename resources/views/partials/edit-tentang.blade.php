<div class="modal-header">
    <h5 class="modal-title" id="editTentangLabel">Edit Tentang</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
    <form action="{{ route('tentang.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') 

        <div class="mb-3">
            <label for="about_text" class="form-label">About</label>
            <textarea name="about_text" id="about_text" class="form-control" required>{{ $tentang->about_text }}</textarea>
        </div>

        <div class="mb-3">
            <label for="vision_text" class="form-label">Vision</label>
            <textarea name="vision_text" id="vision_text" class="form-control" required>{{ $tentang->vision_text }}</textarea>
        </div>

        <div class="mb-3">
            <label for="mission_text" class="form-label">Mission</label>
            <textarea name="mission_text" id="mission_text" class="form-control" required>{{ $tentang->mission_text }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button> <!-- Perbaiki tombol menjadi submit -->
    </form>
</div>
