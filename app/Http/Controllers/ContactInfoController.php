<?php

namespace App\Http\Controllers;

use App\Models\ContactInfo;
use Illuminate\Http\Request;
class ContactInfoController extends Controller
{
    public function edit()
    {
        $contact = ContactInfo::first();
        return view('partials.edit-kontak', compact('contact')); // Perbaiki di sini
    }

    public function update(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'phone' => 'required',
            'location' => 'required',
        ]);

        $contact = ContactInfo::first();
        $contact->update($request->all());

        return redirect()->back()->with('success', 'Contact info updated successfully');
    }

    public function showContact()
    {
        $contact = ContactInfo::first();
        return view('kontak-kami', compact('contact'));
    }
}
