@extends('admin.master')

@section('content')
    @include('admin.spm._header')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="accordion table-data">
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h4 class="mb-0" data-toggle="collapse" data-target="#balance-chart" aria-expanded="true" aria-controls="table-one">
                                Ubah Dokumen SOP
                            </h4>
                        </div>
                        <div class="card-body">

                            <form method="POST" action="{{ route('admin.spm.update', $spm->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @include('admin.spm._form', ['update' => true])

                                <button type="submit" class="btn btn-success">Simpan Dokumen</button>
                                <a href="{{ route('admin.spm.index') }}" class="btn btn-link">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
