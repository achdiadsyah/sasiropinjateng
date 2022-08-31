@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Verified Users
                </div>
                <div class="card-body">
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
                                    <td>Jenis Seminar</td>
                                    <td>Total Bayar</td>
                                    <td>Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $item)
                                    @php
                                        $hari = substr($item->hari_seminar,0,1);
                                        $biaya = '300000' * $hari + $item->kode_unik;
                                    @endphp
                                    <tr>
                                        <td>#</td>
                                        <td>{{$item->nama}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>{{$item->no_handphone}}</td>
                                        <td>{{$item->province->name}}</td>
                                        <td>{{$item->regencie ? $item->regencie->name : '-'}}</td>
                                        <td>{{ucwords($item->jenis_seminar)}}</td>
                                        <td>Rp. {{number_format($biaya)}}</td>
                                        <td>
                                            <a href="{{route('admin.verified-user')}}?id={{$item->id}}" class="btn btn-sm btn-danger">Selengkapnya</a>
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