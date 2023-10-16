<?php

namespace App\Http\Controllers;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class PendudukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penduduks = Penduduk::all();
        return view('penduduk.index', compact('penduduks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('penduduk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([

            'nik' => 'required|unique:penduduks|min:16|numeric',
            'nik' => 'required|unique:penduduks|min:16|numeric',
            'nama' => 'required',
            'no_kk' => 'required|nullable|unique:penduduks|min:16|numeric',
            'password' => 'required|min:2|confirmed|',
            'password_confirmation' => 'required|min:2|same:password',
            'tmp_lahir' => 'required|nullable',
            'tgl_lahir' => 'required|nullable|date|before:today',
            'jekel' => 'required|nullable|in:Laki-laki,Perempuan',
            'ibu_kandung' => 'required|nullable',
            'hub_kel' => 'required|nullable',
            'alamat' => 'required|nullable|max:255',
            'pekerjaan' => 'required|nullable|max:255',
            'desa' => 'required|nullable|max:255',
            'kelurahan' => 'required|nullable|max:255',
            'dusun' => 'required|nullable|max:255',

        ],
        [
            'nik.required' => 'NIK tidak boleh kosong',
            'nik.unique' => 'NIK sudah terdaftar',
            'nik.max' => 'NIK maksimal 16 karakter',
            'nik.min' => 'NIK minimal 16 karakter',
            'nik.numeric' => 'NIK harus berupa angka',
            'nama.required' => 'Nama tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Password tidak sama',
            'password_confirmation.required' => 'Konfirmasi password tidak boleh kosong',
            'password_confirmation.min' => 'Konfirmasi password minimal 6 karakter',
            'password_confirmation.same' => 'Konfirmasi password tidak sama',
            'no_kk.required' => 'No KK tidak boleh kosong',
            'no_kk.unique' => 'No KK sudah terdaftar',
            'no_kk.max' => 'No KK maksimal 16 karakter',
            'no_kk.min' => 'No KK minimal 16 karakter',
            'no_kk.numeric' => 'No KK harus berupa angka',
            'tmp_lahir.required' => 'Tempat lahir tidak boleh kosong',
            'tgl_lahir.required' => 'Tanggal lahir tidak boleh kosong',
            'tgl_lahir.date' => 'Tanggal lahir harus berupa tanggal',
            'tgl_lahir.before' => 'Tanggal lahir tidak boleh lebih dari hari ini',
            'jekel.required' => 'Jenis kelamin tidak boleh kosong',
            'jekel.in' => 'Jenis kelamin harus Laki-laki atau Perempuan',
            'ibu_kandung.required' => 'Ibu kandung tidak boleh kosong',
            'hub_kel.required' => 'Hubungan keluarga tidak boleh kosong',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'alamat.max' => 'Alamat maksimal 255 karakter',
            'pekerjaan.required' => 'Pekerjaan tidak boleh kosong',
            'pekerjaan.max' => 'Pekerjaan maksimal 255 karakter',
            'desa.required' => 'Desa tidak boleh kosong',
            'desa.max' => 'Desa maksimal 255 karakter',
            'kelurahan.required' => 'Kelurahan tidak boleh kosong',
            'kelurahan.max' => 'Kelurahan maksimal 255 karakter',
            'dusun.required' => 'Dusun tidak boleh kosong',
            'dusun.max' => 'Dusun maksimal 255 karakter',
            'tgl_lahir.before' => 'Tanggal lahir tidak boleh lebih dari hari ini',
        ]);

        $validate['password'] = Hash::make($request->password);
        $validate['password_confirmation'] = Hash::make($request->password_confirmation);

        try {
            Penduduk::create($validate);
            Alert::success('Berhasil', 'Data berhasil ditambahkan');
            return redirect('/penduduk');
        } catch (\Throwable $e) {
            Alert::error('Gagal', 'Data gagal ditambahkan');
            return redirect('/penduduk');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Penduduk $penduduk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penduduk $penduduk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penduduk $penduduk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($nik)
    {
        try {
            $penduduk = Penduduk::findOrFail($nik);
            $penduduk->delete();
            return redirect('/penduduk');
        } catch (\Exception $e) {
            Alert::toast('Gagal mengubah data', 'error');
            return back()->withErrors(['error' => 'Gagal menghapus data.']);
        }
    }
}
