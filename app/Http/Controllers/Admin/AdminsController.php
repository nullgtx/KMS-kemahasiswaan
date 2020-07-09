<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\Admins\AdminsStore;
use App\Http\Requests\Admin\Admins\AdminsUpdate;
use Illuminate\Support\Facades\Auth;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.admins.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admins.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminsStore $request)
    {
        $data = $request->all();

        //encrypt password
        $data['password'] = bcrypt($request->password);
        $data['password_text'] = $request->password;

        
        //upload photo
        if($request->photo)
        {
            $file = $request->photo;
            $filename = Str::slug($request->name) . '.' . $file->getClientOriginalExtension();            
            $data['photo'] = $file->storeAs('photos', $filename, 'images');
        }else{
            $data['photo'] = User::USER_PHOTO_DEFAULT;
        }

        //set role admin
        $data['role'] = User::USER_ROLE_ADMIN;

        //save to user
        $user = User::create($data);
        if($user)
        {
            $user->admin()->create($data);
            return redirect()->route('admin.admins.index')->with('success', 'Pengguna berhasil ditambahkan');
        }else{
            return redirect()->route('admin.admins.index')->with('fail', 'Pengguna gagal ditambahkan');
        }

    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        return view('admin.admins.edit', compact('admin'));        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(AdminsUpdate $request, Admin $admin)
    {
        if($admin->user->id==Auth::user()->id)
        {
            $data = $request->except(['password','photo','level','active']);
        }else
        {
            $data = $request->except(['password','photo']);
        }
        
        //encrypt password
        if($request->password)
        {
            $data['password'] = bcrypt($request->password);
            $data['password_text'] = $request->password;

        }
        
        //upload photo
        if($request->photo)
        {
            $file = $request->photo;
            $filename = Str::slug($request->name) . '.' . $file->getClientOriginalExtension();            
            $data['photo'] = $file->storeAs('photos', $filename, 'images');
            $admin->user->deletePhoto();
        }

        //set role admin
        $data['role'] = User::USER_ROLE_ADMIN;

       

        //save to user
        if($admin->user()->update($data))
        {
            $admin->update($data);
            return redirect()->route('admin.admins.index')->with('success', 'Pengguna berhasil diubah');
        }else{
            return redirect()->route('admin.admins.index')->with('fail', 'Pengguna gagal diubah');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        if ($admin->user->id == Auth::user()->id)
        {
            return redirect()->back()->with('fail', 'Anda tidak dapat menghapus akun anda sendiri');
        }

        $admin->user->deletePhoto();
        $admin->user()->delete();

        return redirect()->back()->with('success', 'Pengguna berhasil dihapus');

    }

    /**
     * Show admins for datatables
     *
     * @param  \App\Admin  $member
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $admins = Admin::with('user')->latest()->get();

        return DataTables::of($admins)
                ->addIndexColumn()
                ->addColumn('action', function ($admins) {

                    $form_start = '<form method="POST" class="form-delete" action="'.route('admin.admins.destroy', $admins->id).'">'.
                                    csrf_field().method_field('DELETE');
                    $form_body = '<a href="'.route('admin.admins.edit', $admins->id).'" class="btn btn-default btn-success"><span class="fa fa-pencil"></span></a>
                                    <button type="submit" onclick="return confirm(\'Apakah anda yakin untuk menghapus data ini ?\');" class="btn btn-default btn-danger"><span class="fa fa-trash"></span></button>';
                    $form_end = '</form>';

                    return $form_start.$form_body.$form_end;
                })
                ->editColumn('status', function($admins)
                {
                    return $admins->user->active_in_label;
                })
                ->rawColumns(['action','status'])
                ->make(true);
    }
}
