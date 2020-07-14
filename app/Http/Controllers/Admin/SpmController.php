<?php

namespace App\Http\Controllers\Admin;

use App\Spm;
use App\Admin;
use App\User;
use UxWeb\SweetAlert\SweetAlert;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\Spm\SpmStore;
use App\Http\Requests\Admin\Spm\SpmUpdate;

class SpmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.spm.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.spm.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SpmStore $request)
    {
        $data = $request->except('admin_id');
        $data['admin_id'] = Auth::user()->admin->id;

        //upload file
        if($request->image)
        {
            $file = $request->image;
            $filename = Str::slug($request->title) . '.' . $file->getClientOriginalExtension();            
            $data['image'] = $file->storeAs('spm', $filename, 'images');
        }else{
            $data['image'] = Spm::ARTICLE_IMAGE_DEFAULT;
        }

        $spm = Spm::create($data);
        if($spm)
        {
            return redirect()->route('admin.spm.index');
        }else{
            return redirect()->route('admin.spm.index')->with('fail', 'Dokumen gagal ditambahkan');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Spm  $spm
     * @return \Illuminate\Http\Response
     */
    public function edit(Spm $spm)
    {
        return view('admin.spm.edit', compact('spm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Spm  $spm
     * @return \Illuminate\Http\Response
     */
    public function update(SpmUpdate $request, Spm $spm)
    {
        $data = $request->except('admin_id');
        $data['admin_id'] = Auth::user()->admin->id;

        //upload file
        if($request->image)
        {
            $file = $request->image;
            $filename = Str::slug($request->title) . '.' . $file->getClientOriginalExtension();            
            $data['image'] = $file->storeAs('spm', $filename, 'images');
            $spm->deleteImage();
        }

        if($spm->update($data))
        {
            return redirect()->route('admin.spm.index');
        }else{
            return redirect()->route('admin.spm.index')->with('fail', 'Dokumen gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Spm  $spm
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spm $spm)
    {
        $spm->delete();
        $spm->deleteImage();
        return redirect()->back();
    }


    /**
     * Show spm for datatables
     *
     * @param  \App\Spm  $spm
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $spm = Spm::latest()->get();

        return DataTables::of($spm)
                ->addIndexColumn()
                ->addColumn('action', function ($spm) {

                    $form_start = '<form method="POST" class="form-delete" action="'.route('admin.spm.destroy', $spm->id).'">'.
                                    csrf_field().method_field('DELETE');
                   
                    $action =  '<a href="'.route('admin.spm.edit', $spm->id).'" class="btn btn-default btn-success"><span class="fa fa-pencil"></span></a>
                    <a href="/img/'. $spm->image. '" target="_blank" class="btn btn-default btn-success"><span class="fa fa-eye"></span></a>
                    <button type="submit" class="hapus btn btn-default btn-danger"><span class="fa fa-trash"></span></button>';
                    $form_end = '</form>';

                    return $form_start.$action.$form_end;
                })
                ->editColumn('created_at', function($spm){
                    return $spm->created_at->format('d F Y');
                })
                ->rawColumns(['action'])
                ->make(true);
    }
}
