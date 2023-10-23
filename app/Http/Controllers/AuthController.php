<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    function loginAdmin()
    {
        return view('auth.login.Administrator.index');
    }

    function loginPenduduk(Request $request, $nik)
    {
        $penduduk = Penduduk::where('nik',$nik)->first();
        return view('auth.login.Penduduk.index', ['penduduk' => $penduduk]);
        
    }

    function loginProsesAdmin(Request $request)
    {
        $validasiAdmin = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $admins = User::where('email', $validasiAdmin['email'])->first();
        if (Auth::guard('web')->attempt($validasiAdmin)) {
            $request->session()->regenerate();
            // Simpan data ke dalam session
            $request->session()->put('admin', $admins);

            Alert::toast('Login Berhasil', 'success');
            return redirect('/dashboard');
        } else {
            Alert::toast('Login Gagal', 'error');
            return back()->withErrors([
                'email' => 'Email salah Atau Belum Terdaftar Silahkan Periksa Kembali',
                'password' => 'Password Salah Silahkan Periksa Kembali'
            ]);
        }
    }

    function loginProsesPenduduk(Request $request)
    {
        $validasiPenduduk = $request->validate([
            'nik' => 'required',
            'password' => 'required'
        ]);

        $penduduks = Penduduk::where('nik', $validasiPenduduk['nik'])->first();
        if (Auth::guard('penduduk')->attempt($validasiPenduduk)) {
            $request->session()->regenerate();
            Alert::toast('Login Berhasil', 'success');

            // Simpan data yang ingin dikirim ke view dalam array assosiatif
            // Simpan data ke dalam session
            $request->session()->put('penduduk', $penduduks);


            return redirect('/dashboard');
        } else {
            Alert::toast('Login Gagal', 'error');
            return back()->withErrors([
                'nik' => 'NIK salah Atau Belum Terdaftar Silahkan Periksa Kembali',
                'password' => 'Password Salah Silahkan Periksa Kembali'
            ]);
        }
    }

    function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }


}
