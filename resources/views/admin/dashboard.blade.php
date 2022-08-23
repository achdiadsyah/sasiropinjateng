@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2 ml-2">
                        <div class="text-md font-weight-bold text-primary text-uppercase mb-1">
                            Pendaftar Baru
                        </div>
                        <h3>{{$count_new}} User</h3>
                        <a href="{{route('admin.new-user')}}" class="btn btn-sm btn-primary">See All</a>
                    </div>
                    <div class="col-auto mr-2 mr-2">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2 ml-2">
                        <div class="text-md font-weight-bold text-primary text-uppercase mb-1">
                            Sudah Verifikasi Pembayaran
                        </div>
                        <h3>{{$count_verified}} User</h3>
                        <a href="{{route('admin.verified-user')}}" class="btn btn-sm btn-primary">See All</a>
                    </div>
                    <div class="col-auto mr-2 mr-2">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection