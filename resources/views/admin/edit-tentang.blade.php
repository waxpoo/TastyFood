<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/edit-tentang.css') }}">
    <title>Edit Tentang Kami</title>
</head>
<body>
    <h1>Edit Tentang Kami</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form id="updateForm" action="{{ route('update-tentang') }}" method="POST" onsubmit="showPopup(event)">
        @csrf
        @method('PUT')

        <div>
            <label for="about_text">About</label>
            <textarea name="about_text" id="about_text" required>{{ $tentang->about_text }}</textarea>
        </div>

        <div>
            <label for="vision_text">Vision</label>
            <textarea name="vision_text" id="vision_text" required>{{ $tentang->vision_text }}</textarea>
        </div>

        <div>
            <label for="mission_text">Mission</label>
            <textarea name="mission_text" id="mission_text" required>{{ $tentang->mission_text }}</textarea>
        </div>

        <button type="submit">Update</button>
    </form>

    <!-- Popup Konfirmasi -->
    <div class="popup" id="popup">
        <div class="popup-content">
            <h2>Konfirmasi</h2>
            <p>Apakah Anda yakin ingin memperbarui?</p>
            <button onclick="confirmUpdate()">Ya, Perbarui</button>
            <button class="close" onclick="hidePopup()">Batal</button>
        </div>
    </div>

    <script>
        function showPopup(event) {
            event.preventDefault(); // Mencegah pengiriman formulir
            document.getElementById('popup').style.display = 'flex'; // Tampilkan popup
        }

        function hidePopup() {
            document.getElementById('popup').style.display = 'none'; // Sembunyikan popup
        }

        function confirmUpdate() {
            document.getElementById('updateForm').submit(); // Kirim formulir jika pengguna mengonfirmasi
        }
    </script>
</body>
</html>
