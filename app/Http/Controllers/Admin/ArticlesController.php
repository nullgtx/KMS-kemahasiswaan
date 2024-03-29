<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use UxWeb\SweetAlert\SweetAlert;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\Articles\ArticlesStore;
use App\Http\Requests\Admin\Articles\ArticlesUpdate;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.articles.index');
    }

    public function indexsemua()
    {
        $berita = Article::with('admin.user')->latest()->get();
        return view('admin.articles.semua',compact('berita'));
    }

    public function view(Article $article)
    {
        return view('admin.articles.view',compact('article'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.articles.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticlesStore $request)
    {
        $data = $request->except('admin_id');
        $data['admin_id'] = Auth::user()->admin->id;

        //upload photo
        if($request->image)
        {
            $file = $request->image;
            $current = date('Ymd');
            $filename = Str::slug($request->title) . '.' . $file->getClientOriginalExtension();            
            $data['image'] = $file->storeAs('articles', $current . '-' .  $filename, 'images');
        }else{
            $data['image'] = Article::ARTICLE_IMAGE_DEFAULT;
        }

        $article = Article::create($data);
        if($article)
        {
            return redirect()->route('admin.articles.index');
        }else{
            return redirect()->route('admin.articles.index')->with('fail', 'Berita gagal ditambahkan');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(ArticlesUpdate $request, Article $article)
    {
        $data = $request->except(['admin_id', 'image']);
        $data['admin_id'] = Auth::user()->admin->id;

        //upload photo
        if($request->image)
        {
            $article->deleteImage();
            $file = $request->image;
            $current = date('Ymd');
            $filename = Str::slug($request->title) . '.' . $file->getClientOriginalExtension();            
            $data['image'] = $file->storeAs('articles', $current . '-' .  $filename, 'images');
            
        }

        if($article->update($data))
        {
            return redirect()->route('admin.articles.index');
        }else{
            return redirect()->route('admin.articles.index')->with('fail', 'Berita gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        $article->deleteImage();
        return redirect()->back();
    }


    /**
     * Show articles for datatables
     *
     * @param  \App\Article  $articles
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $articles = Article::latest()->get();

        return DataTables::of($articles)
                ->addIndexColumn()
                ->addColumn('action', function ($articles) {

                    $form_start = '<form method="POST" class="form-delete" action="'.route('admin.articles.destroy', $articles->id).'">'.
                                    csrf_field().method_field('DELETE');
                   
                    $action =  '<a href="'.route('admin.articles.edit', $articles->id).'" class="btn btn-default btn-success"><span class="fa fa-pencil"></span></a>
                    <a href="'.route('admin.articles.view', $articles->id).'" class="btn btn-default btn-success"><span class="fa fa-eye"></span></a>
                                    <button type="submit" class="hapus btn btn-default btn-danger"><span class="fa fa-trash"></span></button>';
                    $form_end = '</form>';

                    return $form_start.$action.$form_end;
                })
                ->editColumn('created_at', function($articles){
                    return $articles->created_at->format('d F Y');
                })
                ->rawColumns(['action'])
                ->make(true);
    }
}
