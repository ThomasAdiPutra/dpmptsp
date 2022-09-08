<?php

namespace App\Http\Controllers;

use App\Http\Requests\Skm\StoreSkmRequest;
use App\Models\SKM;
use App\Models\SKMIndicator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SKMController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $skm = SKM::with('result', 'result.indicator')->orderBy('created_at', 'DESC')->first();
        return view('skm.index', compact('skm'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSkmRequest $request)
    {
        SKM::create($request->all());
        return redirect()->back()->with('success', 'Berhasil menambah periode baru');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SKM  $sKM
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSkmRequest $request, SKM $skm)
    {
        $skm->update($request->all());
        return redirect()->back()->with('success', 'Berhasil mengubah periode');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SKM  $sKM
     * @return \Illuminate\Http\Response
     */
    public function destroy(SKM $skm)
    {
        $skm->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus periode');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexForUser(Request $request)
    {
        $skm = SKM::with('result', 'result.indicator')->orderBy('created_at', 'DESC')->get();
        $indicators = SKMIndicator::with(['result' => function ($query) use ($skm, $request) {
            if ($request->has('periode')) {
                $query->where('skm_id', $request->periode);
            } else {
                $query->where('skm_id', $skm->first()->id);
            }
        }, 'result.skm'])->get();
        if ($request->has('periode')) {
            $period = SKM::where('id',$request->periode)->first();
        } else {
            $period = $skm->first();
        }
        $id_period = $period->id;
        $start_period = $period->start_period;
        $end_period = $period->end_period;
        return view('skm.index-for-user', compact('skm', 'indicators', 'id_period', 'start_period', 'end_period'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function publikasiNilai()
    {
        $skm = SKM::get();
        return view('skm.index', compact('skm'));
    }
}
