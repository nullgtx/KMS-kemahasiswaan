@extends('admin.master')

@section('content')
@include('admin.forum._header')

<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="accordion table-data">
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h4 class="mb-0" data-toggle="collapse" data-target="#balance-chart" aria-expanded="true" aria-controls="table-one">
                               Forum Diskusi
                            </h4>
                        </div>

<div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                  @foreach($diskusi as $forum)
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
                      <a href="{{route('admin.forum.view', $forum->id)}}"><h4> {{$forum->title}} </h4></a>                    
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

