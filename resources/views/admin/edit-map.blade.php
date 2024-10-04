<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Peta</title>
    <link rel="stylesheet" href="{{ asset('css/edit-map.css') }}">
</head>

<body>
    <div class="wrapper">
        <h1>Edit Peta</h1>

        @if ($map)
            <!-- Pastikan $map tidak null -->
            <form action="{{ route('update.map', $map->id) }}" method="POST">
                @csrf
                @method('POST') <!-- Ubah ini jika Anda menggunakan metode PUT atau PATCH -->
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
        @else
            <p>Peta tidak ditemukan.</p>
        @endif
    </div>
</body>

</html>
