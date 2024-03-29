@extends('member.master')

@section('content')
    @include('member.forum._header')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="accordion table-data">
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h4 class="mb-0" data-toggle="collapse" data-target="#balance-chart" aria-expanded="true" aria-controls="table-one">
                                Ubah Topik Diskusi
                            </h4>
                        </div>
                        <div class="card-body">

                            <form id="edit" method="POST" action="{{ route('member.forum.update', $forum->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @include('member.forum._form', ['update' => true])

                                <button type="submit" class="btn btn-success">Simpan Diskusi</button>
                                <a href="{{ route('member.forum.index') }}" class="btn btn-link">Batal</a>
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
          text: "Mengubah Topik Diskusi",
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
              text: 'Topik Diskusi telah diubah',
              icon: 'success'
            }).then(function() {
              form.submit();
            });
          } else {
            swal("Batal", "Topik Diskusi batal diubah :)", "error");
          }
        });
    });
  </script>
  @endpush
