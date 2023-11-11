<?php

namespace App\Http\Controllers;

use App\Imports\PenduduksImport;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;

class PendudukController extends Controller
{
    public function index(Request $request)
    {
        $query = Penduduk::query();

        $search = $request->input('search');

        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('uid', 'LIKE', "%$search%")
                      ->orWhere('nama', 'LIKE', "%$search%")
                      ->orWhere('nik', 'LIKE', "%$search%")
                      ->orWhere('no_kk', 'LIKE', "%$search%")
                      ->orWhere('jekel', 'LIKE', "%$search%")
                      ->orWhere('alamat', 'LIKE', "%$search%");
                // Add more conditions for other fields if needed
            });
        }
        

        $penduduks = $query->orderBy('nama')->paginate(10); // Get the results after applying search conditions

        return view('penduduk.index', compact('penduduks'));
    }

    public function create()
    {
        return view('penduduk.create');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([

            'uid' => 'required|unique:penduduks|min:10|numeric',
            'nik' => 'required|unique:penduduks|min:16|numeric',
            'nama' => 'required',
            'no_kk' => 'required|nullable|min:16|numeric',
            'password' => 'required|min:2|confirmed|',
            'password_confirmation' => 'required|min:2|same:password',
            'tmp_lahir' => 'required|nullable',
            'tgl_lahir' => 'required|nullable|date|before:today',
            'jekel' => 'required|nullable|',
            'ibu_kandung' => 'required|nullable',
            'hub_kel' => 'required|nullable',
            'alamat' => 'required|nullable|max:255',
            'pekerjaan' => 'required|nullable|max:255',
            'desa_kelurahan' => 'required|nullable|max:255',
            'dusun' => 'required|nullable|max:255',

        ],
        [
            'uid.required' => 'uid tidak boleh kosong',
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

        // dd($request);

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

    public function show($nik)
    {
        $penduduk = Penduduk::findOrFail($nik);
        return view('penduduk.show', compact('penduduk'));
    }

    public function edit($nik)
    {
        $penduduk = Penduduk::findOrFail($nik);
        return view('penduduk.edit', compact('penduduk'));
    }

    public function updateUID(Request $request, $nik)
    {
        $penduduk = Penduduk::findOrFail($nik);
        $request->validate([
            'uid' => 'required|unique:penduduks'
        ], [
            'uid' => 'UID penduduk sudah ada'
        ]);
        // dd($penduduk);
        $penduduk->update([
            'uid' => $request->input('uid')
        ]);
        return redirect()->back();
    }

    public function update(Request $request, $nik)
    {
        $penduduk = Penduduk::findOrFail($nik);
        $validate = $request->validate([
            'uid' => 'required',
            'nik' => 'required|min:16|numeric|unique:penduduks,nik,' . $penduduk->nik . ',' . $penduduk->getKeyName(),
            'nama' => 'required',
            'no_kk' => 'required|nullable|min:16|numeric',
            'password' => 'required|min:2|confirmed|',
            'password_confirmation' => 'required|min:2|same:password',
            'tmp_lahir' => 'required|nullable',
            'tgl_lahir' => 'required|nullable|date|before:today',
            'jekel' => 'required|nullable|',
            'ibu_kandung' => 'required|nullable',
            'hub_kel' => 'required|nullable',
            'alamat' => 'required|nullable|max:255',
            'pekerjaan' => 'required|nullable|max:255',
            'desa_kelurahan' => 'required|nullable|max:255',
            'dusun' => 'required|nullable|max:255',

        ]);
        $validate['password'] = Hash::make($request->password);
        $validate['password_confirmation'] = Hash::make($request->password_confirmation);

        try {
            $penduduk->update($validate);
            Alert::success('Berhasil', 'Data berhasil diubah');
            return redirect('/penduduk');
        } catch (\Throwable $e) {
            Alert::error('Gagal', 'Data gagal diubah');
            return redirect('/penduduk');
        }
    }

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

    public function importExcel(Request $request)
    {
        // dd($request->file('file'));
        Excel::import(new PenduduksImport, $request->file('file'));
        return redirect('/penduduk');
    }
}
