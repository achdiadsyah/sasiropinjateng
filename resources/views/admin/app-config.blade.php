@extends('layouts.admin')
@php
    $config = App\Models\AppConfig::first();
@endphp
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    App Config
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
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                        <div class="alert alert-warning" role="alert">
                            {{ $error }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endforeach
                    @endif
                    <form action="{{route('admin.app-config-update')}}" method="post" id="appConfigForm" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Nama Bank</label>
                                    <input type="text" name="nama_bank" class="form-control" value="{{$config->nama_bank}}">
                                </div>
                                <div class="form-group">
                                    <label>Atas Nama</label>
                                    <input type="text" name="atas_nama" class="form-control" value="{{$config->atas_nama}}">
                                </div>
                                <div class="form-group">
                                    <label>Nomor Rekening</label>
                                    <input type="text" name="rekening" class="form-control" value="{{$config->rekening}}">
                                </div>
                                <div class="form-group">
                                    <label>Biaya OFFLINE / Hari</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Rp. </span>
                                        <input type="text" name="biaya_offline" class="form-control" value="{{$config->biaya_offline}}">
                                        <span class="input-group-text" id="basic-addon1">per Hari</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Biaya ONLINE / Hari</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Rp. </span>
                                        <input type="text" name="biaya_online" class="form-control" value="{{$config->biaya_online}}">
                                        <span class="input-group-text" id="basic-addon1">per Hari</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Contact Person</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">https://wa.me/</span>
                                        <input type="number" class="form-control" name="contact_person" placeholder="62xxxx" value="{{$config->contact_person}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center">
                                    <img src="{{asset('images/'.$config->gambar)}}" alt="" width="50%">
                                </div>
                                <div class="form-group">
                                    <label>Gambar Depan</label>
                                    <input type="file" name="gambar" class="form-control" accept="image/*">
                                    <small class="text-muted">Allowed : JPG, JPEG, PNG | Max : 2MB</small>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary" onClick="$('#appConfigForm').submit(); this.disabled = true; this.innerText ='Trying to update...';">Save Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection