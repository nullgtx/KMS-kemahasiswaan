@extends('member.master')

@section('content')
    @include('member.kegiatan._header')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="accordion table-data">
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h4 class="mb-0" data-toggle="collapse" data-target="#balance-chart" aria-expanded="true" aria-controls="table-one">
                                Ubah Dokumen Kegiatan
                            </h4>
                        </div>
                        <div class="card-body">

                            <form id="edit" method="POST" action="{{ route('member.kegiatan.update', $kegiatan->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @include('member.kegiatan._form', ['update' => true])

                                <button type="submit" class="btn btn-success">Simpan Dokumen</button>
                                <a href="{{ route('member.kegiatan.index') }}" class="btn btn-link">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    document.querySelector('#edit').addEventListener('submit', function(e) {
      var form = this;
      
      e.preventDefault();
      
      swal({
          title: "Yakin?",
          text: "Mengubah Dokumen Kegiatan",
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
              text: 'Dokumen Kegiatan telah diubah',
              icon: 'success'
            }).then(function() {
              form.submit();
            });
          } else {
            swal("Batal", "Dokumen Kegiatan batal diubah :)", "error");
          }
        });
    });
  </script>
  @endpush