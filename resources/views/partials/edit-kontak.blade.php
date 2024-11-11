<div class="modal-header">
    <h5 class="modal-title">Edit kontak</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">

    <form action="{{ route('kontak.update') }}" method="POST" id="contact-form">
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

        <button type="button" class="btn btn-primary">Simpan Perubahan</button>
    </form>

</div>

