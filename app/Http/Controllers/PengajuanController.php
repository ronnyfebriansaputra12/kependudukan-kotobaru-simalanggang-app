<?php

namespace App\Http\Controllers;

use App\Models\JenisSurat;
use App\Models\Penduduk;
use App\Models\Pengajuan;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengajuans = Pengajuan::all();
        return view('pengajuan.index', [
            'pengajuan' => $pengajuans
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($nik)
    {
        $penduduk = session('penduduk'); // menggunakan data dari session jika ada

        if (!$penduduk) {
            $penduduk = Penduduk::find($nik); // ambil data dari database jika tidak ada di session
            session(['penduduk' => $penduduk]); // simpan data ke session
        }

        $jenisSurats = JenisSurat::all();

        return view('pengajuan.create', [
            'jenisSurats' => $jenisSurats,
            'penduduk' => $penduduk,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik_penduduk' => 'required',
            'id_jenis_surat' => 'required',
            'nama_orangtua' => 'required',
            'jekel_orangtua' => 'required',
            'umur_orangtua' => 'required',
            'pekerjaan_orangtua' => 'required',
            'keterangan' => 'required',
        ]);

        Pengajuan::create([
            'nik_penduduk' => $request->nik_penduduk,
            'id_jenis_surat' => $request->id_jenis_surat,
            'nama_orangtua' => $request->nama_orangtua,
            'jekel_orangtua' => $request->jekel_orangtua,
            'umur_orangtua' => $request->umur_orangtua,
            'pekerjaan_orangtua' => $request->pekerjaan_orangtua,
            'keterangan' => $request->keterangan,
        ]);

        return redirect('/pengajuan')->with('success', 'Pengajuan Berhasil Di Ajukan, Silahkan Cek Status Pengajuan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengajuan $pengajuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengajuan $pengajuan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengajuan $pengajuan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengajuan $pengajuan)
    {
        //
    }
}
