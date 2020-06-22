@extends('admin.master')

@section('content')
    @include('admin.articles._header')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="accordion table-data">
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h4 class="mb-0" data-toggle="collapse" data-target="#balance-chart" aria-expanded="true" aria-controls="table-one">
                                Ubah Berita
                            </h4>
                        </div>
                        <div class="card-body">

                            <form method="POST" action="{{ route('admin.articles.update', $article->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @include('admin.articles._form', ['update' => true])

                                <button type="submit" class="btn btn-success">Simpan Berita</button>
                                <a href="{{ route('admin.articles.index') }}" class="btn btn-link">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
