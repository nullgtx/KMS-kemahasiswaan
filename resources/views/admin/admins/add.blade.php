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
                                Tambah Pengguna Sistem
                            </h4>
                        </div>
                        <div class="card-body">

                            <form id="simpan" method="POST" action="{{ route('admin.admins.store') }}" enctype="multipart/form-data">
                            @csrf
                            @include('admin.admins._form', ['update' => false])

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
@push('scripts')
<script>
    document.querySelector('#simpan').addEventListener('submit', function(e) {
      var form = this;
      
      e.preventDefault();
      
      swal({
          title: "Yakin?",
          text: "Menambahkan Data Admin",
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
              text: 'Data Admin telah ditambahkan',
              icon: 'success'
            }).then(function() {
              form.submit();
            });
          } else {
            swal("Batal", "Data Admin batal ditambahkan :)", "error");
          }
        });
    });
  </script>
  @endpush