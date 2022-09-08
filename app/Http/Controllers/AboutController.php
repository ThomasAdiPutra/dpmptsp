<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAboutRequest;
use App\Models\About;
use Illuminate\Http\Request;
use Image;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $about = About::get()->keyBy('key');
        return view('about.index', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UpdateAboutRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAboutRequest $request)
    {
        $data = $request->all();
        if ($request->has('logo')) {
            $extension = $request->logo->extension();
            move_uploaded_file($request->logo, base_path('public/asset/img/logo.'.$extension));
            $data['logo'] = asset('asset/img/logo.'.$extension);
        }

        if ($request->has('struktur_organisasi')) {
            $extension = $request->struktur_organisasi->extension();
            move_uploaded_file($request->struktur_organisasi, base_path('public/asset/img/struktur_organisasi.'.$extension));
            $data['struktur_organisasi'] = asset('asset/img/struktur_organisasi.'.$extension);
        }

        if ($request->has('sop')) {
            move_uploaded_file($request->sop, base_path('public/asset/file/sop.pdf'));
            $data['sop'] = asset('asset/img/sop.pdf');
        }

        foreach ($data as $key => $value) {
            $about = About::where('key', $key)->first();
            if($about) $about->update(['value' => $value]);
        }
        return redirect()->back()->with('success', 'Berhasil memperbarui data');
    }

    public function profil()
    {
        $profil = About::select('value')->where('key', 'profil')->pluck('value')->first();
        return view('about.profil', compact('profil'));
    }

    public function visiMisi()
    {
        $query = About::whereIn('key', ['visi', 'misi'])->get()->keyBy('key');
        $visi = $query['visi']->value;
        $misi = $query['misi']->value;
        // dd($visi, $misi);
        return view('about.visi-misi', compact('visi', 'misi'));
    }

    public function maklumatPelayanan()
    {
        $maklumatPelayanan = About::select('value')->where('key', 'maklumat_pelayanan')->pluck('value')->first();
        return view('about.maklumat-pelayanan', compact('maklumatPelayanan'));   
    }

    public function standarPelayanan()
    {
        $standarPelayanan = About::select('value')->where('key', 'maklumat_pelayanan')->pluck('value')->first();
        return view('about.standar-pelayanan', compact('standarPelayanan'));   
    }

    public function strukturOrganisasi()
    {
        $strukturOrganisasi = About::select('value')->where('key', 'struktur_organisasi')->pluck('value')->first();
        return view('about.struktur-organisasi', compact('strukturOrganisasi')); 
    }

    public function sop()
    {
        $sop = About::select('value')->where('key', 'sop')->pluck('value')->first();
        return view('about.sop', compact('sop')); 
    }
}
