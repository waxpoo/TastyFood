<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Galeri; // Tambahkan ini
use App\Models\Contact;
use App\Models\Tentang;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // Menampilkan halaman utama
    public function index()
    {
        $recentBerita = Berita::latest()->take(5)->get(); // Mengambil 5 berita terbaru
        return view('home', compact('recentBerita'));
    }

    // Menampilkan halaman tentang kami
    public function tentang()
{
    $tentang = Tentang::first(); // Ambil data pertama dari tabel 'tentang'
    return view('tentang-kami', compact('tentang'));
}


    // Menampilkan daftar berita
    public function berita()
    {
        $berita = Berita::all(); // Ambil semua berita dari database
        return view('berita-kami', compact('berita'));
    }

    // Menampilkan halaman galeri
public function galeri()
{
    $galeriList = Galeri::all(); // Ambil semua data galeri
    return view('galeri-kami', compact('galeriList')); // Kirim data galeri ke view
}
    
    // Menampilkan halaman kontak
    public function kontak()
    {
        return view('kontak-kami');
    }

    // Menyimpan pesan kontak
    public function storeContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        Contact::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'message' => $request->input('message'),
        ]);

        return redirect()->route('kontak')->with('success', 'Pesan berhasil dikirim.');
    }

    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('login');
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Cek peran user
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard'); // Admin diarahkan ke dashboard admin
            } else {
                return redirect()->route('home'); // User diarahkan ke halaman utama
            }
        }

        // Jika login gagal, kembali ke form login dengan pesan kesalahan
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
