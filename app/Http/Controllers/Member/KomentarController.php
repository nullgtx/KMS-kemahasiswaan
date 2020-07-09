<?php

namespace App\Http\Controllers\Member;

use App\Forum;
use App\User;
use App\Komentar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Member\Komentar\KomentarStore;
use App\Http\Requests\Member\Komentar\KomentarUpdate;
use Illuminate\Support\Facades\Mail;

class KomentarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Forum $forum)
    {
        $data['forum_id'] = $forum->id;
        $data['user_id'] = Auth::user()->id;
        $data['content'] = $request->content;

        $komentar = Komentar::create($data);
        if($forum)
        {
            // Mail::to($invoice->member->user->email)->send(new DepositSubmitMail($invoice));
            return redirect()->back()->with('success', 'komentar telah ditambahkan');
        }else
        {
            return redirect()->back()->with('fail', 'komentar gagal ditambahkan');
        }
    }

}
