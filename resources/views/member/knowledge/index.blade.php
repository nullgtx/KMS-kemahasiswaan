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
    // Delete a record
    $('#knowledge-table').on('click', 'button.hapus', function (e) {
        e.preventDefault();
        var form = $(this).parents('form');
        swal({
          title: "Yakin?",
          text: "Menghapus Pengetahuan",
          icon: "warning",
          buttons: [
            'Tidak, Batalkan',
            'Ya, Setuju!'
          ],
          dangerMode: true,
        }).then(function(isConfirm) {
          if (isConfirm) {
            swal({
              title: 'Yey!',
              text: 'Pengetahuan telah dihapus',
              icon: 'success'
            }).then(function() {
              form.submit();
            });
          } else {
            swal("Batal", "Pengetahuan batal dihapus :)", "error");
          }
        });
       
    } );

    $('#knowledge-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: '{{ route('member.knowledge.data') }}',
        columns: [
            //{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
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