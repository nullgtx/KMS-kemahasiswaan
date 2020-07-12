@extends('member.master')

@section('content')


    @include('member.profile._header')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="accordion table-data">
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h4 class="mb-0" data-toggle="collapse" data-target="#balance-chart" aria-expanded="true" aria-controls="table-one">
                                Ubah Profile Mahasiswa
                            </h4>
                        </div>
                        <div class="card-body">

                            <form method="POST" action="{{ route('member.profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @include('member.profile._form', ['update' => true])

                                <button type="submit" class="btn btn-success">Update Profile</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
