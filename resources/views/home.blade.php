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
            <form action="{{route('register-peserta')}}" id="formRegister" method="post">
                @csrf
                <div class="card-header">
                    <h5 class="m-0 font-weight-bold text-primary">Daftar sebagai peserta seminar</h5>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-{{ session('status') }}" role="alert">
                            {{ session('message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @if(session('status') !== "warning")
                        <div class="text-center">
                            <button class="btn btn-primary btn-lg" type="button" data-toggle="modal" data-target="#modalPembayaran">Lihat Cara Pembayaran</button>
                        </div>
                        @endif
                    @else
                    <div class="form-group">
                        <label>Nama Lengkap (sesuai sertifikat)</label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required>
                        @error('nama')
                            <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    
                    <div class="form-group">
                        <label>Nomor STR</label>
                        <div class="input-group">
                            <input type="number" class="form-control @error('nomor_str9') is-invalid @enderror" placeholder="9 Digit" name="nomor_str9" maxlength = "9" value="{{ old('nomor_str9') }}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
                            <div class="input-group-prepend">
                                <span class="input-group-text">-</span>
                            </div>
                            <input type="number" class="form-control @error('nomor_str7') is-invalid @enderror" placeholder="7 Digit" name="nomor_str7" maxlength = "7" value="{{ old('nomor_str7') }}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
                        </div>
                        @error('nomor_str9')
                            <div class="text text-danger">{{ $message }}</div>
                        @enderror
                        @error('nomor_str7')
                            <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Nomor Handphone</label>
                        <input type="number" name="no_handphone" class="form-control @error('no_handphone') is-invalid @enderror" minlength="10" maxlength="13" value="{{ old('no_handphone') }}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="0812xxxxxxx" required>
                        @error('no_handphone')
                            <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>ASAL PENGDA</label>
                        <select class="form-control @error('province_id') is-invalid @enderror" name="province_id" id="provinsi" required>

                        </select>
                        @error('province_id')
                            <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group d-none" id="group_kabupaten">
                        <label>ASAL PENGCAB (Opsional)</label>
                        <select class="form-control" name="regencie_id" id="kabupaten">

                        </select>
                    </div>

                    <div class="form-group">
                        <label>Pilih Jenis Seminar</label>
                        <select class="form-control @error('jenis_seminar') is-invalid @enderror" name="jenis_seminar" id="jenis_seminar" required>
                            <option value="">--Silahkan Pilih--</option>
                            <option value="online">ONLINE (Zoom Meeting)</option>
                            <option value="offline">OFFLINE (Hotel Grasia Semarang | 24-25 September 2022)</option>
                        </select>
                        @error('jenis_seminar')
                            <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group @if($errors->has('hari_seminar')) is-invalid @else d-none @endif" id="group_hari_seminar">
                        <label>Pilih Hari Seminar</label>
                        <select class="form-control" name="hari_seminar" id="hari_seminar" required>
                            
                        </select>
                        @error('hari_seminar')
                            <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    @endif
                </div>
                @if (!session('status'))
                <div class="card-footer">
                    <button type="button" class="btn btn-primary btn-lg" id="myBtn">Kirim Pendaftaran</button>
                </div>
                @endif
            </form>
        </div>
    </div>

    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <h5 class="m-0 font-weight-bold text-primary">Informasi</h5>
            </div>
            <div class="card-body">
                <img src="{{asset('images/'.$config->gambar)}}" alt="" width="100%">
            </div>
            <div class="card-body">
                <label>Keterangan : (Penting! harap baca)</label>
                <ol>
                    <li>Biaya Pendaftaran sebesar Rp. {{number_format($config->biaya_online)}} / Hari Seminar [ONLINE]</li>
                    <li>Biaya Pendaftaran sebesar Rp. {{number_format($config->biaya_offline)}} / Hari Seminar [OFFLINE]</li>
                    <li>Seteleh melakukan pendaftaran harap cek email anda untuk mengetahui cara pembayaran, nominal, dan nomor rekening pembayaran.</li>
                    <li>Setiap peserta hanya dapat mengikuti satu jenis kegiatan seminar <b>(Online atau Offline)</b></li>
                    <li>Sertifikat hanya diberikan kepada peserta yang mengikuti kegiatan dari awal sampai akhir.</li>
                    <li>Anda akan menerima konfirmasi pembayaran via email setelah pembayaran berhasil.</li>
                    <li>Jika tidak menerima email balasan dari kami 1 x 24 Jam, silahkan hubungi contact person kami
                    </li>
                </ol>
                <div class="text-center">
                    <a href="https://api.whatsapp.com/send/?phone={{$config->contact_person}}&text&type=phone_number&app_absent=0"  target="_blank" class="btn btn-lg btn-success">
                        <i class="fab fa-whatsapp"></i> Whatsapp
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalPembayaran" aria-hidden="true">
    <div class="modal-dialog" style="margin-top: 140px !important;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                Tata cara pembayaran
            </div>
            <div class="modal-body">
                <ol>
                    <li>Segera lakukan transfer ke Rekening
                        <ul>
                            <li><b>Bank {{$config->nama_bank}}</b></li>
                            <li>A/N : <b>{{$config->atas_nama}}</b></li>
                            <li>No Rek : <b>{{$config->rekening}}</b></li>
                            <li>Total : <b>{{session('biaya')}}</b></li>
                            <li>Berita Transfer : <b>IROPIN-{{session('kode_unik')}}</b></li>
                            <li>Harap Transfer sesuai nominal yang telah di sebutkan dan jangan di bulatkan</li>
                        </ul>
                    </li>
                    <li>Kami akan melakukan konfirmasi pembayaran anda secara manual</li>
                    <li>Anda akan menerima email pemberitahuan dari kami, jika kami berhasil mengkonfirmasi pembayaran anda</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Yakin data yang anda masukkan sudah benar?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Tekan "Kirim" dibawah ini jika data yang anda masukkan sudah benar.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal" name="btnCancelUpdate">Batal</button>
                <button class="btn btn-danger" type="button" onClick="$('#formRegister').submit(); this.disabled = true;  btnCancelUpdate.disabled = true; this.innerText ='Trying to save...';">Kirim</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('foot-script')
<script>
    $(document).ready(function (){
        $('#myBtn').on('click', function(){
            $('#modalUpdate').modal('show');            
        });

        var prov_opt = "";
        $.ajax({                                      
            url: '/getprovince',              
            type: "get",
            success: function(res) {
                if (res) {
                    prov_opt += `<option value="">--Silahkan Pilih--</option>`;
                    $.each( res, function( key, value ) {
                        prov_opt += `<option value="${value.id}">${value.name}</option>`;
                    });
                    $('#provinsi').html(prov_opt);
                }
            }
        });
    });

    $( "#provinsi" ).change(function() {
        var prov_id = $(this).val();
        var kab_opt = "";
        $.ajax({                                      
            url: '/getregency',
            data: 'province_id='+prov_id,
            type: "get",
            success: function(res) {
                if (res) {
                    $('#group_kabupaten').removeClass('d-none');
                    kab_opt += `<option value="">--Silahkan Pilih--</option>`;
                    kab_opt += `<option value="">--TANPA PENGCAB--</option>`;
                    $.each( res, function( key, value ) {
                        kab_opt += `<option value="${value.id}">${value.name}</option>`;
                    });
                    $('#kabupaten').html(kab_opt);
                }
            }
        })
    });

    $( "#jenis_seminar" ).change(function() {
        var jenis = $(this).val();
        var options = "";
        if(jenis == 'online'){
            options = ` <option value="">--Silahkan Pilih--</option>
                        <option value="2 Hari">2 Hari</option>
                        <option value="1 Hari (Sabtu)">1 Hari (Sabtu)</option>
                        <option value="1 Hari (Minggu)">1 Hari (Minggu)</option>
                        `;
            
        } else {
            options = ` <option value="">--Silahkan Pilih--</option>
                        <option value="2 Hari">2 Hari</option>
                        <option value="1 Hari (Sabtu)">1 Hari (Sabtu)</option>
                        <option value="1 Hari (Minggu)">1 Hari (Minggu)</option>
                        `;
        }
        $('#group_hari_seminar').removeClass('d-none');
        $('#hari_seminar').html(options);
    });

</script>
@endpush