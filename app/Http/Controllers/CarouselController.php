<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarouselRequest;
use App\Models\Carousel;
use Image;

class CarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carousels = Carousel::get();
        return view('carousel.index', compact('carousels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CarouselRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarouselRequest $request)
    {
        $path = base_path('public/asset/img/carousel') . '/';
        $name = uniqid() . $request->path->getClientOriginalName();
        $img = Image::make($request->path)->resize(3000, 2000);
        if ($img->save($path . $name)) {
            Carousel::create(['path' => asset('/asset/img/carousel/' . $name)]);
            return redirect()->back()->with('success', 'Berhasil menambah carousel');
        }
        return redirect()->back()->with('fail', 'Gagal menambah carousel');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\CarouselRequest  $request
     * @param  \App\Models\Carousel  $carousel
     * @return \Illuminate\Http\Response
     */
    public function update(CarouselRequest $request, Carousel $carousel)
    {
        $path = base_path('public/asset/img/carousel') . '/';
        $name = uniqid() . $request->path->getClientOriginalName();
        move_uploaded_file($request->path, $path . $name);
        $carousel->update(['path' => asset('/asset/img/carousel/' . $name)]);
        return redirect()->back()->with('success', 'Carousel berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carousel  $carousel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carousel $carousel)
    {
        $path = base_path('public' . parse_url($carousel->path)['path']);
        file_exists($path) ? unlink($path) : '';
        $carousel->delete();
        return redirect()->back()->with('success', 'Carousel berhasil dihapus');
    }
}
