<div class="modal-header">
    <h5 class="modal-title" id="editKontakLabel">Edit Form Kontak</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
    <form id="editFormKontak" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Menentukan method PUT -->

        <!-- Subject -->
        <div class="mb-3">
            <label for="editSubject" class="form-label">Subject:</label>
            <input type="text" id="editSubject" name="subject" class="form-control"
                value="{{ $FormKontak->subject }}" required>
        </div>

        <!-- Name -->
        <div class="mb-3">
            <label for="editName" class="form-label">Name:</label>
            <input type="text" id="editName" name="name" class="form-control" value="{{ $FormKontak->name }}"
                required>
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="editEmail" class="form-label">Email:</label>
            <input type="email" id="editEmail" name="email" class="form-control" value="{{ $FormKontak->email }}"
                required>
        </div>

        <!-- Message -->
        <div class="mb-3">
            <label for="editMessage" class="form-label">Message:</label>
            <textarea id="editMessage" name="message" class="form-control" rows="5" required>{{ $FormKontak->message }}</textarea>
        </div>

        <!-- Tombol Submit -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>
