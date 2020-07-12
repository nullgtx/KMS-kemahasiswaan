<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use UxWeb\SweetAlert\SweetAlert;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function index(){
        
        return view('member.dashboard.index');
    }
}
