<?php

namespace App\Http\Controllers;

use App\Models\ContactInfo;
use App\Models\FormKontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactInfoController extends Controller
{
    public function editKontak()
    {
        // Ambil data pertama dari tabel ContactInfo
        $kontak = ContactInfo::first();

        // Jika data tidak ditemukan, redirect dengan pesan error
        if (!$kontak) {
            return redirect()->route('admin.dashboard')->with('error', 'Data kontak tidak ditemukan.');
        }

        // Kirim data $kontak ke view admin.dashboard
        return view('admin.dashboard', compact('kontak'));
    }

    public function updateKontak(Request $request)
    {
        // Validasi data yang diinputkan
        $request->validate([
            'email' => 'required|email',
            'phone' => 'required',
            'location' => 'required',
        ]);

        // Ambil data pertama dari tabel ContactInfo
        $kontak = ContactInfo::first();

        // Jika data tidak ditemukan, kembalikan dengan pesan error
        if (!$kontak) {
            return redirect()->back()->withErrors('Data kontak tidak ditemukan.');
        }

        // Update data kontak dengan data yang baru dari form
        $kontak->update($request->all());

        // Kembali ke halaman edit kontak dengan pesan sukses
        return redirect()->route('admin.dashboard')->with('success', 'Informasi kontak berhasil diperbarui.');
    }

    public function showContact()
    {
        // Ambil data pertama dari tabel ContactInfo
        $kontak = ContactInfo::first();

        // Kirim data ke view
        return view('kontak-kami', compact('kontak'));
    }

    public function storeFormKontak(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'subject' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Simpan data formulir kontak ke dalam database
        FormKontak::create([
            'subject' => $request->subject,
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        // Simpan log untuk referensi
        Log::info('Form Kontak Baru: ', $request->all());

        // Redirect ke halaman kontak dengan pesan sukses
        return redirect()->route('kontak.show')->with('success', 'Pesan Anda telah dikirim.');
    }
}
