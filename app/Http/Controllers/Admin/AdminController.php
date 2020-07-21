<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Knowledge;
use App\Forum;
use App\User;
use App\Kegiatan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        $total_pengetahuan = Knowledge::count();
        $total_forum = Forum::count();
        $tidak_kegiatan = Kegiatan::with('member.user')->where('confirmed',0)->count();
        $tidak_pengetahuan = Knowledge::with('member.user')->where('confirmed',0)->count();
        $berita = Article::orderBy('id','DESC')->paginate(2);
        $pengetahuan = Knowledge::orderBy('id','DESC')->take(5)->get();
        $forum = Forum::orderBy('id','DESC')->take(5)->get();
        return view('admin.dashboard.index',compact('total_pengetahuan', 'total_forum', 'tidak_kegiatan', 'tidak_pengetahuan','berita', 'pengetahuan', 'forum'));
    }
}
