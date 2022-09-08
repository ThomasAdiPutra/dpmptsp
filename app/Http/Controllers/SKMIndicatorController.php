<?php

namespace App\Http\Controllers;

use App\Http\Requests\Skm\IndicatorRequest;
use App\Models\SKMIndicator;
use Illuminate\Http\Request;

class SKMIndicatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $indicators = SKMIndicator::get();
        return view('skm.indicator', compact('indicators'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IndicatorRequest $request)
    {
        SKMIndicator::create($request->all());
        return redirect()->back()->with('success', 'Berhasil menambah indikator');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SKMIndicator  $sKMIndicator
     * @return \Illuminate\Http\Response
     */
    public function update(IndicatorRequest $request, SKMIndicator $indikator)
    {
        $indikator->update($request->all());
        return redirect()->back()->with('success', 'Berhasil mengubah indikator');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SKMIndicator  $sKMIndicator
     * @return \Illuminate\Http\Response
     */
    public function destroy(SKMIndicator $indikator)
    {
        $indikator->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus indikator');
    }
}
