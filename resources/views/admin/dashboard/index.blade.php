@extends('admin.master')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>150</h3>

                <p>New Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
    
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$total_pengetahuan}}</h3>

                <p>Total Pengetahuan</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
             
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$total_forum}}</h3>

                <p>Total Forum</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-people"></i>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>

                <p>Unique Visitors</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
                <!-- Main row -->
                <div class="row">
          <!-- Left col -->
          <div class="col-md-8">
            <!-- PRODUCT LIST -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Berita Terbaru</h3>

              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
              @foreach($berita as $article)
                <ul class="products-list product-list-in-card pl-2 pr-2">                
                  <li class="item">
                    <div class="product-img">
                      <img src="{{$article->image_url}}" alt="Product Image" class="img-size-50">
                    </div>
                    <div class="product-info">
                      <a href="{{route('admin.articles.view', $article->id)}} class="product-title">{{$article->title}}</a>
                      <span class="product-description">{{$article->created_at}}</span>
                    </div>
                    {!! str_limit ($article->content, 270, ' ...')!!} <a href="{{route('admin.articles.view', $article->id)}}">Lihat detail </a>                   
            
                  </li>
                </ul>
                @endforeach
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <div class="col-md-4">
            <!-- PRODUCT LIST -->
            <div class="card">
              <div class="card-header">
                <h2 class="card-title">Pengetahuan Terbaru</h2>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
              @foreach($pengetahuan as $know)
                <ul class="products-list product-list-in-card pl-2 pr-2">
                  <li class="item">
                    <div class="product-img">
                      <img src="{{$know->member->user->photo_url}}" alt="Product Image" class="img-size-50">
                    </div>
                    <div class="product-info">
                      <a href="{{route('admin.knowledge.index')}}" class="product-title">{{$know->member->user->name}}</a>
                          @if($know->confirmed=='1')
                            <span class="badge badge-info float-right">Sudah Tervalidasi</span>
                              @else
                              <span class="badge badge-warning float-right">Belum Tervalidasi</span>
                          @endif
                      <span class="product-description">
                      {{$know->title}}
                      </span>
                    </div>
                  </li>
                  <!-- /.item -->
                </ul>
                @endforeach
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- PRODUCT LIST -->
            <div class="card">
              <div class="card-header">
                <h2 class="card-title">Forum Terbaru</h2>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
              @foreach($forum as $frm)
                <ul class="products-list product-list-in-card pl-2 pr-2">
                  <li class="item">
                    <div class="product-img">
                      <img src="{{$frm->user->photo_url}}" alt="Product Image" class="img-size-50">
                    </div>
                    <div class="product-info">
                      <a href="{{route('admin.forum.view', $frm->id)}}" class="product-title">{{$frm->title}}</a>
                      <span class="product-description">
                      {{$frm->user->name}}
                      </span>
                    </div>
                  </li>
                  <!-- /.item -->
                </ul>
                @endforeach
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            
          </div>
          
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection