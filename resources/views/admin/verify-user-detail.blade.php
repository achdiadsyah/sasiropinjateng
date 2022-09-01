@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    User Details
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                          <div class="form-group">
                            <label>Nama</label>
                            <input type="text" value="{{$user->nama}}" class="form-control" disabled>
                          </div>
                          <div class="form-group">
                            <label>Email</label>
                            <input type="text" value="{{$user->email}}" class="form-control" disabled>
                          </div>
                          <div class="form-group">
                            <label>Nomor STR</label>
                            <input type="text" value="{{$user->nomor_str}}" class="form-control" disabled>
                          </div>
                          <div class="form-group">
                            <label>Nomor Handphone</label>
                            <input type="text" value="{{$user->no_handphone}}" class="form-control" disabled>
                          </div>
                          <div class="form-group">
                            <label>Asal Pengda</label>
                            <input type="text" value="{{$user->province->name}}" class="form-control" disabled>
                          </div>
                          <div class="form-group">
                            <label>Asal Pengcab</label>
                            <input type="text" value="{{$user->regencie ? $user->regencie->name : '-'}}" class="form-control" disabled>
                          </div>
                      </div>
                      <div class="col-6">
                          <div class="form-group">
                            <label>Jenis Seminar</label>
                            <input type="text" value="{{strtoupper($user->jenis_seminar)}}" class="form-control" disabled>
                          </div>
                          <div class="form-group">
                            <label>Jadwal Seminar</label>
                            <input type="text" value="{{$user->hari_seminar}}" class="form-control" disabled>
                          </div>
                          <div class="form-group">
                            <label>Kode Unik</label>
                            <input type="text" value="{{$user->kode_unik}}" class="form-control" disabled>
                          </div>
                          @php
                              $config = App\Models\AppConfig::first();
                              $hari = substr($user->hari_seminar,0,1);
                              $biaya = $config->biaya * $hari + $user->kode_unik;
                          @endphp
                          <div class="form-group">
                              <label>Jumlah Bayar</label>
                              <input type="text" value="Rp. {{number_format($biaya)}}" class="form-control" disabled>
                          </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection