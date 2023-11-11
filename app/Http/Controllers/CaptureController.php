<?php

namespace App\Http\Controllers;

use App\Models\Capture;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class CaptureController extends Controller
{
    function index($nik)
    {
        $capture = Penduduk::where('nik', $nik)->get();
        // dd($capture);
        return view('Penduduk.capture', compact('capture'));
    }

    function captureData()
    {
        $captures = Capture::latest()->paginate(12);
        return view('Penduduk.captureData', compact('captures'));
    }

    public function store(Request $request)
    {
        $imageData = $request->input('file_gambar');
        $nikPenduduk = $request->input('nik_penduduk');

        // Get the name of the resident from the database (assuming you have a model for residents)
        $penduduk = Penduduk::where('nik', $nikPenduduk)->first();

        if (!$penduduk) {
            return response()->json(['error' => 'Penduduk not found'], 404);
        }

        // Save the image to the public/images folder with the resident's name
        $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));
        $imageName = "images/{$penduduk->nama}-{$nikPenduduk}.png"; // Include resident's name in the file name

        // Use the Storage facade to store the image
        Storage::disk('public')->put($imageName, $image);

        // You can also save the image path in the database if needed
        $gambar = new Capture();
        $gambar->nik_penduduk = $nikPenduduk;
        $gambar->file_gambar = $imageName; // Save the image path in the database
        $gambar->save();

        return response()->json(['message' => 'Gambar berhasil disimpan']);
    }
}
