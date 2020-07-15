@extends('member.master')

@section('content')
@include('member.knowledge._header')

<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="accordion table-data">
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h3 class="card-title">
                              <i class="fas fa-chart-pie mr-1"></i>
                              Dokumen Pengetahuan
                            </h3>
                            <div class="card-tools">
                              <!-- SEARCH FORM -->
                               
                                <form action="semuaknowledge/cari" method="GET">
                                  <input type="text" name="cari" placeholder="Cari pengetahuan .." value="{{ old('cari') }}">
                                  <input type="submit" value="CARI">
                                </form>
                            </div>
                        </div>
                        
<div class="card-body">
          <div class="row">
            <div class="col-12 col-md-12 col-lg-12 order-2 order-md-1">
              <div class="row">
                <div class="col-12">
                  
                  @foreach($pengetahuan as $know)
                    <div class="post">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="{{$know->member->user->photo_url}}" alt="">
                        <span class="username">
                        <span class="badge badge-primary float-right">{{$know->level}}</span>
                          
                          <a href="#">{{$know->member->user->name}}</a>
                          @if($know->confirmed=='1')
                            <span class="badge badge-info float-right">Sudah Tervalidasi</span>
                              @else
                              <span class="badge badge-warning float-right">Belum Tervalidasi</span>
                          @endif
                        </span>
                        <span class="description">{{$know->created_at}}</span>
                      </div>
                      <!-- /.user-block -->
                      <p>
                        <h4> {{$know->title}} </h4>
                      </p>
                      <p>
                      <a href="/img/{{$know->image}}" target="_blank" class="link-black text-sm"><i class="fa fa-link mr-1"></i> Dowload Dokumen</a>
                      </p>
                    </div>
                    @endforeach

                    
                </div>
              </div>
            </div>
            
          </div>
        </div>
        <!-- /.card-body -->
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

