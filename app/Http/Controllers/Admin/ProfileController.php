<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\Profile\ProfileUpdate;

class ProfileController extends Controller
{
    public function index()
    {
        $admin = Auth::user()->admin;
        return view('admin.profile.index', compact('admin'));
    }

    public function update(ProfileUpdate $request)
    {
        $admin = Auth::user()->admin;        
        $data = $request->except(['password','photo','level','active']);

        //encrypt password
        if($request->password)
        {
            $data['password'] = bcrypt($request->password);

        }
        
        //upload photo
        if($request->photo)
        {
            $photo_path = $request->photo->store('photos', 'images');
            $data['photo'] = $photo_path;
            $admin->user->deletePhoto();
        }


        //save to user
        if($admin->user()->update($data))
        {
            $admin->update($data);
            return redirect()->route('admin.profile.index')->with('success', 'Pengguna berhasil diubah');
        }else{
            return redirect()->route('admin.profile.index')->with('fail', 'Pengguna gagal diubah');
        }
    }
}
