<?php

namespace App\Http\Controllers\Member;

use App\Kegiatan;
use App\Member;
use App\User;
use UxWeb\SweetAlert\SweetAlert;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Member\Kegiatan\KegiatanStore;
use App\Http\Requests\Member\Kegiatan\KegiatanUpdate;
use Illuminate\Support\Facades\Mail;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('member.kegiatan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('member.kegiatan.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KegiatanStore $request)
    {
        $data = $request->except('member_id');
        $data['member_id'] = Auth::user()->member->id;
        $data['confirmed'] = Kegiatan::KEGIATAN_STATUS_NOT_CONFIRMED;

        //upload file
        if($request->image)
        {
            $file = $request->image;
            $current = date('Ymd');
            $filename = Str::slug($request->title) . '.' . $file->getClientOriginalExtension();            
            $data['image'] = $file->storeAs('kegiatan', $current . '-' .   $filename, 'images');
        }else{
            $data['image'] = Kegiatan::ARTICLE_IMAGE_DEFAULT;
        }

        $kegiatan = Kegiatan::create($data);
        if($kegiatan)
        {
            // Mail::to($invoice->member->user->email)->send(new DepositSubmitMail($invoice));
            return redirect()->route('member.kegiatan.index');
        }else
        {
            return redirect()->route('member.kegiatan.index')->with('warning', 'Dokumen Kegiatan gagal ditambahkan');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Knowledge  $knowledge
     * @return \Illuminate\Http\Response
     */
    public function edit(Kegiatan $kegiatan)
    {
        return view('member.kegiatan.edit', compact('kegiatan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Knowledge  $knowledge
     * @return \Illuminate\Http\Response
     */
    public function update(KegiatanUpdate $request, Kegiatan $kegiatan)
    {
        $data = $request->except(['member_id','image', 'confirmed']);
        $data['member_id'] = Auth::user()->member->id;

        //upload file
        if($request->image)
        {
            $kegiatan->deleteImage();
            $file = $request->image;
            $current = date('Ymd');
            $filename = Str::slug($request->title) . '.' . $file->getClientOriginalExtension();            
            $data['image'] = $file->storeAs('kegiatan', $current . '-' .  $filename, 'images');
        }

        if($kegiatan->update($data))
        {
            return redirect()->route('member.kegiatan.index');
        }else{
            return redirect()->route('member.kegiatan.index')->with('warning', 'Dokumen Kegiatan gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Knowledge  $knowledge
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kegiatan $kegiatan)
    {
        $kegiatan->delete();
        $kegiatan->deleteImage();
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
        
        $kegiatan = Kegiatan::with('member.user')->fromMember(Auth::user()->member->id)->latest()->get();
        return DataTables::of($kegiatan)
                ->addIndexColumn()
                ->editColumn('status', function($kegiatan)
                {
                    if ($kegiatan->confirmed==Kegiatan::KEGIATAN_STATUS_NOT_CONFIRMED)
                    {
                        return '<span class="badge badge-danger">Belum di Validasi</span>';                        
                    }else
                    {
                        return '<span class="badge badge-info">Sudah di Validasi</span>';
                    }
                })
                ->addColumn('action', function ($kegiatan) {

                    $form_start = '<form method="POST" class="form-delete" action="'.route('member.kegiatan.destroy', $kegiatan->id).'">'.
                    csrf_field().method_field('DELETE');
   
                    $action =  '<a href="'.route('member.kegiatan.edit', $kegiatan->id).'" class="btn btn-default btn-success"><span class="fa fa-pencil"></span></a>
                    <a href="/img/'. $kegiatan->image. '" target="_blank" class="btn btn-default btn-success"><span class="fa fa-eye"></span></a>
                    <button type="submit"  class="hapus btn btn-default btn-danger"><span class="fa fa-trash"></span></button>';
                    $form_end = '</form>';

                    return $form_start.$action.$form_end;

                })
                ->editColumn('created_at', function($kegiatan){
                    return $kegiatan->created_at->format('d F Y');
                })
                ->rawColumns(['status','action'])
                ->make(true);
    }

    

}
