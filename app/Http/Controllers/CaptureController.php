<?php

namespace App\Http\Controllers;

use App\Models\Capture;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CaptureController extends Controller
{
    function index($nik)
    {
        return view('Penduduk.capture');
    }

    function captureData()
    {
        $capture = Capture::all();
        return view('Penduduk.captureData', compact('capture'));
    }

    public function store(Request $request)
    {
        $imageData = $request->input('file_gambar');
        $nikPenduduk = $request->input('nik_penduduk');

        // Simpan gambar ke database
        $gambar = new Capture();
        $gambar->nik_penduduk = $nikPenduduk;
        $gambar->file_gambar = $imageData;
        $gambar->save();

        return response()->json(['message' => 'Gambar berhasil disimpan']);
    }
}
