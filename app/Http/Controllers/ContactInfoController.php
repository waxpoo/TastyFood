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

    // FORM KONTOL
    public function storeFormKontak(Request $request)
    {
        // Validasi data yang diterima dari formulir kontak
        $request->validate([
            'subject' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Membuat instance model FormKontak untuk menyimpan data
        $formKontak = new FormKontak();
        $formKontak->subject = $request->subject;
        $formKontak->name = $request->name;
        $formKontak->email = $request->email;
        $formKontak->message = $request->message;

        // Simpan data formulir kontak
        $formKontak->save();

        // Simpan log untuk referensi
        Log::info('Form Kontak Dikirim: ', $request->all());

        // Redirect kembali dengan pesan sukses
        return redirect()->route('kontak.show')->with('success');
    }

    public function editFormKontak($id)
    {
        // Ambil data form kontak berdasarkan ID
        $formKontak = FormKontak::findOrFail($id); // Ganti FormKontak jadi formKontak

        // Jika data tidak ditemukan, redirect dengan pesan error
        return response()->json($formKontak); // Ganti FormKontak jadi formKontak
    }

    // Memperbarui data formulir
    public function updateFormKontak(Request $request, $id)
    {
        // Validasi data yang diterima
        $request->validate([
            'subject' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Cari form kontak berdasarkan ID
        $formKontak = FormKontak::find($id); // Ganti FormKontak jadi formKontak

        // Jika data tidak ditemukan, kembalikan dengan pesan error
        if (!$formKontak) {
            return redirect()->route('admin.dashboard')->with('error', 'Form Kontak tidak ditemukan.');
        }

        // Update data form kontak dengan data baru
        $formKontak->update([ // Ganti FormKontak jadi formKontak
            'subject' => $request->subject,
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        // Simpan log untuk referensi
        Log::info('Form Kontak Diperbarui: ', $request->all());

        // Redirect ke halaman dashboard admin dengan pesan sukses
        return redirect()->route('admin.dashboard')->with('success', 'Form Kontak berhasil diperbarui.');
    }

    public function destroyFormKontak($id)
    {
        // Cari form kontak berdasarkan ID
        $formKontak = FormKontak::find($id); // Ganti FormKontak jadi formKontak

        // Jika data tidak ditemukan, kembalikan dengan pesan error
        if (!$formKontak) {
            return redirect()->route('admin.dashboard')->with('error', 'Form Kontak tidak ditemukan.');
        }

        // Hapus form kontak
        $formKontak->delete(); // Ganti FormKontak jadi formKontak

        // Simpan log untuk referensi
        Log::info('Form Kontak Dihapus: ', ['id' => $id]);

        // Redirect ke halaman dashboard admin dengan pesan sukses
        return redirect()->route('admin.daftar-formkontak')->with('success', 'Data berhasil dihapus.');
    }
}
