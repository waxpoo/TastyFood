<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('register'); // Mengarahkan ke view registrasi
    }

    public function register(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed', // Password dan konfirmasi password
        ]);

        // Jika validasi gagal, kembali ke form dengan pesan error
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Membuat pengguna baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Meng-hash password
            'role' => 'user', // Menggunakan role default
        ]);

        // Login otomatis setelah registrasi
        Auth::login($user);

        // Redirect setelah registrasi berhasil
        return redirect()->route('login'); // Ganti dengan route yang sesuai
    }

    public function showLoginForm()
    {
        return view('login'); // Pastikan Anda memiliki view login.blade.php
    }

    public function login(Request $request)
    {
        // Validasi input login
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Jika kredensial cocok, login pengguna
        if (Auth::attempt($credentials)) {
            // Mengambil user yang sedang login
            $user = Auth::user();

            // Jika role pengguna adalah admin, arahkan ke halaman dashboard admin
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard'); // Pastikan Anda memiliki route ini
            }

            // Jika bukan admin, arahkan ke halaman utama (home)
            return redirect()->route('home'); // Ganti dengan route yang sesuai
        }

        // Jika gagal login, kembali ke form login dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout()
    {
        Auth::logout(); // Logout pengguna
        return redirect()->route('login'); // Mengarahkan kembali ke form login
    }
}
