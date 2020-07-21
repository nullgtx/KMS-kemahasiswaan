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
                            <li class="active">Pengetahuan</li>
                        </ol>
                    </div>
                    <!-- END BREADCRUMBS -->
                    <!-- PENGETAHUAN CATEGORIES SECTION -->
                    <div class="fb-heading">
                        Pengetahuan
                    </div>
                    <hr class="style-three">
                    <div class="row">
                        <div class="col-md-6 margin-bottom-20">
                            <div class="fat-heading-abb">
                                
                                    <i class="fa fa-folder"></i> Beasiswa
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
                        <div class="col-md-6 margin-bottom-20">
                            <div class="fat-heading-abb">
                                
                                    <i class="fa fa-folder"></i> PKM
                                    <span class="cat-count"> </span>
                                
                            </div>
                            <div class="fat-content-small padding-left-30">
                                @foreach($pkm as $pkm)
                                <ul>
                                    <li>
                                    <a href="/img/{{$pkm->image}}" target="_blank">
                                            <i class="fa fa-file-text-o"></i> {{$pkm->title}}</a>
                                    </li>
                                    
                                </ul>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-6 margin-bottom-20">
                            <div class="fat-heading-abb">
                                
                                    <i class="fa fa-folder"></i> TAK
                                    <span class="cat-count"> </span>
                                
                            </div>
                            <div class="fat-content-small padding-left-30">
                                @foreach($tak as $tak)
                                <ul>
                                    <li>
                                    <a href="/img/{{$tak->image}}" target="_blank">
                                            <i class="fa fa-file-text-o"></i> {{$tak->title}}</a>
                                    </li>
                                    
                                </ul>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-6 margin-bottom-20">
                            <div class="fat-heading-abb">
                                
                                    <i class="fa fa-folder"></i> Asuransi
                                    <span class="cat-count"></span>
                                
                            </div>
                            <div class="fat-content-small padding-left-30">
                                @foreach($asuransi as $asuransi)
                                <ul>
                                    <li>
                                    <a href="/img/{{$asuransi->image}}" target="_blank">
                                            <i class="fa fa-file-text-o"></i> {{$asuransi->title}}</a>
                                    </li>
                                    
                                </ul>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-6 margin-bottom-20">
                            <div class="fat-heading-abb">
                                
                                    <i class="fa fa-folder"></i> Kegiatan
                                    <span class="cat-count"> </span>
                                
                            </div>
                            <div class="fat-content-small padding-left-30">
                                @foreach($kegiatan as $kegiatan)
                                <ul>
                                    <li>
                                    <a href="/img/{{$kegiatan->image}}" target="_blank">
                                            <i class="fa fa-file-text-o"></i> {{$kegiatan->title}}</a>
                                    </li>
                                    
                                </ul>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-6 margin-bottom-20">
                            <div class="fat-heading-abb">
                                
                                    <i class="fa fa-folder"></i> Dokumen SOP
                                    <span class="cat-count"> </span>
                                
                            </div>
                            <div class="fat-content-small padding-left-30">
                                @foreach($spm as $spm)
                                <ul>
                                    <li>
                                        <a href="/img/{{$spm->image}}" target="_blank">
                                            <i class="fa fa-file-text-o"></i> {{$spm->title}}</a>
                                    </li>
                                    
                                </ul>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- END PENGETAHUAN CATEOGIRES SECTION -->
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