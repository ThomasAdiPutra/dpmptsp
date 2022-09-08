<?php

namespace App\Http\Controllers;

use App\Http\Requests\Service\ServiceFormRequest;
use App\Http\Requests\Service\ServicePermissionRequest;
use App\Http\Requests\Service\ServiceRequest;
use App\Models\Service;
use App\Models\ServicePermission;
use App\Models\ServicePermissionForm;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::withCount(['permission', 'permissionForm'])->get();
        // dd($services);
        return view('service.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('service.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        Service::create($request->all());
        return redirect()->route('layanan.index')->with('success', 'Berhasil menambah layanan');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $service
     * @return \Illuminate\Http\Response
     */
    public function show($service)
    {
        $service  = Service::with('permission', 'permissionForm')->where('name', str_replace('-', ' ', $service))->first();
        return view('service.show', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $layanan
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequest $request, Service $layanan)
    {
        $layanan->update($request->all());
        return redirect()->back()->with('success', 'Berhasil mengubah layanan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $layanan)
    {
        $layanan->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus layanan');
    }

    public function detail($service)
    {
        $service = Service::with('permission', 'permissionForm')->where('name', str_replace('-', ' ', $service))->first();
        return view('service.detail', compact('service'));
    }
}
