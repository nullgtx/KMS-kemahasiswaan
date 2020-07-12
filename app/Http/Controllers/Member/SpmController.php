<?php

namespace App\Http\Controllers\Member;

use App\Spm;
use App\User;
use UxWeb\SweetAlert\SweetAlert;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Mail;

class SpmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function index()
    {
        $dokumen = Spm::with('admin.user')->latest()->get();
        return view('member.spm.index',compact('dokumen'));
    }

    
}
