<?php

namespace App\Http\Controllers\Admin;

use App\Member;
use UxWeb\SweetAlert\SweetAlert;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\Members\MembersStore;
use App\User;
use App\Http\Requests\Admin\Members\MembersUpdate;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisteredEmail;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.members.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.members.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MembersStore $request)
    {
        $data = $request->all();

        //encrypt password
        $data['password'] = bcrypt($request->password);
        
        //upload photo
        if($request->photo)
        {
            $file = $request->photo;
            $current = Str::slug($request->nim);
            $filename = Str::slug($request->name) . '.' . $file->getClientOriginalExtension();            
            $data['photo'] = $file->storeAs('photos', $current . '-' . $filename, 'images');
        }else{
            $data['photo'] = User::USER_PHOTO_DEFAULT;
        }

        $data['password_text'] = $request->password;

        //set role admin
        $data['role'] = User::USER_ROLE_MEMBER;

        //set active
        $data['active'] = User::USER_IS_ACTIVE;

        //save to user
        $user = User::create($data);
        if($user)
        {
            $user->member()->create($data);

            $user->member->save();

            return redirect()->route('admin.members.index');
        }else{
            return redirect()->route('admin.members.index')->with('fail', 'Member gagal ditambahkan');
        }
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        return view('admin.members.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(MembersUpdate $request, Member $member)
    {
        $data = $request->except(['password','photo']);

        //encrypt password
        if($request->password)
        {
            $data['password'] = bcrypt($request->password);
        }
        
        //upload photo
        if($request->photo)
        {
            $file = $request->photo;
            $current = Str::slug($request->nim);
            $filename = Str::slug($request->name) . '.' . $file->getClientOriginalExtension();            
            $data['photo'] = $file->storeAs('photos', $current . '-' . $filename, 'images');
            $member->user->deletePhoto();
        }

        //set role admin
        $data['role'] = User::USER_ROLE_MEMBER;

        //save to user
        if($member->user()->update($data))
        {
            $member->update($data);

            $member->save();

            return redirect()->route('admin.members.index');
        }else{
            return redirect()->route('admin.members.index')->with('fail', 'Member gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        $member->user->deletePhoto();
        $member->user()->delete();

        return redirect()->back();
    }

    /**
     * Show members for datatables
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    

    public function data()
    {
        $members = Member::with('user')->latest()->get();

        return DataTables::of($members)
                ->addIndexColumn()
                ->addColumn('action', function ($members) {

                    $form_start = '<form method="POST" class="form-delete" action="'.route('admin.members.destroy', $members->id).'">'.
                                    csrf_field().method_field('DELETE');
                    $form_body = '<a href="'.route('admin.members.edit', $members->id).'" class="btn btn-default btn-success"><span class="fa fa-pencil"></span></a>
                                    <button type="submit" class="hapus btn btn-default btn-danger"><span class="fa fa-trash"></span></button>';
                    $form_end = '</form>';

                    return $form_start.$form_body.$form_end;
                })
                ->editColumn('status', function($members)
                {
                    return $members->user->active_in_label;
                })
                ->rawColumns(['action','status'])
                ->make(true);
    }

    
}
