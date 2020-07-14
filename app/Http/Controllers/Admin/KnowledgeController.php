<?php

namespace App\Http\Controllers\Admin;

use App\Knowledge;
use UxWeb\SweetAlert\SweetAlert;
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
        return view('admin.knowledge.index');
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Knowledge $knowledge)
    {
        $knowledge->delete();
        $knowledge->deleteImage();
        return redirect()->back();

    }

    public function confirm(Knowledge $knowledge)
    {
        $knowledge->confirmed = Knowledge::KNOWLEDGE_STATUS_CONFIRMED;
        $knowledge->save();

        //Mail::to($deposit->member->user->email)->send(new DepositConfirmedMail($deposit));                

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
        $knowledge = Knowledge::with('member.user')->latest()->get();
        return DataTables::of($knowledge)
                ->addIndexColumn()
                ->addColumn('action', function ($knowledge) {
                    $form_start = '<form method="POST" class="form-delete" action="'.route('admin.knowledge.destroy', $knowledge->id).'">'.
                                    csrf_field().method_field('DELETE');

                    $action_acc = '<a href="'.route('admin.knowledge.confirm', $knowledge->id).'" class="valid btn btn-default btn-button"><span class="fa fa-check"></span> ACC</a> ';
                    $action_view =  '<a href="/img/'. $knowledge->image. '" target="_blank" class="btn btn-default btn-success"><span class="fa fa-eye"></span></a>';
                    $action_del = '<button type="submit" class="hapus btn btn-default btn-danger"><span class="fa fa-trash"></span></button>';
                    $form_end = '</form>';

                    if ($knowledge->confirmed==Knowledge::KNOWLEDGE_STATUS_NOT_CONFIRMED)
                    {
                        $actions = $action_acc.$action_view.$action_del;
                    }else
                    {
                        $actions = $action_view.$action_del;
                    }

                    return $form_start.$actions.$form_end;
                })
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
                ->rawColumns(['action','status'])
                ->make(true);
    }
}
