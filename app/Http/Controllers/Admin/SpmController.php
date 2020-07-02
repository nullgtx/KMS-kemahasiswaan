<?php

namespace App\Http\Controllers\Admin;

use App\Spm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $data = $request->all();

        //upload file
        if($request->image)
        {
            $image_path = $request->image->store('spm', 'images');
            $data['image'] = $image_path;
        }else{
            $data['image'] = Spm::ARTICLE_IMAGE_DEFAULT;
        }

        $spm = Spm::create($data);
        if($spm)
        {
            return redirect()->route('admin.spm.index')->with('success', 'Dokumen berhasil ditambahkan');
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
        $data = $request->all();

        //upload file
        if($request->image)
        {
            $image_path = $request->image->store('spm', 'images');
            $data['image'] = $image_path;
            $spm->deleteImage();
        }

        if($spm->update($data))
        {
            return redirect()->route('admin.spm.index')->with('success', 'Dokumen berhasil diubah');
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
        return redirect()->back()->with('success', 'Dokumen berhasil dihapus');
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
                                    <button type="submit" onclick="return confirm(\'Apakah anda yakin untuk menghapus data ini ?\');" class="btn btn-default btn-danger"><span class="fa fa-trash"></span></button>';
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
