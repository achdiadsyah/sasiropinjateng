<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Peserta;
use App\Models\AppConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Mail;
use App\Mail\NotifyPesertaVerified;

class AdminController extends Controller
{
    public function loginPage(Request $request)
    {
        return view('admin.login');
    }

    public function doLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'username' => 'Wrong email or password',
            'password' => 'Wrong email or password',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function dashboard(Request $request)
    {
        $data = [
            'count_new'                 => Peserta::where('is_verified', 0)->count(),
            'count_verified'            => Peserta::where('is_verified', 1)->count(),

            'count_new_online'          => Peserta::where(['is_verified' => 0, 'jenis_seminar' => 'online'])->count(),
            'count_new_offline'         => Peserta::where(['is_verified' => 0, 'jenis_seminar' => 'offline'])->count(),

            'count_verified_online'     => Peserta::where(['is_verified' => 1, 'jenis_seminar' => 'online'])->count(),
            'count_verified_offline'    => Peserta::where(['is_verified' => 1, 'jenis_seminar' => 'offline'])->count(),
        ];
        return view('admin.dashboard', $data);
    }

    public function newUser(Request $request)
    {
        if($request->id){

            $data = [
                'user' => Peserta::findOrFail($request->id),
            ];
            return view('admin.new-user-detail', $data);

        } else {

            $data = [
                'users'   => Peserta::where('is_verified', 0)->get()
            ];
            return view('admin.new-user', $data);
        }
    }

    public function updateUser(Request $request)
    {
        if($request->id){
            $update = Peserta::where('id', $request->id)->update([
                'nama'          => $request->nama,
                'email'         => $request->email,
                'no_handphone'  => $request->no_handphone,
                'nomor_str'     => $request->nomor_str,
                'province_id'   => $request->province_id,
                'regencie_id'   => $request->regencie_id,
            ]);

            return redirect()->back()->with([
                'status'    => 'success',
                'message' => 'Berhasil merubah data peserta',
            ]);
        }

        return redirect()->back()->with([
            'status'    => 'warning',
            'message' => 'Gagal merubah data peserta',
        ]);
    }

    public function doVerify(Request $request)
    {
        $check = Peserta::findOrFail($request->id);

        if($check){

            $mailData = [
                'nama'  => $check->nama,
                'message' => 'Terima kasih telah mendaftar, pembayaran anda berhasil kami konfirmasi',
            ];
    
            Mail::to($check->email)->send(new NotifyPesertaVerified($mailData));

            Peserta::where('id', $request->id)->update([
                'is_verified'   => '1'
            ]);
            return redirect()->route('admin.new-user')->with([
                'status'    => 'success',
                'message' => 'Berhasil Memverifikasi users',
            ]);
        } else {
            return redirect()->route('admin.new-user')->with([
                'status'    => 'warning',
                'message' => 'Gagal Memverifikasi users',
            ]);
        }
    }

    public function doDeleteUser(Request $request)
    {
        $check = Peserta::findOrFail($request->id);

        if($check){
            Peserta::where('id', $request->id)->delete();
            return redirect()->route('admin.new-user')->with([
                'status'    => 'success',
                'message' => 'Berhasil Menghapus users',
            ]);
        } else {
            return redirect()->route('admin.new-user')->with([
                'status'    => 'warning',
                'message' => 'Gagal Menghapus users',
            ]);
        }
    }

    public function doDeleteVerify(Request $request)
    {
        $check = Peserta::findOrFail($request->id);

        if($check){
            Peserta::where('id', $request->id)->delete();
            return redirect()->route('admin.verified-user')->with([
                'status'    => 'success',
                'message' => 'Berhasil Menghapus users',
            ]);
        } else {
            return redirect()->route('admin.verified-user')->with([
                'status'    => 'warning',
                'message' => 'Gagal Menghapus users',
            ]);
        }
    }

    public function verifiedUser(Request $request)
    {

        if($request->id){

            $data = [
                'user' => Peserta::findOrFail($request->id)
            ];
            return view('admin.verify-user-detail', $data);

        } else {

            $data = [
                'users'   => Peserta::where('is_verified', 1)->get()
            ];
            return view('admin.verify-user', $data);
        }
        
    }

    public function downloadAll(Request $request)
    {
        $data = [
            'users' => Peserta::all()
        ];
        return view('admin.excel-export', $data);
    }

    public function appConfig(Request $request)
    {
        return view('admin.app-config');
    }

    public function appConfigUpdate(Request $request)
    {
        $imageName = '';
        if($request->hasFile('gambar')){
            $request->validate([
                'gambar' => 'image|mimes:jpeg,png,jpg|max:2048',
            ]);
            $imageName = time().'.'.$request->gambar->extension();  
            $request->gambar->move(public_path('images'), $imageName);
        }

        
        $update = AppConfig::where('id', '1')->update([
            'nama_bank'         => $request->nama_bank,
            'rekening'          => $request->rekening,
            'atas_nama'         => $request->atas_nama,
            'biaya_online'      => $request->biaya_online,
            'biaya_offline'     => $request->biaya_offline,
            'contact_person'    => $request->contact_person,
            'gambar'            => $imageName ? $imageName : $request->gambar_lama,
            'keterangan'        => $request->keterangan ? $request->keterangan : NULL
        ]);

        if ($update) {
            return redirect()->back()->with([
                'status'    => 'success',
                'message' => 'Berhasil update data',
            ]);
        } else {
            return redirect()->back()->with([
                'status'    => 'warning',
                'message' => 'Gagal update data',
            ]);
        }
    }
}
