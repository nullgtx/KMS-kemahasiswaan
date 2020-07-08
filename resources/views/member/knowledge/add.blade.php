@extends('member.master')

@section('content')
    @include('member.knowledge._header')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="accordion table-data">
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h4 class="mb-0" data-toggle="collapse" data-target="#balance-chart" aria-expanded="true" aria-controls="table-one">
                                Tambah Dokumen Pengetahuan
                            </h4>
                        </div>
                        <div class="card-body">

                            <form method="POST" action="{{ route('member.knowledge.store') }}" enctype="multipart/form-data">
                            @csrf
                            @include('member.knowledge._form', ['update' => false])

                                <button type="submit" class="btn btn-success">Simpan Dokumen</button>
                                <a href="{{ route('member.knowledge.index') }}" class="btn btn-link">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
