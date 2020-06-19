<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    public function login()
    {
        return view('auth.login');
    }

    public function ceklogin(Request $request)
    {
        $this->validate($request,[
            'password' => 'required|min:5',
        ]);

        $login =[
    		'email' => $request->email,
    		'password' => $request->password
    	];

        if(Auth::attempt($login))
       {
           return redirect()->route('dashboard');
       }
       return redirect()->route('login')->with(['error'=>'Email atau password yang dimasukan salah']);
    }

    public function cekRole(){
        if (Auth::user()->role==User::USER_ROLE_ADMIN){
            return redirect()->route('admin.dashboard');
        } else if (Auth::user()->role==User::USER_ROLE_MEMBER) {
            return redirect()->route('member.dashboard');
        }
        else{
            return redirect()->route('home');
        }
    }

    public function logout() 
    {
        Auth::logout();
        return redirect('/');
    }
}

    //public function check(Request $request)
    //{
    //    $this->validate($request,[
    //        'password' => 'required|min:5',
    //    ]);

    //    $data = $request->only(['email', 'password', 'remember']);
    //    $request->remember=='on' ? $remember = true: $remember = false;

    //    if(Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember))
    //   {
     //       if($request->filled('index'))
     //       {
     //           return redirect()->route('site.index');
     //       }else{
      //          return redirect()->intended(route('site.dashboard'));
     //       }
     //   }else
     //   {
     //       return redirect()->route('site.login')->with('fail', 'Email atau password anda salah');
     //   }
   // }

   // public function dashboard()
   //{
   //     if (Auth::user()->role==User::USER_ROLE_ADMIN)
    //    {
    //        return redirect()->route('admin.dashboard.index');
    //    }else
    //    {
    //       return redirect()->route('member.dashboard.index');
    //  }
   // }


    //public function forgot(Request $request)
    //{
    //    if ($request->isMethod('post'))
     //   {
    //        $this->validate($request,[
    //            'email' => 'required|email|exists:users,email',
    //        ]);
    //        
    //        $user = User::where('email', $request->email)->firstOrFail();
//
    //        Mail::to($user->email)->send(new ForgotEmail($user));
    //        return redirect()->route('site.login')->with('success', 'Password telah dikirimkan ke email anda');
//
    //    }else {
    //        return view('admin.forgot');
    //    }
   // }


