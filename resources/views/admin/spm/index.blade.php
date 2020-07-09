@extends('admin.master')

@section('content')
    
    @include('admin.spm._header')
    @include('layouts.dashboard._alert')
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="accordion table-data">
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h4 class="mb-0" data-toggle="collapse" data-target="#balance-chart" aria-expanded="true" aria-controls="table-one">
                               Dokumen SOP
                            </h4>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('admin.spm.create') }}" class="btn btn-success" style="margin-bottom: 30px;" ><span class="fa fa-plus"></span> Tambah Dokumen SOP</a>

                            <table class="table table-hover table-sm" id="spm-table">
                                <thead>
                                        <th>No</th>
                                        <th>Judul Dokumen</th>
                                        <th>Tanggal Post</th>
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
    $('#spm-table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: '{{ route('admin.spm.data') }}',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'title', name: 'title' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});
</script>
@endpush