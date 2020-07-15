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
                                Tambah Dokumen Kegiatan
                            </h4>
                        </div>
                        <div class="card-body">

                            <form id="simpan" method="POST" action="{{ route('member.kegiatan.store') }}" enctype="multipart/form-data">
                            @csrf
                            @include('member.kegiatan._form', ['update' => false])

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
    document.querySelector('#simpan').addEventListener('submit', function(e) {
      var form = this;
      
      e.preventDefault();
      
      swal({
          title: "Yakin?",
          text: "Menambahkan Dokumen Kegiatan",
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
              text: 'Dokumen Kegiatan telah ditambahkan',
              icon: 'success'
            }).then(function() {
              form.submit();
            });
          } else {
            swal("Batal", "Dokumen Kegiatan batal ditambahkan :)", "error");
          }
        });
    });
  </script>
  @endpush