@extends('front.master')

@section('content')
<!-- MAIN SECTION -->

<div class="row">
            <!-- ARTICLE OVERVIEW SECTION -->
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
                        </ol>
                    </div>
                    <!-- END BREADCRUMBS -->
                    <!-- ARTICLES -->
                    <div class="fb-heading">
                        Berita Terbaru
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
                </div>
                {{ $berita->links() }}
            </div>
            <!-- END ARTICLES OVERVIEW SECTION-->
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