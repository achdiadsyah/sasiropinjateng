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
                                    <label>Biaya / Hari</label>
                                    <input type="text" name="biaya" class="form-control" value="{{$config->biaya}}">
                                </div>
                                <div class="form-group">
                                    <label>Contact Person</label>
                                    <input type="text" name="contact_person" class="form-control" value="{{$config->contact_person}}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center">
                                    <img src="{{asset('storage/'.$config->gambar)}}" alt="" width="50%">
                                </div>
                                <div class="form-group">
                                    <label>Gambar Depan</label>
                                    <input type="file" name="gambar" class="form-control">
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