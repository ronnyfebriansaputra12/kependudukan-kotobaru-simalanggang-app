<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function profilePenduduk($nik)
    {
        // session()->forget('penduduk');

        
        $profile = Penduduk::find($nik)->first();
        // dd($profile);
        return view('auth.login.profile.index', compact('profile'));
    }

    function changePassword(Request $request)
    {
        $profile = session('penduduk');
        $nik = $profile->nik;

        $validate = $request->validate([
            'password' => 'required|string|min:4|confirmed',
            'password_confirmation' => 'required|string|min:4|same:password',
        ]);

        $pass_lama = $profile->password;
        // dd($request->password_lama,$pass_lama);

        if (Hash::check($request->password_lama, $pass_lama)) {
            $validate['password'] = Hash::make($request->password);
            $validate['password_confirmation'] = Hash::make($request->password_confirmation);
            $profile->where('nik', $nik)->update($validate);
            Alert::toast('Update Data Berhasil', 'success');
            return redirect('/profilePenduduk');
        } else {
            Alert::toast('Password Lama Tidak Sesuai', 'error');
            return redirect('/profilePenduduk');
        }
    }


    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // dd($request->all());
        $penduduk =  session('penduduk');
        $nik = $penduduk->nik;
        $validate = $request->validate([
            'nama' => 'required',
            'no_kk' => 'required|nullable|min:16|numeric',
            'tmp_lahir' => 'required|nullable',
            'tgl_lahir' => 'required|nullable|date|before:today',
            'jekel' => 'required|nullable|',
            'ibu_kandung' => 'required|nullable',
            'hub_kel' => 'required|nullable',
            'agama' => 'required|nullable',
            'status_perkawinan' => 'required|nullable',
            'alamat' => 'required|nullable|max:255',
            'pekerjaan' => 'required|nullable|max:255',
            'desa_kelurahan' => 'required|nullable|max:255',
            'dusun' => 'required|nullable|max:255',
        ]);
        // dd($validate);
        try {
            $penduduk->where('nik', $nik)->update($validate);
            // Perbarui sesi dengan data terbaru
            // session()->forget('penduduk');
            session('penduduk');
            Alert::success('Berhasil', 'Data berhasil diubah');
            return redirect('/profilePenduduk/' .$nik);
        } catch (\Throwable $e) {
            Alert::error('Gagal', 'Data gagal diubah');
            return redirect()->back();
        }
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
