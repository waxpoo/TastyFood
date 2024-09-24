<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Berita;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Tampilkan halaman dashboard admin
    public function adminDashboard()
    {
        $totalBerita = Berita::count(); // Hitung total berita
        $totalGaleri = Galeri::count(); // Hitung total galeri
        $allBerita = Berita::all(); // Ambil semua berita
        $allGaleri = Galeri::all(); // Ambil semua galeri

        return view('admin.dashboard', compact('totalBerita', 'totalGaleri', 'allBerita', 'allGaleri'));
    }

    // Tampilkan form tambah berita
    public function createBerita()
    {
        return view('admin.create-berita');
    }

    // Simpan berita baru
    public function storeBerita(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Cek apakah ada file gambar
        if ($request->hasFile('gambar')) {
            // Simpan gambar dan ambil path
            $imagePath = $request->file('gambar')->store('public/gambar');
            $validated['gambar'] = basename($imagePath); // Ambil nama file gambar
        }

        // Simpan berita dengan gambar
        Berita::create($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Berita berhasil ditambahkan.');
    }


    // Tampilkan form edit berita
    public function editBerita(Berita $berita)
    {
        return view('admin.edit-berita', compact('berita'));
    }

    // Update berita
    public function updateBerita(Request $request, Berita $berita)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Cek apakah ada file gambar baru
        if ($request->hasFile('gambar')) {
            // Simpan gambar dan ambil path
            $imagePath = $request->file('gambar')->store('public/gambar');
            $validated['gambar'] = basename($imagePath); // Ambil nama file gambar
        } else {
            // Jika tidak ada gambar baru, gunakan gambar lama
            $validated['gambar'] = $berita->gambar;
        }

        // Update berita dengan gambar
        $berita->update($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Berita berhasil diperbarui.');
    }

    // Hapus berita
    public function destroyBerita(Berita $berita)
    {
        $berita->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Berita berhasil dihapus.');
    }

    // Tampilkan form tambah galeri
    public function createGaleri()
    {
        return view('admin.create-galeri');
    }

    // Tampilkan galeri
    public function showGaleri()
    {
        $galeriItems = Galeri::all(); // Ambil semua galeri
        return view('admin.galeri-kami', compact('galeriItems')); // Kirim data galeri ke view
    }

    // Simpan galeri baru
    public function storeGaleri(Request $request)
    {
        $validated = $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:5048',
        ]);

        // Simpan gambar dan ambil path
        $imagePath = $request->file('gambar')->store('public/galeri');
        $validated['gambar'] = basename($imagePath); // Ambil nama file gambar

        // Simpan galeri dengan gambar
        Galeri::create($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Gambar berhasil ditambahkan.');
    }

    // Tampilkan form edit galeri
    public function editGaleri($id)
    {
        $galeriItem = Galeri::findOrFail($id); // Mengambil data galeri berdasarkan ID
        return view('admin.edit-galeri', compact('galeriItem')); // Kirim variabel $galeriItem ke view
    }

    // Update galeri
    public function updateGaleri(Request $request, $id)
    {
        $galeriItem = Galeri::findOrFail($id);

        $validated = $request->validate([
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Cek apakah ada file gambar baru
        if ($request->hasFile('gambar')) {
            // Simpan gambar dan ambil path
            $imagePath = $request->file('gambar')->store('public/galeri');
            $validated['gambar'] = basename($imagePath); // Ambil nama file gambar
        } else {
            // Jika tidak ada gambar baru, gunakan gambar lama
            $validated['gambar'] = $galeriItem->gambar;
        }

        // Update galeri dengan gambar
        $galeriItem->update($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Gambar berhasil diperbarui.');
    }

    // Hapus galeri
    public function destroyGaleri(Galeri $galeri)
    {
        $galeri->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Gambar berhasil dihapus.');
    }

    // Tampilkan form registrasi
    public function showRegisterForm()
    {
        return view('register');
    }

    // Proses registrasi    
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:admin,user',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login.');
    }
}
