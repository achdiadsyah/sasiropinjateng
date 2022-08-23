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
                              <input type="text" value="{{$user->regencie->name}}" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                              <label>Kepengurusan</label>
                              <input type="text" value="{{strtoupper($user->pengurus)}}" class="form-control" disabled>
                            </div>
                            <div class="form-group">
                              <label>Jenis Seminar</label>
                              <input type="text" value="{{$user->lama_seminar}} Hari" class="form-control" disabled>
                            </div>
                            <div class="form-group">
                              <label>Jadwal Seminar</label>
                              <input type="text" value="{{$user->hari_seminar ? $user->hari_seminar . " Sepetember 2022" : "17 dan 18 September 2022"}}" class="form-control" disabled>
                            </div>
                            <div class="form-group">
                              <label>Kode Unik</label>
                              <input type="text" value="{{$user->kode_unik}}" class="form-control" disabled>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection