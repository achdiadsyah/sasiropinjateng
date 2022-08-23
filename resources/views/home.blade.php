@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-7">
        <div class="card">
            <form action="{{route('register-peserta')}}" method="post" onsubmit="myBtn.disabled = true; myBtn.innerText ='Submitting Data...'; return true;">
                @csrf
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar sebagai peserta seminar</h6>
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
                            <button class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#modalPembayaran">Lihat Cara Pembayaran</button>
                        </div>
                        @endif
                    @else
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Nomor STR</label>
                        <input type="text" name="nomor_str" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Nomor Handphone</label>
                        <input type="number" name="no_handphone" class="form-control" placeholder="0812xxxxxxx" required>
                    </div>

                    <div class="form-group">
                        <label>Pilih Pengurus</label>
                        <select class="form-control" name="pengurus" required>
                            <option value="">--Silahkan Pilih--</option>
                            <option value="pengda">PENGDA</option>
                            <option value="pengcap">PENGCAP</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Pilih Jenis Seminar</label>
                        <select class="form-control" name="lama_seminar" id="lama_seminar" required>
                            <option value="">--Silahkan Pilih--</option>
                            <option value="1">1 Hari</option>
                            <option value="2">2 Hari</option>
                        </select>
                    </div>

                    <div class="form-group d-none" id="group_hari_seminar">
                        <label>Pilih hari Seminar</label>
                        <select class="form-control" name="hari_seminar" id="hari_seminar">
                            <option value="">--Silahkan Pilih--</option>
                            <option value="17">Sabtu, 17 September 2022</option>
                            <option value="18">Minggu, 18 September 2022</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Asal Pengda</label>
                        <select class="form-control" name="province_id" id="provinsi" required>

                        </select>
                    </div>

                    <div class="form-group d-none" id="group_kabupaten">
                        <label>Asal Pengcab</label>
                        <select class="form-control" name="regencie_id" id="kabupaten" required>

                        </select>
                    </div>
                    @endif
                </div>
                <div class="card-footer">
                    <a href="{{url('/')}}" class="btn btn-danger">Reset</a>
                    <button type="submit" class="btn btn-primary" name="myBtn">Submit Data</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Informasi</h6>
            </div>
            <div class="card-body">
                <img src="{{asset('assets/img/Flyer.png')}}" alt="" width="100%">
            </div>
            <div class="card-body">
                <ol>
                    <li>Biaya Pendaftaran sebesar Rp. 250.000</li>
                    <li>Biaya pendaftaran di transfer ke rekening BCA
                        <ul>
                            <li>Bank BCA Atas Nama : ________________</li>
                            <li>Nomor Rekening : ________________</li>
                            <li>Nominal : Rp.250.xxx [3 Digit Kode Unik]</li>
                            <li>Berita Transfer : IROPIN-[3 Digit Kode Unik]</li>
                        </ul>
                    </li>
                    <li>Anda akan menerima email balasan dari kami jika pembayaran anda berhasil kami konfirmasi</li>
                    <li>Jika tidak menerima email balasan dari kami 1 x 24 Jam, silahkan hubungi contact person kami di :
                        <ul>
                            <li>Contact Person 1</li>
                            <li>0812xxxxxx</li>
                        </ul>
                    </li>
                </ol>
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
                            <li>Bank BCA</li>
                            <li>A/N : _______________</li>
                            <li>No Rek : _________________</li>
                            <li>Total : Rp. 250.{{session('kode_unik')}}</li>
                            <li>Berita Transfer : IROPIN-{{session('kode_unik')}}</li>
                        </ul>
                    </li>
                    <li>Kami akan melakukan konfirmasi pembayaran anda secara manual</li>
                    <li>Anda akan menerima email pemberitahuan dari kami, jika kami berhasil mengkonfirmasi pembayaran anda</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@push('foot-script')
<script>
    $(document).ready(function (){
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
                    $.each( res, function( key, value ) {
                        kab_opt += `<option value="${value.id}">${value.name}</option>`;
                    });
                    $('#kabupaten').html(kab_opt);
                }
            }
        })
    });

    $( "#lama_seminar" ).change(function() {
        var lama = $(this).val();
        if(lama == '1'){
            $('#group_hari_seminar').removeClass('d-none');
        } else {
            $('#group_hari_seminar').addClass('d-none');
            $('#hari_seminar').val('');
        }
    });

</script>
@endpush