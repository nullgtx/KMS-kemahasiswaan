<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        

        $this->validate($request,[
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5',
            'name' => 'required',
            'nim' => 'required|unique:members,nim',
        ]);

        $data = $request->all();

        //encrypt password
        $data['password'] = bcrypt($request->password);
        
        //set photo
        $data['photo'] = User::USER_PHOTO_DEFAULT;

        //set role member
        $data['role'] = User::USER_ROLE_MEMBER;

        //set not active
        $data['active'] = User::USER_IS_ACTIVE;

        //create user
        $user = User::create($data);
        if($user)
        {

            //create member
            $member = $user->member()->create($data);
            
            //Mail::to($member->user->email)->send(new WaitingEmail($member));                
            

            return redirect()->route('login')->with('success', 'Akun berhasil dibuat');
        }else{
            return redirect()->route('register')->with('fail', 'Akun gagal dibuat');
        }

    }
}
