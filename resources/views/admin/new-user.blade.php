@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    New Users
                </div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-{{ session('status') }}" role="alert">
                        {{ session('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Nama</td>
                                    <td>Email</td>
                                    <td>No Telepon</td>
                                    <td>Asal Pengda</td>
                                    <td>Asal Pengcab</td>
                                    <td>Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $item)
                                    <tr>
                                        <td>#</td>
                                        <td>{{$item->nama}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>{{$item->no_handphone}}</td>
                                        <td>{{$item->province->name}}</td>
                                        <td>{{$item->regencie->name}}</td>
                                        <td>
                                            <a href="{{route('admin.new-user')}}?id={{$item->id}}" class="btn btn-sm btn-danger">Selengkapnya</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection