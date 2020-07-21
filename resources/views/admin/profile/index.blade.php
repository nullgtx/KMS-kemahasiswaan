@extends('admin.master')

@section('content')

@include('admin.profile._header')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="accordion table-data">
                    <div class="card rounded-0">
                        <div class="card-body">

                            <form id="simpan" method="POST" action="{{ route('admin.profile.update', $admin->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @include('admin.profile._form', ['update' => true])

                                <button type="submit" class="btn btn-success">Update Profil</button>
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
          text: "Mengubah Data Profile",
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
              text: 'Data Profile telah diubah',
              icon: 'success'
            }).then(function() {
              form.submit();
            });
          } else {
            swal("Batal", "Data Profile batal diubah :)", "error");
          }
        });
    });
  </script>
  @endpush