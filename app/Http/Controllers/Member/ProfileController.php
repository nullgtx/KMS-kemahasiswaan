<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use UxWeb\SweetAlert\SweetAlert;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
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
            $file = $request->photo;
            $current = Str::slug($request->nim);
            $filename = Str::slug($request->name) . '.' . $file->getClientOriginalExtension();            
            $data['photo'] = $file->storeAs('photos', $current . '-' . $filename, 'images');
            $member->user->deletePhoto();
        }

        //set role member
        $data['role'] = User::USER_ROLE_MEMBER;

        //save to user
        if($member->user()->update($data))
        {
            $member->update($data);
            return redirect()->route('member.profile.index');
        }else{
            return redirect()->route('member.profile.index')->with('warning', 'Profil gagal diubah');
        }
    }
}
