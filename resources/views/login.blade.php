<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
    <!-- Anda bisa tambahkan link CSS tambahan atau Bootstrap di sini jika dibutuhkan -->
</head>
<body>
    <div class="container">
        <h2>Login</h2>

        <!-- Pesan sukses setelah registrasi -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Pesan kesalahan login -->
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Form login -->
        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>

        <div class="login-link">
            <p>Belum punya akun? <a href="{{ route('register') }}">Register di sini</a></p>
        </div>
    </div>

    <!-- Tambahkan script tambahan jika diperlukan -->
</body>
</html>
