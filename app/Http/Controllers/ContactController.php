<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contact = Contact::select(['key', 'value'])->whereIn('key', ['no_hp', 'email', 'alamat', 'lat', 'lon'])->get()->keyBy('key');
        return view('contact.index', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(ContactRequest $request)
    {
        foreach ($request->except(['_token', '_method']) as $key => $value) {
            Contact::where('key', $key)->update(['value' => $value]);
        }
        return redirect()->back()->with('success', 'Berhasil mengubah kontak');
    }

    public function indexForUser()
    {
        $contact = Contact::get()->keyBy('key');
        return view('contact.index-for-user', compact('contact'));
    }
}
