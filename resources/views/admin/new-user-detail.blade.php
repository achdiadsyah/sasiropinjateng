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
                            <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#modalDelete">
                                <i class="fas fa-trash fa-sm fa-fw mr-2 text-gray-400"></i>
                                Delete User
                            </a>
                            <a class="btn btn-success" href="#" data-toggle="modal" data-target="#modalVerify">
                                <i class="fas fa-check fa-sm fa-fw mr-2 text-gray-400"></i>
                                Verify User
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="delete-form" action="{{ route('admin.delete') }}" method="POST">
                @csrf
                <input type="hidden" value="{{$user->id}}" name="id" required>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Yakin Ingin Menghapus user ini?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Delete" below if you are ready to delete this user.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modalVerify" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="verify-form" action="{{ route('admin.verify') }}" method="POST">
                @csrf
                <input type="hidden" value="{{$user->id}}" name="id" required>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Yakin Ingin Memverifikasi user ini?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Verify" below if you are ready to verify a payment from this user.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal" name="btnCancelVerify">Cancel</button>
                        <button class="btn btn-success" type="submit" onClick="$('#verify-form').submit(); this.disabled = true;  btnCancelVerify.disabled = true; this.innerText ='Trying to verify...';">Verify</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection