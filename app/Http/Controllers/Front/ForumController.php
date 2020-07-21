<?php

namespace App\Http\Controllers\Front;

use App\Knowledge;
use App\Forum;
use App\Spm;
use App\User;
use UxWeb\SweetAlert\SweetAlert;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengetahuan = Forum::orderBy('id','DESC')->take(6)->latest()->get();
        $beasiswa = Forum::orderBy('id','DESC')->where('level','beasiswa')->take(6)->get();
        $pkm = Forum::orderBy('id','DESC')->where('level','pkm')->take(6)->get();
        $tak = Forum::orderBy('id','DESC')->where('level','tak')->take(6)->get();
        $asuransi = Forum::orderBy('id','DESC')->where('level','asuransi')->take(6)->get();
        $kegiatan = Forum::orderBy('id','DESC')->where('level','kegiatan')->take(6)->get();
        $forum = Forum::orderBy('id','DESC')->take(6)->get();
        $spm = Spm::orderBy('id','DESC')->latest()->get();
        return view('front.forum.index',compact('pengetahuan', 'beasiswa', 'pkm', 'tak', 'asuransi', 'kegiatan','forum', 'spm'));
    }

    public function view(Forum $forum)
    {
        $pengetahuan = Knowledge::orderBy('id','DESC')->take(6)->latest()->get();
        $forumsamping = Forum::orderBy('id','DESC')->take(6)->get();
        return view('front.forum.view',compact('forum', 'pengetahuan', 'forumsamping'));
    }

    public function cari(Request $request)
	{
		// menangkap data pencarian
		$cari = $request->cari;
 
    	// mengambil data dari table pegawai sesuai pencarian data
        $diskusi = Forum::with('user')
        ->where('title','like',"%".$cari."%")
        ->latest()
        ->get();
 
    	// mengirim data pegawai ke view index
		return view('front.forum.index',compact('diskusi'));
 
	}

}
