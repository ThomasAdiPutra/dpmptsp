<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnnouncementRequest;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $announcements = Announcement::get();
        return view('announcement.index', compact('announcements'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\AnnouncementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnnouncementRequest $request)
    {
        Announcement::create($request->all());
        return redirect()->back()->with('success', 'Berhasil menambah pengumuman');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function show(Announcement $announcement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Announcement $pengumuman)
    {
        $pengumuman->update($request->all());
        return redirect()->back()->with('success', 'Berhasil mengubah pengumuman');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Announcement $pengumuman)
    {
        $pengumuman->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus pengumuman');
    }
}
