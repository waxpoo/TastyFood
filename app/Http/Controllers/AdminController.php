<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Tentang;
use App\Models\Map;
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
        $map = Map::first(); // Mengambil peta pertama

        return view('admin.dashboard', compact('totalBerita', 'totalGaleri', 'allBerita', 'allGaleri', 'map'));
    }

    // TENTANG
    public function editTentangKami(Request $request)
    {
        $tentang = Tentang::first();
        return view('admin.edit-tentang', compact('tentang'));
    }

    public function updateTentangKami(Request $request)
    {
        $request->validate([
            'about_text' => 'required',
            'vision_text' => 'required',
            'mission_text' => 'required',
        ]);

        $tentang = Tentang::first();
        $tentang->update($request->only(['about_text', 'vision_text', 'mission_text']));

        return redirect()->route('admin.dashboard')->with('success', 'Data tentang berhasil diperbarui.');
    }
// FUNGSI BERITA

public function createBerita()
{
    return view('admin.create-berita');
}

public function daftarBerita()
{
    $allBerita = Berita::all();
    return view('admin.daftar-berita', compact('allBerita'));
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

// Metode untuk menampilkan halaman edit
public function editBerita($id)
{
    // Cari berita berdasarkan ID
    $berita = Berita::findOrFail($id);
    
    // Tampilkan halaman edit dengan data berita
    return view('admin.edit-berita', compact('berita'));
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
        return view('admin.create-galeri');
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
        return view('admin.edit-galeri', compact('galeriItem'));
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
    // FUNGSI MAPS
    public function editMap()
    {
        // Mengambil data peta pertama
        $map = Map::first();

        if (!$map) {
            return redirect()->route('admin.maps')->with('error', 'Peta tidak ditemukan.');
        }

        // Menampilkan form edit peta dengan data yang ada
        return view('admin.edit-map', compact('map'));
    }
    public function updateMap(Request $request)
    {
        $validated = $request->validate([
            'latitude' => 'required|numeric|max:90', // Menambahkan validasi numerik
            'longitude' => 'required|numeric|max:180', // Menambahkan validasi numerik
        ]);

        $map = Map::first();

        if (!$map) {
            return redirect()->route('admin.maps')->with('error', 'Peta tidak ditemukan.');
        }

        // Update data peta
        $map->update([
            'latitude' => (float)$validated['latitude'], // Casting ke float
            'longitude' => (float)$validated['longitude'], // Casting ke float
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Peta berhasil diperbarui.');
    }
}
