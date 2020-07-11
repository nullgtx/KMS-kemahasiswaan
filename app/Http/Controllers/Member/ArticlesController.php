<?php

namespace App\Http\Controllers\Member;

use App\Article;
use App\Admin;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Mail;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $berita = Article::with('admin.user')->latest()->get();
        return view('member.articles.index',compact('berita'));
    }

    public function view(Article $article)
    {
        return view('member.articles.view',compact('article'));
    }

}
