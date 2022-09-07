@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Detail Peserta
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
                    <div class="row">
                        <div class="col-6">
                          <form action="{{route('admin.update-user')}}" id="update-form" method="post">
                          @csrf
                          <input type="hidden" name="id" value="{{$user->id}}" required>
                          <div class="form-group">
                              <label>Nama</label>
                              <input type="text" name="nama" value="{{$user->nama}}" class="form-control">
                          </div>
                          <div class="form-group">
                              <label>Email</label>
                              <input type="text" value="{{$user->email}}" class="form-control" disabled>
                          </div>
                          <div class="form-group">
                              <label>Nomor STR</label>
                              <input type="text" name="nomor_str" value="{{$user->nomor_str}}" class="form-control">
                          </div>
                          </form>
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
                              if($user->jenis_seminar == "online"){
                                  $biaya = $config->biaya_online * $hari + $user->kode_unik;
                              } else {
                                  $biaya = $config->biaya_offline * $hari + $user->kode_unik;
                              }
                          @endphp
                          <div class="form-group">
                              <label>Jumlah Bayar</label>
                              <input type="text" value="Rp. {{number_format($biaya)}}" class="form-control" disabled>
                          </div>
                          <a class="btn btn-info" data-toggle="modal" data-target="#modalUpdate">
                              <i class="fas fa-pen fa-sm fa-fw mr-2 text-gray-400"></i>
                              Update Data
                          </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin ingin merubah data user ini?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Tekan "Update" dibawah ini jika anda ingin merubah data.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal" name="btnCancelUpdate">Cancel</button>
                    <button class="btn btn-danger" type="submit" name="btnYesUpdate" onClick="$('#update-form').submit(); btnYesUpdate.disabled = true;  btnCancelUpdate.disabled = true; btnYesUpdate.innerText ='Trying to update...';">Update</button>
                </div>
            </div>
        </div>
    </div>
@endsection