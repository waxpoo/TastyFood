<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Tentang;
use App\Models\ContactInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Tampilkan halaman dashboard admin
    public function adminDashboard()
    {
        $totalBerita = Berita::count();
        $totalGaleri = Galeri::count();
        $allBerita = Berita::all();
        $allGaleri = Galeri::all();
        $tentang = Tentang::first();
        $kontak = ContactInfo::first();

        return view('admin.dashboard', compact('totalBerita', 'totalGaleri', 'allBerita', 'allGaleri','tentang','kontak'));
    }

    // Fungsi untuk menampilkan halaman edit Tentang Kami
    public function editTentangKami()
    {
        // Ambil data Tentang pertama
        $tentang = Tentang::first(); // Atau gunakan sesuai dengan logika Anda

        // Jika tidak ada data Tentang, redirect dengan pesan error
        if (!$tentang) {
            return redirect()->route('admin.dashboard')->with('error', 'Data Tentang Kami tidak ditemukan.');
        }

        // Kirim data tentang ke view
        return view('admin.dashboard', compact('tentang'));

    }

    // Fungsi untuk memperbarui informasi Tentang Kami
    public function updateTentangKami(Request $request)
    {
        // Validasi data input
        $request->validate([
            'about_text' => 'required|string',
            'vision_text' => 'required|string',
            'mission_text' => 'required|string',
        ]);

        // Ambil data Tentang pertama
        $tentang = Tentang::first();

        // Jika data Tentang Kami tidak ditemukan
        if (!$tentang) {
            return redirect()->back()->with('error', 'Data Tentang Kami tidak ditemukan.');
        }

        // Update data Tentang Kami dengan data baru dari form
        $tentang->update([
            'about_text' => $request->about_text,
            'vision_text' => $request->vision_text,
            'mission_text' => $request->mission_text,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.dashboard')->with('success', 'Informasi Tentang Kami berhasil diperbarui.');
    }

    // FUNGSI BERITA
    public function createBerita()
    {
        return view('partials.create-berita');
    }

    public function daftarBerita()
    {
        $allBerita = Berita::all(); // Ambil semua berita
        $totalBerita = $allBerita->count(); // Hitung total berita

        return view('admin.daftar-berita', compact('allBerita', 'totalBerita'));
    }


    public function storeBerita(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|max:5048',
        ]);

        if ($request->hasFile('gambar')) {
            $imagePath = $request->file('gambar')->store('public/gambar');
            $validated['gambar'] = basename($imagePath);
        }

        Berita::create($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Berita berhasil ditambahkan.');
    }

    // Metode untuk menampilkan halaman edit berita
    public function editBerita($id)
    {
        // Cari berita berdasarkan ID
        $berita = Berita::findOrFail($id);

        // Tampilkan halaman edit dengan data berita
        return view('partials.edit-berita', compact('berita'));
    }

    // Metode untuk memperbarui berita
    public function updateBerita(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|max:5048',
        ]);

        if ($request->hasFile('gambar')) {
            $imagePath = $request->file('gambar')->store('public/gambar');
            $validated['gambar'] = basename($imagePath);
        } else {
            $validated['gambar'] = $berita->gambar; // Tetap gunakan gambar yang ada jika tidak ada gambar baru
        }

        $berita->update($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroyBerita(Berita $berita)
    {
        $berita->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Berita berhasil dihapus.');
    }

    // FUNGSI GALERI
    public function createGaleri()
    {
        return view('partials.create-galeri');
    }

    public function daftarGaleri()
    {
        $allGaleri = Galeri::all();
        return view('admin.daftar-galeri', compact('allGaleri'));
    }

    public function showGaleri()
    {
        $galeriItems = Galeri::all();
        return view('admin.galeri-kami', compact('galeriItems'));
    }

    public function storeGaleri(Request $request)
    {
        $validated = $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:5048',
        ]);

        $imagePath = $request->file('gambar')->store('public/galeri');
        $validated['gambar'] = basename($imagePath);

        Galeri::create($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Gambar berhasil ditambahkan.');
    }

    public function editGaleri($id)
    {
        $galeriItem = Galeri::findOrFail($id);
        return view('partials.edit-galeri', compact('galeriItem'));
    }

    public function updateGaleri(Request $request, $id)
    {
        $galeriItem = Galeri::findOrFail($id);

        $validated = $request->validate([
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
        ]);

        if ($request->hasFile('gambar')) {
            $imagePath = $request->file('gambar')->store('public/galeri');
            $validated['gambar'] = basename($imagePath);
        } else {
            $validated['gambar'] = $galeriItem->gambar;
        }

        $galeriItem->update($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Gambar berhasil diperbarui.');
    }

    public function destroyGaleri(Galeri $galeri)
    {
        $galeri->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Gambar berhasil dihapus.');
    }

    // Fungsi Registrasi dan Login
    public function showRegisterForm()
    {
        return view('register');
    }

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
