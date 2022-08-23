<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\Regencie;
use App\Models\Peserta;

use Mail;
use App\Mail\NotifyPesertaBerhasil;

class HomeController extends Controller
{
    public function province(Request $request)
    {
        return Province::all();
    }

    public function regency(Request $request)
    {
        return Regencie::where('province_id', $request->province_id)->get();
    }

    public function saveData(Request $request)
    {
        $check = Peserta::where('email', $request->email)->first();

        if($check) {
            return redirect()->back()->with([
                'status'    => 'warning',
                'message' => 'Gagal Mendaftar, email sudah pernah di daftarkan',
            ]);
        }

        $kode_unik = rand(100,999);

        $action = Peserta::create([
            'nama'  => $request->nama,  
            'email'  => $request->email,  
            'nomor_str'  => $request->nomor_str,  
            'no_handphone'  => $request->no_handphone,  
            'province_id'  => $request->province_id,  
            'regencie_id'  => $request->regencie_id,  
            'jenis_seminar'  => $request->jenis_seminar,  
            'hari_seminar'  => $request->hari_seminar,
            'kode_unik'  => $kode_unik,
            'is_verified'   => 0
        ]);

        $mailData = [
            'nama'  => $request->nama,
            'message' => 'Pendaftaran anda berhasil, silahkan lanjutkan pembayaran dengan cara sebagai berikut:',
            'kode_unik' => $kode_unik,
        ];

        $mailAction = Mail::to($request->email)->send(new NotifyPesertaBerhasil($mailData));

        if ($action && $mailAction) {
            return redirect()->back()->with([
                'status'    => 'success',
                'message' => 'Berhasil Mendaftar, periksa email anda untuk melihat tata cara pembayaran',
                'kode_unik' => $kode_unik,
            ]);
        } else {
            return redirect()->back()->with([
                'status'    => 'warning',
                'message' => 'Gagal Mendaftar',
            ]);
        }

    }
    
}
