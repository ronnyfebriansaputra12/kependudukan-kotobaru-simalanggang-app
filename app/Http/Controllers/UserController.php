<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function profilePenduduk($nik)
    {
        // session()->forget('penduduk');
        $profile = Penduduk::where('nik', $nik)->first();
        // dd($profile);
        return view('auth.login.profile.index', compact('profile'));
    }

    public function profileAdmin($id)
    {
        $profile = User::where('id', $id)->first();

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
            return redirect('/profilePenduduk/' . $nik);
        } else {
            Alert::toast('Password Lama Tidak Sesuai', 'error');
            return redirect()->back();
        }
    }

    public function index()
    {
        $penggunas = User::where('role','<>','superadmin')->paginate(10);
        return view('pengguna.index', compact('penggunas'));
    }

    public function create()
    
    {
        return view('pengguna.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:2|confirmed|',
            'password_confirmation' => 'required|min:2|same:password',
            'role' => 'required'
        ], [
            'name.required' => 'Kolom nama wajib diisi',
            'email.required' => 'Kolom email wajib diisi',
            'email.unique' => 'Email sudah digunakan',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Password tidak sama',
            'password_confirmation.required' => 'Konfirmasi password tidak boleh kosong',
            'password_confirmation.min' => 'Konfirmasi password minimal 6 karakter',
            'password_confirmation.same' => 'Konfirmasi password tidak sama',
        ]);
        $validate['password'] = Hash::make($request->password);
        $validate['password_confirmation'] = Hash::make($request->password_confirmation);

        // dd($validate);

        try {
            User::create($validate);
            Alert::success('Berhasil', 'Data berhasil ditambahkan');
            return redirect('/pengguna');
        } catch (\Throwable $e) {
            Alert::error('Gagal', 'Data gagal ditambahkan');
            return redirect('/pengguna');
        }
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
            return redirect('/profilePenduduk/' . $nik);
        } catch (\Throwable $e) {
            Alert::error('Gagal', 'Data gagal diubah');
            return redirect()->back();
        }
    }

    public function updateAdmin(Request $request)
    {

        $admin =  session('admin');
        $id = $admin->id;
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|nullable',
            'jekel' => 'required|nullable',
            'agama' => 'required|nullable',
            'temp_lahir' => 'required|nullable|',
            'tgl_lahir' => 'required|nullable|date|before:today',
            'alamat' => 'required|nullable',
            'no_hp' => 'required|numeric',
            'role' => 'required|',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048'

        ]);

        // dd($request);
        try {
            // Handle upload foto
            if ($request->hasFile('avatar')) {
                $avatarPath = $request->file('avatar')->store('avatars', 'public');
                $validate['avatar'] = $avatarPath;

                // Hapus file lama jika ada
                if ($admin->avatar) {
                    Storage::disk('public')->delete($admin->avatar);
                }
            }

            // Update data admin
            $admin->update($validate);

            Alert::success('Berhasil', 'Data berhasil diubah');
            return redirect('/profileAdmin/' . $id);
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
