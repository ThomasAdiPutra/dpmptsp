<?php

namespace App\Http\Controllers;

use App\Http\Requests\Service\ServiceFormRequest;
use App\Models\ServicePermissionForm;
use Illuminate\Http\Request;

class ServicePermissionFormController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceFormRequest $request)
    {
        $data = $request->all();
        $path = base_path('public/asset/file/service') . '/';
        $name = date('Y-m-d') . $request->form->getClientOriginalName();
        if (move_uploaded_file($request->form, $path . $name)) {
            $data['form'] = asset('asset/file/service/' . $name);
        }
        ServicePermissionForm::create($data);
        return redirect()->back()->with('success', 'Berhasil menambah berkas');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\ServicePermissionForm  $berka
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceFormRequest $request, ServicePermissionForm $berka)
    {
        $data = $request->all();
        $path = base_path('public/asset/file/service') . '/';
        $name = date('Y-m-d') . $request->form->getClientOriginalName();
        if (move_uploaded_file($request->form, $path . $name)) {
            $data['form'] = asset('asset/file/service/' . $name);
        }
        $berka->update($data);
        return redirect()->back()->with('success', 'Berhasil mengubah berkas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServicePermissionForm  $berka
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServicePermissionForm $berka)
    {
        $path = base_path('public' . parse_url($berka->form)['path']);
        file_exists($path) ? unlink($path) : '';
        $berka->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus berkas');
    }
}
