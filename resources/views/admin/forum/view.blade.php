@extends('admin.master')

@section('content')
@include('admin.forum._header')
@include('layouts.dashboard._alert')

<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="accordion table-data">
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h4 class="mb-0" data-toggle="collapse" data-target="#balance-chart" aria-expanded="true" aria-controls="table-one">
                            {{$forum->title}}
                            </h4>
                        </div>

<div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                 
                      <!-- Post -->
                      <div class="post">
                        <div class="user-block">
                          <img class="img-circle img-bordered-sm" src="{{$forum->user->photo_url}}" alt="">
                          <span class="username">
                          <span class="badge badge-info float-right">{{$forum->level}}</span>
                            {{$forum->user->name}}
                          </span>
                          <span class="description">{{$forum->created_at}}</span>
                        </div>
                        <!-- /.user-block -->
                        <p>
                        {!!$forum->content!!}                    
                        </p>
                        
                      </div>
                      <!-- /.post -->
                  </div>
                </div>
                <!-- /.tab-content -->
                      
                <hr>
                <h4>Komentar </h4>
                <!-- /.card-header -->
                <div class="card-body p-0">
                @foreach($forum->komentar as $komen)
                  <ul class="products-list product-list-in-card pl-2 pr-2">
                    <li class="item">
                    <div class="user-block">
                          <img class="img-circle img-bordered-sm" src="{{$komen->user->photo_url}}" alt="">
                      </div>
                      <div class="product-info">
                      @if($komen->user->id==Auth::user()->id)
                      <form action="{{ route('admin.komentar.destroy', $komen->id) }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <span class="badge-sm badge-danger float-right"><button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Yakin ingin menghapus data?')"><i class="fa fa-times"></i></button></span>
                      </form>
                              @else
                      @endif

                        <span class="username" style="color:#6c757d;font-size:16px;font-weight:600;margin-top:-1px;">
                        {{$komen->user->name}}
                        </span>
                        <span class="description" style="color:#6c757d;font-size:13px;margin-top:-3px;">{{$komen->created_at->diffForHumans()}}</span>
                        <span class="product-description">
                        {{$komen->content}}
                        </span>
                      </div>
                    </li>
                  </ul>
                  @endforeach
                </div>
                <form method="post" action="{{ route('admin.komentar.store', $forum) }}" class="form-horizontal">
                      @csrf
                        <div class="input-group input-group-sm mb-0">
                          <input id="content" name="content" type="text" class="form-control form-control-sm" placeholder="Tambahkan Komentar ...">
                          <div class="input-group-append">
                            <button type="submit" class="btn btn-success">Simpan komenar</button>
                          </div>
                        </div>
                      </form>
                <!-- /.card-body -->
              </div><!-- /.card-body -->
          </div>
      </div>
    </div>
  </div>
</div>
@endsection

