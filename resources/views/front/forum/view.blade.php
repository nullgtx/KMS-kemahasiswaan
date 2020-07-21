@extends('front.master') 

@section('content')

 <!-- MAIN SECTION -->

 <div class="container featured-area-default padding-30">
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
                                <a href="{{route('front.dashboard.forum')}}">
                                    Forum
                                </a>
                            </li>
                            <li class="active">{{$forum->title}}</li>
                        </ol>
                    </div>
                    <!-- END BREADCRUMBS -->
                    <!-- ARTICLE  -->
                    <div class="panel panel-default">
                        <div class="article-heading margin-bottom-5">
                            
                                {{$forum->title}}
                        </div>
                        <div class="article-info">
                            <div class="art-date">
                                
                                    <i class="fa fa-calendar-o"></i> {{$forum->created_at}} 
                            </div>
                            <div class="art-category">
                                
                                    <i class="fa fa-user"></i> {{$forum->user->name}} 
                            </div>
                        </div>
                        <div class="article-content">
                            <hr>
                            <p>
                                <img style="width:100%;" src="{{$forum->image_url}}">
                            </p>
                            <hr>

                            <p>
                            {!! $forum->content !!}
                            </p>
                        
                        </div>
                        
                    </div>
                    <!-- END ARTICLE -->
                    <hr class="style-three">
                    <!-- COMMENTS  -->
                    <div class="panel panel-default">
                        <div class="article-heading">
                            <i class="fa fa-comments-o"></i> Komentar 
                        </div>
                        <div class="alert alert-warning alert-dismissible">
                        <h5><i class="icon fa fa-exclamation-triangle"></i> Silahkan <a href="{{route('login')}}"> Login </a> terlebih dahulu ! </h5>
                        </div>
                    </div>
                    <!-- END COMMENTS -->
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
                            @foreach($forumsamping as $frm)
                            <ul>
                                <li>
                                    <a href="{{route('front.forum.view', $forum->id)}}">
                                        <i class="fa fa-comments"></i> {{$frm->title}}</a>
                                </li>
                            </ul>
                            @endforeach
                        </div>
                    </div>
                </div>

                
            </div>
            <!-- END SIDEBAR STUFF -->
        </div>
    </div>

    <!-- END MAIN SECTION -->
@endsection