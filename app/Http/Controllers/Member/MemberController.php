<?php

namespace App\Http\Controllers\Member;

use App\Article;
use App\Knowledge;
use App\Forum;
use App\User;
use Illuminate\Http\Request;
use UxWeb\SweetAlert\SweetAlert;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function index(){
        $total_pengetahuan = Knowledge::count();
        $total_pengetahuanku = Knowledge::with('member.user')->fromMember(Auth::user()->member->id)->count();
        $total_forum = Forum::count();
        $tidak_valid = Knowledge::with('member.user')->fromMember(Auth::user()->member->id)->where('confirmed',0)->count();
        $berita = Article::orderBy('id','DESC')->take(10)->get();
        $pengetahuan = Knowledge::with('member.user')->fromMember(Auth::user()->member->id)->orderBy('id','DESC')->take(5)->get();
        $forum = Forum::orderBy('id','DESC')->take(5)->get();
        return view('member.dashboard.index',compact('total_pengetahuan','total_pengetahuanku', 'total_forum', 'tidak_valid', 'berita', 'pengetahuan', 'forum'));
    }
}
