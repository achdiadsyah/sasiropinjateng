@extends('layouts.app')

@php
    $config = App\Models\AppConfig::first();
@endphp

@push('head-script')
    
@endpush
@section('content')
<div class="row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-body text-center p-5">
                <h5>
                    Pendaftaran via website telah ditutup
                    <br>
                    Bagi peserta yang ingin mengikuti seminar offline dapat langsung melakukan pendaftaran pada saat hari pelaksanaan di hotel Grasia Semarang
                </h5>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <h5 class="m-0 font-weight-bold text-primary">Informasi</h5>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <h6>
                        Informasi lebih lanjut, hubungi kami
                    </h6>
                    <a href="https://api.whatsapp.com/send/?phone={{$config->contact_person}}&text&type=phone_number&app_absent=0"  target="_blank" class="btn btn-lg btn-success">
                        <i class="fab fa-whatsapp"></i> Whatsapp
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('foot-script')
<script>
   
</script>
@endpush