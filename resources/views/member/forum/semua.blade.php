@extends('member.master')

@section('content')
@include('member.forum._header')


<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="accordion table-data">
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h3 class="card-title">
                              <i class="fas fa-chart-pie mr-1"></i>
                              Forum Diskusi
                            </h3>
                            <div class="card-tools">
                              <!-- SEARCH FORM -->
                               
                                <form action="{{ route('member.forum.cari') }}" method="GET">
                                  <input type="text" name="cari" placeholder="Cari forum .." value="{{ old('cari') }}">
                                  <input type="submit" value="CARI">
                                </form>
                            </div>
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
                      <a href="{{route('member.forum.view', $forum->id)}}"><h4> {{$forum->title}} </h4></a>                    
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

