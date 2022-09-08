<?php

namespace App\Http\Controllers;

use App\Http\Requests\Service\ServicePermissionRequest;
use App\Models\ServicePermission;
use Illuminate\Http\Request;

class ServicePermissionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServicePermissionRequest $request)
    {
        ServicePermission::create($request->all());
        return redirect()->back()->with('success', 'Berhasil menambah izin');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ServicePermission  $izin
     * @return \Illuminate\Http\Response
     */
    public function update(ServicePermissionRequest $request, ServicePermission $izin)
    {
        $izin->update($request->all());
        return redirect()->back()->with('success', 'Berhasil mengubah izin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServicePermission  $izin
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServicePermission $izin)
    {
        $izin->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus izin');
    }
}
