@extends('admin.master')

@section('content')

    @include('admin.knowledge._header')
    @include('layouts.dashboard._alert')
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="accordion table-data">
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h4 class="mb-0" data-toggle="collapse" data-target="#balance-chart" aria-expanded="true" aria-controls="table-one">
                                Data Pengetahuan Mahasiswa
                            </h4>
                        </div>
                        <div class="card-body">

                            <table class="table table-hover table-sm" id="knowledge-table">
                                <thead>
                                <th>No</th>
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
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: '{{ route('admin.knowledge.data') }}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'title', name: 'title' },
            { data: 'created_at', name: 'created_at' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});
</script>
@endpush