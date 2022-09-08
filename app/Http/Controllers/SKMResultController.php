<?php

namespace App\Http\Controllers;

use App\Http\Requests\Skm\ResultRequest;
use App\Models\SKMResult;
use Illuminate\Http\Request;

class SKMResultController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ResultRequest $request)
    {
        SKMResult::create($request->all());
        return redirect()->back()->with('success', 'Berhasil menambah data');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SKMResult  $sKMResult
     * @return \Illuminate\Http\Response
     */
    public function update(ResultRequest $request, SKMResult $skm_result)
    {
        $skm_result->update($request->all());
        return redirect()->back()->with('success', 'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SKMResult  $sKMResult
     * @return \Illuminate\Http\Response
     */
    public function destroy(SKMResult $skm_result)
    {
        $skm_result->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}
