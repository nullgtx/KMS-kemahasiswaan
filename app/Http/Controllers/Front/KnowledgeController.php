<?php

namespace App\Http\Controllers\Front;

use App\Knowledge;
use App\Forum;
use App\Spm;
use App\Article;
use App\User;
use UxWeb\SweetAlert\SweetAlert;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class KnowledgeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengetahuan = Knowledge::orderBy('id','DESC')->take(6)->latest()->get();
        $beasiswa = Knowledge::orderBy('id','DESC')->where('level','beasiswa')->take(6)->get();
        $pkm = Knowledge::orderBy('id','DESC')->where('level','pkm')->take(6)->get();
        $tak = Knowledge::orderBy('id','DESC')->where('level','tak')->take(6)->get();
        $asuransi = Knowledge::orderBy('id','DESC')->where('level','asuransi')->take(6)->get();
        $kegiatan = Knowledge::orderBy('id','DESC')->where('level','kegiatan')->take(6)->get();
        $forum = Forum::orderBy('id','DESC')->take(6)->get();
        $spm = Spm::orderBy('id','DESC')->latest()->get();
        return view('front.pengetahuan.index',compact('pengetahuan', 'beasiswa', 'pkm', 'tak', 'asuransi', 'kegiatan','forum', 'spm'));
    }

    public function cari(Request $request)
	{
        $forum = Forum::orderBy('id','DESC')->take(6)->get();
        $pengetahuan = Knowledge::orderBy('id','DESC')->take(6)->latest()->get();
		// menangkap data pencarian
		$cari = $request->cari;
 
    	// mengambil data dari table pegawai sesuai pencarian data
        $beasiswa = Knowledge::with('member.user')
        ->where('title','like',"%".$cari."%")
        ->orwhere('level','like',"%".$cari."%")
        ->latest()
        ->get();

        $berita = Article::with('admin.user')
        ->where('title','like',"%".$cari."%")
        ->latest()
        ->get();

        $forumcari = Forum::with('user')
        ->where('title','like',"%".$cari."%")
        ->orwhere('level','like',"%".$cari."%")
        ->latest()
        ->get();
 
    	// mengirim data pegawai ke view index
		if(count($beasiswa)>0)
            return view ('front.pengetahuan.hasil',compact('beasiswa', 'pengetahuan', 'forum', 'berita', 'forumcari'));
        else return view('front.pengetahuan.hasil',compact('beasiswa', 'pengetahuan', 'forum', 'berita', 'forumcari'))->with('warning','Masukkan kata kunci atau Pengetahuan tidak ditemukan');
 
	}

}
