@extends('admin.master')

@section('content')
<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-title">Pengguna Sistem
                    <span style="font-weight: normal; font-size: 12px;">Data Pengguna Sistem</span>
                </h2>
                
            </div>
        </div>
    </div>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="accordion table-data">
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h4 class="mb-0" data-toggle="collapse" data-target="#balance-chart" aria-expanded="true" aria-controls="table-one">
                                Ubah Pengguna Sistem
                            </h4>
                        </div>
                        <div class="card-body">

                            <form method="POST" action="{{ route('admin.admins.update', $admin->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @include('admin.admins._form', ['update' => true])

                                <button type="submit" class="btn btn-success">Simpan Data</button>
                                <a href="{{ route('admin.admins.index') }}" class="btn btn-link">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
