@extends('front.master')

@section('content')
<!-- MAIN SECTION -->

<div class="row">
            <div class="col-md-8 padding-20">
                <div class="row">
                    <!-- BREADCRUMBS -->
                    <div class="breadcrumb-container">
                        <ol class="breadcrumb">
                            <li>
                                <a href="{{route('front.dashboard')}}">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('front.dashboard.knowledge')}}">
                                    Pengetahuan
                                </a>
                            </li>
                            <li class="active">Hasil Pencarian  </li>
                        </ol>
                    </div>
                    <!-- END BREADCRUMBS -->
                    <hr class="style-three">
                    <!-- PENGETAHUAN CATEGORIES SECTION -->
                    <div class="fb-heading">
                        Pengetahuan
                    </div>
                    <hr class="style-three">
                    <div class="row">
                        <div class="col-md-6 margin-bottom-20">
                            <div class="fat-heading-abb">
                                
                                    <i class="fa fa-folder"></i> Hasil Pencarian
                                    <span class="cat-count"> </span>
                                
                            </div>
                            <div class="fat-content-small padding-left-30">
                                @foreach($beasiswa as $bea)
                                <ul>
                                    <li>
                                    <a href="/img/{{$bea->image}}" target="_blank">
                                            <i class="fa fa-file-text-o"></i> {{$bea->title}}</a>
                                    </li>
                                    
                                </ul>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- END PENGETAHUAN CATEOGIRES SECTION -->
                    <hr class="style-three">
                    <!-- ARTICLES -->
                    <div class="fb-heading">
                        Berita
                    </div>
                    <hr class="style-three">
                    @foreach($berita as $article)
                    <div class="panel panel-default">
                        <div class="article-heading-abb">
                            <a href="{{route('front.dashboard.view', $article->id)}}">
                                 {{$article->title}}</a>
                        </div>
                        <div class="article-info">
                            <div class="art-date">
                                <a href="#">
                                    <i class="fa fa-calendar-o"></i> {{$article->created_at}} </a>
                            </div>
                            <div class="art-category">
                                <a href="#">
                                    <i class="fa fa-folder"></i> {{$article->admin->user->name}} </a>
                            </div>
                        </div>
                        <div class="article-content">
                            <p class="block-with-text">
                                {!! str_limit ($article->content, 250, ' ...')!!}
                            </p>
                        </div>
                        <div class="article-read-more">
                            <a href="{{route('front.dashboard.view', $article->id)}}" class="btn btn-default btn-wide">Lihat Detail ...</a>
                        </div>
                    </div>
                    <!-- END ARTICLES -->
                    @endforeach
                    <hr class="style-three">
                    <div class="fb-heading">
                            Forum
                        </div>
                        <hr class="style-three">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingOne">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    Forum
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                           <table class="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Topik Diskusi</th>
                                                        <th>Kategori</th>
                                                        <th>Author</th>
                                                        <th>Tanggal Post</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($forumcari as $frm)
                                                    <tr>
                                                        <td>{{$frm->title}}</td>
                                                        <td>{{$frm->level}}</td>
                                                        <td>{{$frm->user->name}}</td>
                                                        <td>{{$frm->created_at->format('d F Y')}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                </div>
            </div>

            <!-- SIDEBAR STUFF -->
            <div class="col-md-4 padding-20">
                

                <div class="row margin-top-20">
                    <div class="col-md-12">
                        <div class="fb-heading-small">
                            Pengetahuan Terbaru
                        </div>
                        <hr class="style-three">
                        <div class="fat-content-small padding-left-10">
                            @foreach($pengetahuan as $know)
                            <ul>
                                <li>
                                    <a href="/img/{{$know->image}}">
                                        <i class="fa fa-file-text-o"></i> {{$know->title}}</a>
                                </li>
                            </ul>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="row margin-top-20">
                    <div class="col-md-12">
                        <div class="fb-heading-small">
                            Forum Terbaru
                        </div>
                        <hr class="style-three">
                        <div class="fat-content-small padding-left-10">
                            @foreach($forum as $forum)
                            <ul>
                                <li>
                                    <a href="{{route('front.forum.view', $forum->id)}}">
                                        <i class="fa fa-comments"></i> {{$forum->title}}</a>
                                </li>
                            </ul>
                            @endforeach
                        </div>
                    </div>
                </div>


            </div>
            <!-- END SIDEBAR STUFF -->
        </div>

    <!-- END MAIN SECTION -->
    @endsection