@extends('member.master')

@section('content')
@include('member.spm._header')

<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="accordion table-data">
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h4 class="mb-0" data-toggle="collapse" data-target="#balance-chart" aria-expanded="true" aria-controls="table-one">
                               List Dokumen
                            </h4>
                        </div>
                        
<div class="card-body">
          <div class="row">
            <div class="col-12 col-md-12 col-lg-12 order-2 order-md-1">
              <div class="row">
                <div class="col-12">
                  
                  @foreach($dokumen as $spm)
                    <div class="post">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="{{$spm->admin->user->photo_url}}" alt="">
                        <span class="username">
                        <span class="badge badge-primary float-right">{{$spm->level}}</span>
                          
                          <a href="#">{{$spm->admin->user->name}}</a>

                        </span>
                        <span class="description">{{$spm->created_at}}</span>
                      </div>
                      <!-- /.user-block -->
                      <p>
                        <h4> {{$spm->title}} </h4>
                      </p>
                      <p>
                      <a href="/img/{{$spm->image}}" target="_blank" class="link-black text-sm"><i class="fa fa-link mr-1"></i> Dowload Dokumen</a>
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

