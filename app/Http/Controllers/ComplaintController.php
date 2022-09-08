<?php

namespace App\Http\Controllers;

use App\Http\Requests\Complaint\StoreComplaintRequest;
use App\Http\Requests\Complaint\StoreReplyRequest;
use App\Models\Complaint;
use App\Models\ComplaintReply;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $complaints = Complaint::with('reply', 'reply.user')->where('active', '1')->orderBy('created_at', 'DESC')->paginate(5);
        return view('complaint.index', compact('complaints'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreComplaintRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreComplaintRequest $request)
    {
        Complaint::create($request->all());
        return redirect()->back()->with('success', 'Berhasil melaporkan aduan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function show(Complaint $pengaduan)
    {
        $pengaduan = $pengaduan->load('reply', 'reply.user');
        return view('complaint.show', compact('pengaduan'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function destroy(Complaint $pengaduan)
    {
        $pengaduan->delete();
        return response()->json([], 204);
    }

    public function toggleActive(Complaint $pengaduan)
    {
        $pengaduan->toggleActive();
        return response()->json([], 204);
    }

    public function storeReply(StoreReplyRequest $request)
    {
        ComplaintReply::create($request->all());
        return redirect()->back();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexForUser()
    {
        $complaints = Complaint::with('reply', 'reply.user')->orderBy('created_at', 'DESC')->get();
        return view('complaint.index-for-user', compact('complaints'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function detail(Complaint $pengaduan)
    {
        $pengaduan = $pengaduan->load('reply', 'reply.user');
        return view('complaint.detail', compact('pengaduan'));
    }
}
