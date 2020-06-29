@extends('admin.master')

@section('content')
    @include('admin.members._header')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="accordion table-data">
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h4 class="mb-0" data-toggle="collapse" data-target="#balance-chart" aria-expanded="true" aria-controls="table-one">
                                Tambah Data Mahasiswa
                            </h4>
                        </div>
                        <div class="card-body">

                            <form method="POST" action="{{ route('admin.members.store') }}" enctype="multipart/form-data">
                            @csrf
                            @include('admin.members._form', ['update' => false])

                                <button type="submit" class="btn btn-success">Simpan Data</button>
                                <a href="{{ route('admin.members.index') }}" class="btn btn-link">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
