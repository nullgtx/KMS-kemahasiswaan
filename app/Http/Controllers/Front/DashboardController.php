<?php

namespace App\Http\Controllers\Front;

use UxWeb\SweetAlert\SweetAlert;
use App\Article;
use App\Admin;
use App\Knowledge;
use App\Forum;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index(){
        $pengetahuan = Knowledge::orderBy('id','DESC')->take(6)->latest()->get();
        $forum = Forum::orderBy('id','DESC')->take(6)->get();
        $berita = Article::orderBy('id','DESC')->paginate(2);
        return view('front.dashboard.index',compact('pengetahuan', 'forum', 'berita'));
    }

    public function view(Article $article)
    {
        $pengetahuan = Knowledge::orderBy('id','DESC')->take(6)->latest()->get();
        $forum = Forum::orderBy('id','DESC')->take(6)->get();
        return view('front.dashboard.view',compact('article', 'pengetahuan', 'forum'));
    }

    public function cari(Request $request)
	{
        $pengetahuan = Knowledge::orderBy('id','DESC')->take(6)->latest()->get();
        $forum = Forum::orderBy('id','DESC')->take(6)->get();
		// menangkap data pencarian
		$cari = $request->cari;
 
    	// mengambil data dari table pegawai sesuai pencarian data
        $berita = Article::with('admin.user')
        ->where('title','like',"%".$cari."%")
        ->latest()
        ->get();
 
    	// mengirim data pegawai ke view index
		if(count($berita)>0)
            return view ('front.dashboard.index',compact('berita', 'forum', 'pengetahuan'));
        else return view('front.dashboard.index',compact('berita', 'forum', 'pengetahuan'))->with('warning','Masukkan kata kunci atau Topik Diskusi tidak ditemukan');
 
	}

    
}
