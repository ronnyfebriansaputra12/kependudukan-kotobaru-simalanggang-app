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
        return view('Penduduk.capture', compact('capture'));
    }

    function captureData()
    {
        $captures = Capture::latest()->paginate(12);
        return view('Penduduk.captureData', compact('captures'));
    }


    public function store(Request $request)
    {
        $image = $request->file('image');
        $nikPenduduk = $request->nik_penduduk;
        $penduduk = Penduduk::where('nik',$nikPenduduk)->first();

        // Set the desired file name using the penduduk and nik
        $fileName = $nikPenduduk . '_' . $penduduk->nama;

        // Upload the image to Cloudinary with the specified file name
        $result = CloudinaryStorage::upload($image->getRealPath(), $fileName);

        Capture::create([
            'file_gambar' => $result,
            'nik_penduduk' => $nikPenduduk
        ]);

        return redirect()->route('capture')->withSuccess('berhasil upload');
    }


    public function deleteCapture($nik)
    {
        $capture = Capture::where('nik_penduduk', $nik)->first();

        if ($capture) {


            $capture->delete();

            return redirect('/capture/' . $nik)->with('success', 'Capture deleted successfully');
        }

        return redirect('/capture/' . $nik)->with('error', 'Capture not found');
    }



    // function deleteCapture($nik)
    // {
    //     $capture = Capture::where('nik_penduduk', $nik)->first(); // Use first() instead of get()

    //     if ($capture) {
    //         $imagePath = public_path('images/' . basename($capture->file_gambar));

    //         if (file_exists($imagePath)) {
    //             unlink($imagePath);
    //         }
    //         $capture->delete();
    //         return redirect('/capture/' . $nik); // Remove the extra space after '/capture/'
    //     }
    // }
}
