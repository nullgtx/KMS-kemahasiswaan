<?php

namespace App\Http\Controllers\Admin;

use App\Forum;
use App\User;
use UxWeb\SweetAlert\SweetAlert;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
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
        $diskusi = Forum::with('user')->latest()->get();
        return view('admin.forum.index',compact('diskusi'));
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
		return view('admin.forum.index',compact('diskusi'));
 
	}

    public function view(Forum $forum)
    {
        
        return view('admin.forum.view',compact('forum'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Knowledge  $knowledge
     * @return \Illuminate\Http\Response
     */
    public function destroy(Forum $forum)
    {
        $forum->delete();
        $forum->deleteImage();
        return redirect()->back()->with('success', 'Forum berhasil dihapus');
    }

}
