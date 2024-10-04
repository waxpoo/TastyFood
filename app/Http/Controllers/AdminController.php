<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Tentang;
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
    public function editTentangKami(Request $request)
    {
        $tentang = Tentang::first(); // Ambil data pertama dari tabel tentang
        return view('admin.edit-tentang', compact('tentang'));
    }
    public function updateTentangKami(Request $request)
    {
        $request->validate([
            'about_text' => 'required',
            'vision_text' => 'required',
            'mission_text' => 'required',
        ]);

        $tentang = Tentang::first(); // Ambil data pertama dari tabel tentang
        $tentang->about_text = $request->about_text;
        $tentang->vision_text = $request->vision_text;
        $tentang->mission_text = $request->mission_text;
        $tentang->save();

        return redirect()->route('edit-tentang')->with('success', 'Tentang Kami berhasil diperbarui.');
    }


    // Fungsi Berita
    public function createBerita()
    {
        return view('admin.create-berita');
    }

    public function daftarBerita()
    {
        $allBerita = Berita::all();
        return view('admin.daftar-berita', compact('allBerita')); // Pastikan ini sesuai
    }

    //store
    public function storeBerita(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $imagePath = $request->file('gambar')->store('public/gambar');
            $validated['gambar'] = basename($imagePath);
        }

        Berita::create($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Berita berhasil ditambahkan.');
    }
    //edit
    public function editBerita(Berita $berita)
    {
        return view('admin.edit-berita', compact('berita'));
    }
    //update
    public function updateBerita(Request $request, Berita $berita)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $imagePath = $request->file('gambar')->store('public/gambar');
            $validated['gambar'] = basename($imagePath);
        } else {
            $validated['gambar'] = $berita->gambar;
        }

        $berita->update($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Berita berhasil diperbarui.');
    }
    //destroy
    public function destroyBerita(Berita $berita)
    {
        $berita->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Berita berhasil dihapus.');
    }

    // Fungsi Galeri
    //crate
    public function createGaleri()
    {
        return view('admin.create-galeri');
    }
    //daftar
    public function daftarGaleri()
    {
        $allGaleri = Galeri::all(); // Pastikan model Galeri sudah ada
        return view('admin.daftar-galeri', compact('allGaleri')); // Kirimkan data ke view
    }

    //show
    public function showGaleri()
    {
        $galeriItems = Galeri::all();
        return view('admin.galeri-kami', compact('galeriItems'));
    }
    //store
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
    //edit
    public function editGaleri($id)
    {
        $galeriItem = Galeri::findOrFail($id);
        return view('admin.edit-galeri', compact('galeriItem'));
    }
    //update
    public function updateGaleri(Request $request, $id)
    {
        $galeriItem = Galeri::findOrFail($id);

        $validated = $request->validate([
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
    //destroy
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
