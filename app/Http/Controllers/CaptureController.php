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

    public function checkNikExists(Request $request)
    {
        $nik = $request->input('nik_penduduk');

        // Memeriksa apakah NIK sudah ada dalam tabel capture
        $existingCapture = Capture::where('nik_penduduk', $nik)->first();

        // Mengembalikan respons dalam format JSON
        return response()->json(['exists' => !is_null($existingCapture)]);
    }


    public function store(Request $request)
    {
        $image = $request->file('image');
        $nikPenduduk = $request->nik_penduduk;

        // Check if the nik_penduduk already exists in the Capture table
        $capture = Capture::where('nik_penduduk', $nikPenduduk)->first();

        // If nik_penduduk doesn't exist, proceed with the upload and insert
        if (!$capture) {
            // Retrieve the Penduduk data
            $penduduk = Penduduk::where('nik', $nikPenduduk)->first();

            // Set the desired file name using the penduduk and nik
            $fileName = $nikPenduduk . '_' . $penduduk->nama;

            // Upload the image to Cloudinary with the specified file name
            $result = CloudinaryStorage::upload($image->getRealPath(), $fileName);

            // Insert data into the Capture table
            Capture::create([
                'file_gambar' => $result,
                'nik_penduduk' => $nikPenduduk
            ]);
        } else {
            return redirect('capture/' . $nikPenduduk);
        }

        return "success";
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
