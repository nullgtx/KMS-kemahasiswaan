<?php

namespace App\Http\Controllers\Admin;

use App\Kegiatan;
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
        return view('admin.kegiatan.index');
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(kegiatan $kegiatan)
    {
        $kegiatan->delete();
        $kegiatan->deleteImage();
        return redirect()->back();

    }

    public function confirm(Kegiatan $kegiatan)
    {
        $kegiatan->confirmed = Kegiatan::KEGIATAN_STATUS_CONFIRMED;
        $kegiatan->save();

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
        $kegiatan = Kegiatan::with('member.user')->latest()->get();
        return DataTables::of($kegiatan)
                ->addIndexColumn()
                ->addColumn('action', function ($kegiatan) {
                    $form_start = '<form method="POST" class="form-delete" action="'.route('admin.kegiatan.destroy', $kegiatan->id).'">'.
                                    csrf_field().method_field('DELETE');

                    $action_acc = '<a href="'.route('admin.kegiatan.confirm', $kegiatan->id).'" class="valid btn btn-default btn-button"><span class="fa fa-check"></span> ACC</a> ';
                    $action_view =  '<a href="/img/'. $kegiatan->image. '" target="_blank" class="btn btn-default btn-success"><span class="fa fa-eye"></span></a>';
                    $action_del = '<button type="submit" class="hapus btn btn-default btn-danger"><span class="fa fa-trash"></span></button>';
                    $form_end = '</form>';

                    if ($kegiatan->confirmed==Kegiatan::KEGIATAN_STATUS_NOT_CONFIRMED)
                    {
                        $actions = $action_acc.$action_view.$action_del;
                    }else
                    {
                        $actions = $action_view.$action_del;
                    }

                    return $form_start.$actions.$form_end;
                })

                ->editColumn('created_at', function($kegiatan){
                    return $kegiatan->created_at->format('d F Y');
                })
                
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
                ->rawColumns(['action','status'])
                ->make(true);
    }
}
