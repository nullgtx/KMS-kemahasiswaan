@extends('admin.master')

@section('content')

@include('admin.profile._header')
@include('layouts.dashboard._alert')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="accordion table-data">
                    <div class="card rounded-0">
                        <div class="card-body">

                            <form method="POST" action="{{ route('admin.profile.update', $admin->id) }}" enctype="multipart/form-data">
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
