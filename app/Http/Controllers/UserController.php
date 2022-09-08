<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateProfileRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('permissions')->get();
        $permissions = Permission::get();
        return view('user.index', compact('users', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        DB::beginTransaction();
        $data = $request->all();
        try {
            if ($request->has('image')) {
                $path = base_path('public/asset/img/profile') . '/';
                $name = date('Y-m-d') . $request->image->getClientOriginalName();
                $img = Image::make($request->image)->resize(640, 480);
                if ($img->save($path . $name)) {
                    $data['image'] = asset('asset/img/profile/' . $name);
                }
            }
            $user = User::create($data);
            $user->syncPermissions($request->permissions);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menambah user');
        }
        DB::commit();
        return redirect()->back()->with('success', 'Berhasil menambah user');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->all();
        if ($request->has('image')) {
            $path = base_path('public/asset/img/profile') . '/';
            $name = date('Y-m-d') . "-" . $user->id . "-" . $request->image->getClientOriginalName();
            $img = Image::make($request->image)->resize(640, 480);
            if ($img->save($path . $name)) {
                $data['image'] = asset('asset/img/profile/' . $name);
            }
        }
        DB::beginTransaction();
        try {
            $user->update($data);
            $user->syncPermissions($request->permissions);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memperbarui data');
        }
        DB::commit();
        return redirect()->back()->with('success', 'Berhasil memperbarui data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus user');
    }

    public function profile()
    {
        $user = User::find(auth()->user()->id);
        return view('user.profile', compact('user'));
    }

    public function resetPassword(User $user)
    {
        $user->update(['password' => bcrypt('password')]);
        return redirect()->back()->with('success', 'Berhasil reset password');
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $id = auth()->user()->id;
        $user = User::find($id);
        $data = $request->all();
        if ($request->has('image')) {
            $path = base_path('public/asset/img/profile') . '/';
            $name = date('Y-m-d') . "-$id-" . $request->image->getClientOriginalName();
            $img = Image::make($request->image)->resize(640, 480);
            if ($img->save($path . $name)) {
                $data['image'] = asset('asset/img/profile/' . $name);
            }
        }
        $user->update($data);
        return redirect()->back()->with('success', 'Berhasil memperbarui profil');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $check = Hash::check($request->old_password, auth()->user()->password);
        if ($check) {
            User::find(auth()->user()->id)->update(['password' => bcrypt($request->new_password)]);
            return redirect()->route('logout');
        }
        return redirect()->back()->with('error', 'Password lama salah');
    }
}
