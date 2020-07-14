<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Knowledge;
use App\Forum;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        $total_pengetahuan = Knowledge::count();
        $total_forum = Forum::count();
        $berita = Article::orderBy('id','DESC')->take(10)->get();
        $pengetahuan = Knowledge::orderBy('id','DESC')->take(5)->get();
        $forum = Forum::orderBy('id','DESC')->take(5)->get();
        return view('admin.dashboard.index',compact('total_pengetahuan', 'total_forum','berita', 'pengetahuan', 'forum'));
    }
}
