@extends('member.master')

@section('content')
@include('member.articles._header')

<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="accordion table-data">
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h4 class="mb-0" data-toggle="collapse" data-target="#balance-chart" aria-expanded="true" aria-controls="table-one">
                               Berita Terbaru
                            </h4>
                        </div>

<div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                  @foreach($berita as $article)
                    <!-- Post -->
                    <div class="post">
                      <div class="user-block">
                        <img class="profile-user-img img-fluid img-circle" src="{{$article->admin->user->photo_url}}" alt="">
                        <span class="username">
                        <span class="badge badge-info float-right">wewew</span>
                        <h4> <a href="{{route('member.articles.view', $article->id)}}">{{$article->title}} </a> </h4>
                        </span>
                        <span class="description">{{$article->created_at}}</span>
                      </div>
                      <!-- /.user-block -->
                      <p>
                      {!! str_limit ($article->content, 200, ' ...')!!} <a href="{{route('member.articles.view', $article->id)}}">Lihat detail </a>                   
                      </p>
                      
                    </div>
                    <!-- /.post -->
                    @endforeach
                  </div>
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
          </div>
      </div>
    </div>
  </div>
</div>
@endsection

