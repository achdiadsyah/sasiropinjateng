@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Sudah Verifikasi
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
                                    <td>Asal PENGDA</td>
                                    <td>Asal PENGCAB</td>
                                    <td>Jenis Seminar</td>
                                    <td>Biaya</td>
                                    <td>Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $item)
                                    @php
                                        $config = App\Models\AppConfig::first();
                                        $hari = substr($item->hari_seminar,0,1);
                                        if($item->jenis_seminar == "online"){
                                            $biaya = $config->biaya_online * $hari + $item->kode_unik;
                                        } else {
                                            $biaya = $config->biaya_offline * $hari + $item->kode_unik;
                                        }
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