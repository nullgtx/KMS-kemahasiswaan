@extends('front.master')

@section('content')
<!-- MAIN SECTION -->
<div class="row">
            <div class="col-md-8 padding-20">

                <!-- ARTICLE CATEGORIES SECTION -->
                <div class="row">
                <!-- BREADCRUMBS -->
                <div class="breadcrumb-container">
                        <ol class="breadcrumb">
                            <li>
                                <a href="index.html">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <li class="active">Forum</li>
                        </ol>
                    </div>
                    <!-- END BREADCRUMBS -->
                    <div class="col-md-12">
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
                                                    Beasiswa
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                           <table class="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Topik Diskusi</th>
                                                        <th>Author</th>
                                                        <th>Tanggal Post</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($beasiswa as $beasiswa)
                                                    <tr>
                                                        <td><a href="{{route('front.forum.view', $beasiswa->id)}}">{{$beasiswa->title}} </a></td>
                                                        <td>{{$beasiswa->user->name}}</td>
                                                        <td>{{$beasiswa->created_at->format('d F Y')}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingTwo">
                                            <h4 class="panel-title">
                                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false"
                                                    aria-controls="collapseTwo">
                                                    PKM
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                            <table class="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Topik Diskusi</th>
                                                        <th>Author</th>
                                                        <th>Tanggal Post</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($pkm as $pkm)
                                                    <tr>
                                                        <td><a href="{{route('front.forum.view', $pkm->id)}}">{{$pkm->title}}</a></td>
                                                        <td>{{$pkm->user->name}}</td>
                                                        <td>{{$pkm->created_at->format('d F Y')}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingThree">
                                            <h4 class="panel-title">
                                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false"
                                                    aria-controls="collapseThree">
                                                    Transkrip Aktivitas Mahasiswa
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                            <table class="table table-bordered table-striped table-hover">
                                            <thead>
                                                    <tr>
                                                        <th>Topik Diskusi</th>
                                                        <th>Author</th>
                                                        <th>Tanggal Post</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($tak as $tak)
                                                    <tr>
                                                        <td><a href="{{route('front.forum.view', $tak->id)}}">{{$tak->title}}</a></td>
                                                        <td>{{$tak->user->name}}</td>
                                                        <td>{{$tak->created_at->format('d F Y')}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingFour">
                                            <h4 class="panel-title">
                                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false"
                                                    aria-controls="collapseFour">
                                                    Asuransi
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                                            <table class="table table-bordered table-striped table-hover">
                                            <thead>
                                                    <tr>
                                                        <th>Topik Diskusi</th>
                                                        <th>Author</th>
                                                        <th>Tanggal Post</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($asuransi as $asuransi)
                                                    <tr>
                                                        <td><a href="{{route('front.forum.view', $asuransi->id)}}">{{$asuransi->title}}</a></td>
                                                        <td>{{$asuransi->user->name}}</td>
                                                        <td>{{$asuransi->created_at->format('d F Y')}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingFive">
                                            <h4 class="panel-title">
                                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false"
                                                    aria-controls="collapseFive">
                                                    Kegiatan Mahasiswa
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                                            <table class="table table-bordered table-striped table-hover">
                                            <thead>
                                                    <tr>
                                                        <th>Topik Diskusi</th>
                                                        <th>Author</th>
                                                        <th>Tanggal Post</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($kegiatan as $kegiatan)
                                                    <tr>
                                                        <td><a href="{{route('front.forum.view', $kegiatan->id)}}">{{$kegiatan->title}}</a></td>
                                                        <td>{{$kegiatan->user->name}}</td>
                                                        <td>{{$kegiatan->created_at->format('d F Y')}}</td>
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
            </div>
            <!-- END ARTICLES CATEOGIRES SECTION -->
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