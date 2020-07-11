@extends('member.master')

@section('content')
@include('member.articles._header')
@include('layouts.dashboard._alert')

<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="accordion table-data">
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h7 class="mb-0" data-toggle="collapse" data-target="#balance-chart" aria-expanded="true" aria-controls="table-one">
                            Author : {{$article->admin->user->name}}
                            </h7>
                        </div>

              <!-- Main content -->
          <section class="content"> 
            <!-- Default box -->
            <div class="card card-solid">
              <div class="card-body">
                <div class="row">
                  <div class="col-12 col-sm-6">
                    <h3 class="d-inline-block d-sm-none">{{$article->title}}</h3>
                    <div class="col-12">
                      <img src="{{$article->image_url}}" class="product-image" alt="Product Image">
                    </div>
                  </div>
                  <div class="col-12 col-sm-6">
                    <h3 class="my-3">{{$article->title}}</h3>
                    <hr>
                    <p>{!! $article->content !!}</p>

                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
<!-- /.content -->
      </div>
    </div>
  </div>
</div>
</div>
@endsection

