<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Tentang;
use App\Models\ContactInfo;
use App\Models\FormKontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Tampilkan halaman dashboard admin dengan semua data yang dibutuhkan
    public function adminDashboard()
    {
        $data = [
            'totalBerita' => Berita::count(),
            'totalGaleri' => Galeri::count(),
            'totalKontak' => FormKontak::count(),
            'allBerita' => Berita::all(),
            'allGaleri' => Galeri::all(),
            'allKontak' => FormKontak::all(),
            'kontak' => ContactInfo::first(),
            'tentang' => Tentang::first(),
        ];

        return view('admin.dashboard', $data);
    }

    // Fungsi untuk menampilkan dan memperbarui halaman Tentang Kami
    public function editTentangKami()
    {
        $tentang = Tentang::first();
        if (!$tentang) {
            return redirect()->route('admin.dashboard')->with('error', 'Data Tentang Kami tidak ditemukan.');
        }
        return view('admin.dashboard', compact('tentang'));
    }

    public function updateTentangKami(Request $request)
    {
        $request->validate([
            'about_text' => 'required|string',
            'vision_text' => 'required|string',
            'mission_text' => 'required|string',
        ]);

        $tentang = Tentang::firstOrFail();
        $tentang->update($request->only('about_text', 'vision_text', 'mission_text'));

        return redirect()->route('admin.dashboard')->with('success', 'Informasi Tentang Kami berhasil diperbarui.');
    }

    // FUNGSI BERITA
    public function storeBerita(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|max:5048',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = basename($request->file('gambar')->store('public/gambar'));
        }

        Berita::create($validated);
        return redirect()->route('admin.dashboard')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function editBerita($id)
    {
        return response()->json(Berita::findOrFail($id));
    }

    public function updateBerita(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|max:5048',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = basename($request->file('gambar')->store('public/gambar'));
        }

        $berita->update($validated);
        return redirect()->route('admin.dashboard')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroyBerita(Berita $berita)
    {
        $berita->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Berita berhasil dihapus.');
    }

    // Fungsi Galeri
    public function storeGaleri(Request $request)
    {
        $validated = $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:5048',
        ]);

        $validated['gambar'] = basename($request->file('gambar')->store('public/galeri'));
        Galeri::create($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Gambar berhasil ditambahkan.');
    }

    public function editGaleri($id)
    {
        return view('admin.dashboard', ['galeriItem' => Galeri::findOrFail($id)]);
    }

    public function updateGaleri(Request $request, $id)
    {
        $galeriItem = Galeri::findOrFail($id);

        $validated = $request->validate([
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = basename($request->file('gambar')->store('public/galeri'));
        }

        $galeriItem->update($validated);
        return redirect()->route('admin.dashboard')->with('success', 'Gambar berhasil diperbarui.');
    }

    public function destroyGaleri(Galeri $galeri)
    {
        $galeri->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Gambar berhasil dihapus.');
    }


    // AdminController.php
    public function daftarBerita()
    {
        // Ambil semua data berita
        $allBerita = Berita::all();

        // Kirim data ke view untuk ditampilkan
        return view('admin.daftar-berita', compact('allBerita'));
    }

    // AdminController.php
    public function daftarGaleri()
    {
        // Ambil semua data galeri
        $allGaleri = Galeri::all();  // Pastikan Anda sudah memiliki model Galeri

        // Kirim data ke view untuk ditampilkan
        return view('admin.daftar-galeri', compact('allGaleri'));
    }

    // ContactInfoController.php
    public function daftarKontak()
    {
        // Ambil semua data form kontak
        $allKontak = FormKontak::all();  // Pastikan Anda sudah memiliki model FormKontak

        // Kirim data ke view untuk ditampilkan
        return view('admin.daftar-formkontak', compact('allKontak'));
    }
}
