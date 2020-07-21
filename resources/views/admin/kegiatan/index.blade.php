@extends('admin.master')

@section('content')

    @include('admin.kegiatan._header')

    
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="accordion table-data">
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h4 class="mb-0" data-toggle="collapse" data-target="#balance-chart" aria-expanded="true" aria-controls="table-one">
                            Dokumen Kegiatan
                            </h4>
                        </div>
                        <div class="card-body">

                            <table class="table table-hover table-sm" id="kegiatan-table">
                                <thead>
                                <th>No</th>
                                        <th>Judul Dokumen</th>
                                        <th>Author</th>
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
    $('#kegiatan-table').on('click', 'button.hapus', function (e) {
        e.preventDefault();
        var form = $(this).parents('form');
        swal({
          title: "Yakin?",
          text: "Menghapus Dokumen Kegiatan",
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
              text: 'Dokumen Kegiatan telah dihapus',
              icon: 'success'
            }).then(function() {
              form.submit();
            });
          } else {
            swal("Batal", "Dokumen Kegiatan batal dihapus :)", "error");
          }
        });
       
    } );

    $('#kegiatan-table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: '{{ route('admin.kegiatan.data') }}',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'title', name: 'title' },
            { data: 'member.user.name', name: 'member.user.name' },
            { data: 'created_at', name: 'created_at' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});
</script>
@endpush