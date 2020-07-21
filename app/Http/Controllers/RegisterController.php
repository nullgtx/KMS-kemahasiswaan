<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use UxWeb\SweetAlert\SweetAlert;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisteredEmail;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        

        $this->validate($request,[
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'name' => 'required',
            'nim' => 'required|unique:members,nim',
        ]);

        $allowed= array("ittelkom-pwt.ac.id", "st3telkom.ac.id");

$domainEmail = explode("@",$request->email)[1];
if (!in_array($domainEmail,$allowed)){
	return redirect()->back()->with('warning', 'Bukan email institusi');
}

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
            
            //kirim email
            //Mail::to($member->user->email)->send(new RegisteredEmail($member));                
            

            return redirect()->route('login')->with('success', 'Akun berhasil dibuat');
        }else{
            return redirect()->route('register')->with('warning', 'Akun gagal dibuat');
        }

    }
}
