@extends('admin.master')

@section('content')
    @include('admin.members._header')
    @include('layouts.dashboard._alert')

    
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="accordion table-data">
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h4 class="mb-0" data-toggle="collapse" data-target="#balance-chart" aria-expanded="true" aria-controls="table-one">
                                Data Mahasiswa
                            </h4>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('admin.members.create') }}" class="btn btn-success" style="margin-bottom: 30px;" ><span class="fa fa-plus"></span> Tambah Data Mahasiswa</a>

                            <table class="table table-hover table-sm" id="members-table">
                                    <thead>
                                            <th>No</th>
                                            <th>NIM</th>
                                            <th>Nama Member</th>
                                            <th>Email</th>
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
    $('#members-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('admin.members.data') }}',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'nim', name: 'nim' },
            { data: 'user.name', name: 'user.name' },
            { data: 'user.email', name: 'user.email' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false}

        ]
    });
});
</script>
@endpush