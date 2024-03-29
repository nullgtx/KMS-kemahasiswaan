<?php

namespace App\Http\Controllers\Member;

use App\Knowledge;
use App\User;
use App\Member;
use UxWeb\SweetAlert\SweetAlert;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Member\Knowledge\KnowledgeStore;
use App\Http\Requests\Member\Knowledge\KnowledgeUpdate;

class KnowledgeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('member.knowledge.index');
    }

    public function indexsatu()
    {
        $pengetahuan = Knowledge::with('member.user')->latest()->get();
        return view('member.knowledge.semua',compact('pengetahuan'));
    }

    public function cari(Request $request)
	{
		// menangkap data pencarian
		$cari = $request->cari;
 
    	// mengambil data dari table pegawai sesuai pencarian data
        $pengetahuan = Knowledge::with('member.user')
        ->where('title','like',"%".$cari."%")
        ->orwhere('level','like',"%".$cari."%")
        ->latest()
        ->get();
 
        // mengirim data pegawai ke view index
        if(count($pengetahuan)>0)
            return view ('member.knowledge.semua',compact('pengetahuan'));
        else return view('member.knowledge.semua',compact('pengetahuan'))->with('warning','Masukkan kata kunci atau pengetahuan tidak ditemukan');
 
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('member.knowledge.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KnowledgeStore $request)
    {
        $data = $request->except(['member_id','image','confirmed']);
        $data['member_id'] = Auth::user()->member->id;
        $data['confirmed'] = Knowledge::KNOWLEDGE_STATUS_NOT_CONFIRMED;

        //upload file
        if($request->image)
        {
            $file = $request->image;
            $current = date('Ymd');
            $filename = Str::slug($request->title) . '.' . $file->getClientOriginalExtension();            
            $data['image'] = $file->storeAs('knowledge', $current . '-' .  $filename, 'images');
        }else{
            $data['image'] = Knowledge::KNOWLEDGE_IMAGE_DEFAULT;
        }

        $knowledge = Knowledge::create($data);
        if($knowledge)
        {
            // Mail::to($invoice->member->user->email)->send(new DepositSubmitMail($invoice));
            return redirect()->route('member.knowledge.index');
        }else
        {
            return redirect()->route('member.knowledge.index')->with('warning', 'Pengetahuan gagal ditambahkan');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Knowledge  $knowledge
     * @return \Illuminate\Http\Response
     */
    public function edit(Knowledge $knowledge)
    {
        return view('member.knowledge.edit', compact('knowledge'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Knowledge  $knowledge
     * @return \Illuminate\Http\Response
     */
    public function update(knowledgeUpdate $request, Knowledge $knowledge)
    {
        $data = $request->except(['member_id','image','confirmed']);
        $data['member_id'] = Auth::user()->member->id;

        //upload file
        if($request->image)
        {
            $knowledge->deleteImage();
            $file = $request->image;
            $current = date('Ymd');
            $filename = Str::slug($request->title) . '.' . $file->getClientOriginalExtension();            
            $data['image'] = $file->storeAs('knowledge', $current . '-' .   $filename, 'images');

        }

        if($knowledge->update($data))
        {
            return redirect()->route('member.knowledge.index');
        }else{
            return redirect()->route('member.knowledge.index')->with('warning', 'Pengetahuan gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Knowledge  $knowledge
     * @return \Illuminate\Http\Response
     */
    public function destroy(Knowledge $knowledge)
    {
        $knowledge->delete();
        $knowledge->deleteImage();
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
        //$knowledge = Knowledge::latest()->get(); 
        //$knowledge = Knowledge::where('member_id', "=" , Auth::user()->member->id);
        $knowledge = Knowledge::with('member.user')->fromMember(Auth::user()->member->id)->latest()->get();
        return DataTables::of($knowledge)
                ->addIndexColumn()
                ->editColumn('status', function($knowledge)
                {
                    if ($knowledge->confirmed==Knowledge::KNOWLEDGE_STATUS_NOT_CONFIRMED)
                    {
                        return '<span class="badge badge-danger">Belum di Validasi</span>';                        
                    }else
                    {
                        return '<span class="badge badge-info">Sudah di Validasi</span>';
                    }
                })
                ->addColumn('action', function ($knowledge) {

                    $form_start = '<form method="POST" class="form-delete" action="'.route('member.knowledge.destroy', $knowledge->id).'">'.
                    csrf_field().method_field('DELETE');
   
                    $action =  '<a href="'.route('member.knowledge.edit', $knowledge->id).'" class="btn btn-default btn-success"><span class="fa fa-pencil"></span></a>
                    <a href="/img/'. $knowledge->image. '" target="_blank" class="btn btn-default btn-success"><span class="fa fa-eye"></span></a>
                    <button type="submit"  class="hapus btn btn-default btn-danger"><span class="fa fa-trash"></span></button>';
                    $form_end = '</form>';

                    return $form_start.$action.$form_end;

                })
                ->editColumn('created_at', function($knowledge){
                    return $knowledge->created_at->format('d F Y');
                })
                ->rawColumns(['status','action'])
                ->make(true);
    }

    

}
