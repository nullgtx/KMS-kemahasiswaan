@extends('member.master')

@section('content')
    
    @include('member.knowledge._header')
    @include('layouts.dashboard._alert')
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="accordion table-data">
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h4 class="mb-0" data-toggle="collapse" data-target="#balance-chart" aria-expanded="true" aria-controls="table-one">
                               Dokumen Pengetahuan
                            </h4>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('member.knowledge.create') }}" class="btn btn-success" style="margin-bottom: 30px;" ><span class="fa fa-plus"></span> Tambah Dokumen Pengetahuan</a>

                            <table class="table table-hover table-sm" id="knowledge-table">
                                <thead>
                                        <th>No</th>
                                        <th>Author</th>
                                        <th>Judul Dokumen</th>
                                        <th>Tanggal Post</th>
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
    $('#knowledge-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: '{{ route('member.knowledge.data') }}',
        columns: [
            //{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'id', name: 'id' },
            { data: 'member.user.name', name: 'member.user.name' },
            { data: 'title', name: 'title' },
            { data: 'created_at', name: 'created_at' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});
</script>
@endpush