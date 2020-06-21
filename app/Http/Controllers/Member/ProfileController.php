<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Member\Profile\ProfileUpdate;
use App\User;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $member = Auth::user()->member;
        return view('member.profile.index', compact('member'));
    }

    public function update(ProfileUpdate $request)
    {
        $member = Auth::user()->member;
        $data = $request->except(['password','photo','role','active']);

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
            $member->user->deletePhoto();
        }

        //set role member
        $data['role'] = User::USER_ROLE_MEMBER;

        //save to user
        if($member->user()->update($data))
        {
            $member->update($data);
            return redirect()->route('member.profile.index')->with('success', 'Profil berhasil diubah');
        }else{
            return redirect()->route('member.profile.index')->with('fail', 'Profil gagal diubah');
        }
    }
}
