<?php

namespace App\Http\Controllers\Member;

use App\Knowledge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Member\Knowledge\KnowledgeStore;
use App\Http\Requests\Member\Knowledge\KnowledgeUpdate;
use Illuminate\Support\Facades\Mail;

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
        $data = $request->only(['title', 'level', 'image']);

        $data['member_id'] = Auth::user()->member->id;
        $data['confirmed'] = Knowledge::KNOWLEDGE_STATUS_NOT_CONFIRMED;

        //upload image
        $file = $request->image;
        $filename = Str::slug($request->title) . '.' . $file->getClientOriginalExtension();            
        $data['image'] = $file->storeAs('knowledge', $filename, 'images');

        $knowledge = Knowledge::create($data);
        if($knowledge)
        {
            // Mail::to($invoice->member->user->email)->send(new DepositSubmitMail($invoice));
            return redirect()->route('member.knowledge.index')->with('success', 'Pengetahuan telah ditambahkan');
        }else
        {
            return redirect()->route('member.knowledge.index')->with('fail', 'Pengetahuan gagal ditambahkan');
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
        return view('admin.knowledge.edit', compact('knowledge'));
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
        $data = $request->only(['title', 'level', 'image']);

        $data['member_id'] = Auth::user()->member->id;
        $data['confirmed'] = Knowledge::KNOWLEDGE_STATUS_NOT_CONFIRMED;

        //upload file
        if($request->image)
        {
            $file = $request->image;
            $filename = Str::slug($request->title) . '.' . $file->getClientOriginalExtension();            
            $data['image'] = $file->storeAs('knowledge', $filename, 'images');

            $knowledge = Knowledge::create($data);
            $knowledge->deleteImage();
        }

        if($knowledge->update($data))
        {
            return redirect()->route('admin.knowledge.index')->with('success', 'Pengetahuan berhasil diubah');
        }else{
            return redirect()->route('admin.knowledge.index')->with('fail', 'Pengetahuan gagal diubah');
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
        return redirect()->back()->with('success', 'Pengetahuan berhasil dihapus');
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
                    <button type="submit" onclick="return confirm(\'Apakah anda yakin untuk menghapus data ini ?\');" class="btn btn-default btn-danger"><span class="fa fa-trash"></span></button>';
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
