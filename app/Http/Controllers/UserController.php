<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function profilePenduduk()
    {
        // Get the Penduduk profile from the session
        $profile = session('penduduk');

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

        if(Hash::check($request->password_lama, $pass_lama)){
            $validate['password'] = Hash::make($request->password);
            $validate['password_confirmation'] = Hash::make($request->password_confirmation);
            $profile->where('nik', $nik)->update($validate);
            Alert::toast('Update Data Berhasil', 'success');
            return redirect('/profilePenduduk');
        }else{
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
