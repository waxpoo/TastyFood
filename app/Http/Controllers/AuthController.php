<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Menampilkan form registrasi
     */
    public function showRegisterForm()
    {
        return view('register'); // Mengarahkan ke view registrasi
    }

    /**
     * Menangani proses registrasi
     */
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
        return redirect()->route('home'); // Ganti dengan route yang sesuai
    }

    /**
     * Menampilkan form login
     */
    public function showLoginForm()
    {
        return view('login'); // Mengarahkan ke view login
    }

    /**
     * Menangani proses login
     */
    public function login(Request $request)
    {
        // Validasi input login
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Jika kredensial cocok, login pengguna
        if (Auth::attempt($credentials)) {
            // Mengalihkan pengguna setelah login berhasil
            return redirect()->route('home'); // Ganti dengan route yang sesuai
        }

        // Jika gagal login, kembali ke form login dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    /**
     * Menangani proses logout
     */
    public function logout()
    {
        Auth::logout(); // Logout pengguna
        return redirect()->route('login'); // Mengarahkan kembali ke form login
    }
}
