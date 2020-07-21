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
                            <li class="active">{{$article->title}}</li>
                        </ol>
                    </div>
                    <!-- END BREADCRUMBS -->
                    <!-- ARTICLE  -->
                    <div class="panel panel-default">
                        <div class="article-heading margin-bottom-5">
                            
                                {{$article->title}}
                        </div>
                        <div class="article-info">
                            <div class="art-date">
                                
                                    <i class="fa fa-calendar-o"></i> {{$article->created_at}} 
                            </div>
                            <div class="art-category">
                                
                                    <i class="fa fa-user"></i> {{$article->admin->user->name}} 
                            </div>
                        </div>
                        <div class="article-content">
                            <hr>
                            <p>
                                <img style="width:100%;" src="{{$article->image_url}}">
                            </p>
                            <hr>

                            <p>
                            {!! $article->content !!}
                            </p>
                        
                        </div>
                        
                    </div>
                    <!-- END ARTICLE -->
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
    </div>

    <!-- END MAIN SECTION -->
@endsection