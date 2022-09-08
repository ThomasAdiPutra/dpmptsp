<?php

namespace App\Http\Controllers;

use App\Http\Requests\Gallery\StoreGalleryRequest;
use App\Http\Requests\Gallery\UpdateGalleryRequest;
use App\Models\Gallery;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries = Gallery::get();
        return view('gallery.index', compact('galleries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreGalleryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGalleryRequest $request)
    {
        $path = base_path('public/asset/img/gallery').'/';
        $name = date('Y-m-d').uniqid().$request->path->getClientOriginalName();
        move_uploaded_file($request->path, $path.$name);
        Gallery::create([
            'title' => $request->title,
            'path' => asset('asset/img/gallery/'.$name),
        ]);
        return redirect()->back()->with('success', 'Berhasil menambah foto');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UpdateGalleryRequest  $request
     * @param  \App\Models\Gallery  $galeri
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGalleryRequest $request, Gallery $galeri)
    {
        $data = $request->all();
        if ($request->has('path')) {
            $name = date('Y-m-d').uniqid().$request->path->getClientOriginalName();
            move_uploaded_file($request->path, base_path('public/asset/img/gallery/'.$name));
            $data['path'] = asset('asset/img/gallery/'.$name);
        }
        $galeri->update($data);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $galeri)
    {
        $galeri->delete();
        return response('', 204);
    }

    public function indexForUser()
    {
        $galleries = Gallery::get();
        return view('gallery.index-for-user', compact('galleries'));
    }
}
