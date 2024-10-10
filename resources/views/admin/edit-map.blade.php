<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Peta</title>
    <link rel="stylesheet" href="{{ asset('css/edit-map.css') }}">
    <!-- Tambahkan leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
</head>

<body>
    <div class="wrapper">
        <h1>Edit Peta</h1>

        @if ($map)
            <!-- Form edit koordinat peta -->
            <form action="{{ route('update.map', $map->id) }}" method="POST">
                @csrf
                @method('POST') <!-- Ganti dengan PUT jika diperlukan -->
                <div>
                    <label for="latitude">Latitude:</label>
                    <input type="text" name="latitude" id="latitude" value="{{ $map->latitude }}" required>
                </div>
                <div>
                    <label for="longitude">Longitude:</label>
                    <input type="text" name="longitude" id="longitude" value="{{ $map->longitude }}" required>
                </div>
                <button type="submit">Update Peta</button>
            </form>

            <!-- Tampilkan Peta -->
            <section class="map" style="text-align: center; margin: 20px 0;">
                <div id="map" style="width: 80%; height: 450px; margin: 0 auto;"></div>

                <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
                <script>
                    // Inisialisasi peta dengan koordinat dari database
                    var map = L.map('map').setView([{{ $map->latitude }}, {{ $map->longitude }}], 13);

                    // Menambahkan layer peta dari OpenStreetMap
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                    }).addTo(map);

                    // Menambahkan marker di peta
                    L.marker([{{ $map->latitude }}, {{ $map->longitude }}]).addTo(map)
                        .bindPopup('Lokasi: Kota Bandung, Jawa Barat');
                </script>
            </section>

            <!-- Tampilkan gambar peta jika ada -->
            @if ($map->image)
                <img src="{{ asset('storage/' . $map->image) }}" alt="Peta Lokasi" style="width: 100%; margin-top: 20px;" />
            @endif
        @else
            <p>Peta tidak ditemukan.</p>
        @endif
    </div>
</body>

</html>
