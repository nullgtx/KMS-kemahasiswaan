@extends('admin.master')

@section('content')

@include('admin.admins._header')
@include('layouts.dashboard._alert')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="accordion table-data">
                <div class="card rounded-0">
                    <div class="card-header">
                        <h4 class="mb-0" data-toggle="collapse" data-target="#balance-chart" aria-expanded="true" aria-controls="table-one">
                            Data Pengguna Sistem
                        </h4>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('admin.admins.create') }}" class="btn btn-success" style="margin-bottom: 30px;" ><span class="fa fa-plus"></span> Tambah Data Admin</a>

                        <table class="table table-hover table-sm" id="admins-table">
                                <thead>
                                        <th>No</th>
                                        <th>Email</th>
                                        <th>Nama</th>
                                        <th>Jabatan</th>
                                        <th>Hak Akses</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                </thead>
                        </table>
                        
                        

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(function() {
    $('#admins-table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: '{{ route('admin.admins.data') }}',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'user.email', name: 'user.email' },
            { data: 'user.name', name: 'user.name' },
            { data: 'position', name: 'position' },
            { data: 'level', name: 'level' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false}

        ]
    });
});
</script>
@endpush