<?php

namespace App\Http\Controllers;

use App\Http\Requests\RelatedLinkRequest;
use App\Models\RelatedLink;
use Illuminate\Http\Request;
use Image;

class RelatedLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $relatedLinks = RelatedLink::orderBy('order')->get();
        return view('related-link.index', compact('relatedLinks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RelatedLinkRequest $request)
    {
        $data = $request->all();
        $path = base_path('public/asset/img/link-terkait') . '/';
        $name = date('Y-m-d') . $request->logo->getClientOriginalName();
        $img = Image::make($request->logo)->resize(640, 480);
        if ($img->save($path . $name)) {
            $data['logo'] = asset('asset/img/link-terkait/' . $name);
        }
        RelatedLink::create($data);
        return redirect()->back()->with('success', 'Berhasil menambah data');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RelatedLink  $relatedLink
     * @return \Illuminate\Http\Response
     */
    public function update(RelatedLinkRequest $request, RelatedLink $link_terkait)
    {
        $data = $request->all();
        if ($request->has('logo')) {
            $old_path = base_path('public' . parse_url($link_terkait->logo)['path']);
            file_exists($old_path) ? unlink($old_path) : '';

            $path = base_path('public/asset/img/link-terkait') . '/';
            $name = date('Y-m-d') . $request->logo->getClientOriginalName();
            $img = Image::make($request->logo)->resize(640, 480);
            if ($img->save($path . $name)) {
                $data['logo'] = asset('asset/img/link-terkait/' . $name);
            }
        }
        $link_terkait->update($data);
        return redirect()->back()->with('success', 'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RelatedLink  $relatedLink
     * @return \Illuminate\Http\Response
     */
    public function destroy(RelatedLink $link_terkait)
    {
        $link_terkait->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }

    /**
     * Change the related links order.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function changeOrder(Request $request)
    {
        $request->validate([
            'order' => 'required'
        ]);

        $orders = json_decode($request->order);
        foreach ($orders as $id => $order) {
            RelatedLink::find($id)->update(['order' => $order]);
        }
        return redirect()->back()->with('success', 'Berhasil mengubah urutan');
    }
}
