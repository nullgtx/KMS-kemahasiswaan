<?php

namespace App\Http\Controllers\Member;

use App\Forum;
use App\User;
use UxWeb\SweetAlert\SweetAlert;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Member\Forum\ForumStore;
use App\Http\Requests\Member\Forum\ForumUpdate;
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
        return view('member.forum.index');
    }

    public function indexsatu()
    {
        $diskusi = Forum::with('user')->latest()->get();
        return view('member.forum.semua',compact('diskusi'));
    }

    public function view(Forum $forum)
    {
        
        return view('member.forum.view',compact('forum'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('member.forum.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ForumStore $request)
    {
        $data = $request->only(['title', 'content', 'level', 'image']);

        $data['user_id'] = Auth::user()->id;
        
        //upload file
        if($request->image)
        {
            $file = $request->image;
            $filename = Str::slug($request->title) . '.' . $file->getClientOriginalExtension();            
            $data['image'] = $file->storeAs('forum', $filename, 'images');
        }else{
            $data['image'] = Forum::FORUM_IMAGE_DEFAULT;
        }

        $forum = Forum::create($data);
        if($forum)
        {
            // Mail::to($invoice->member->user->email)->send(new DepositSubmitMail($invoice));
            return redirect()->route('member.forum.index');
        }else
        {
            return redirect()->route('member.forum.index')->with('warning', 'Forum gagal ditambahkan');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Knowledge  $knowledge
     * @return \Illuminate\Http\Response
     */
    public function edit(Forum $forum)
    {
        return view('member.forum.edit', compact('forum'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Knowledge  $knowledge
     * @return \Illuminate\Http\Response
     */
    public function update(ForumUpdate $request, Forum $forum)
    {
        $data = $request->only(['title', 'content', 'level', 'image']);

        $data['user_id'] = Auth::user()->id;

        //upload file
        if($request->image)
        {
            $file = $request->image;
            $filename = Str::slug($request->title) . '.' . $file->getClientOriginalExtension();            
            $data['image'] = $file->storeAs('forum', $filename, 'images');
        }else{
            $data['image'] = Forum::FORUM_IMAGE_DEFAULT;
        }

        if($forum->update($data))
        {
            return redirect()->route('member.forum.index');
        }else{
            return redirect()->route('member.forum.index')->with('warning', 'Forum gagal diubah');
        }
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
        return redirect()->back();
    }

   

    /**
     * Show deposits for datatables
     *
     * @param  \App\Invoice  $member
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        //$forum = Forum::latest()->get(); 
        //$knowledge = Knowledge::where('member_id', "=" , Auth::user()->member->id);
        $forum = Forum::with('user')->fromUser(Auth::user()->id)->latest()->get();
        return DataTables::of($forum)
                ->addIndexColumn()
                ->addColumn('action', function ($forum) {

                    $form_start = '<form method="POST" class="form-delete" action="'.route('member.forum.destroy', $forum->id).'">'.
                                    csrf_field().method_field('DELETE');
                   
                    $action =  '<a href="'.route('member.forum.edit', $forum->id).'" class="btn btn-default btn-success"><span class="fa fa-pencil"></span></a>
                    <a href="'.route('member.forum.view', $forum->id).'" class="btn btn-default btn-success"><span class="fa fa-eye"></span></a>
                    <button type="submit" class="hapus btn btn-default btn-danger"><span class="fa fa-trash"></span></button>';
                    $form_end = '</form>';

                    return $form_start.$action.$form_end;
                })
                ->editColumn('created_at', function($forum){
                    return $forum->created_at->format('d F Y');
                })
                ->rawColumns(['action'])
                ->make(true);
    }

}
