<?php

namespace App\Http\Controllers;

use App\Models\JenisSurat;
use App\Models\Penduduk;
use App\Models\Pengajuan;
use App\Models\User;
use Illuminate\Http\Request;

use App\Notifications\PengajuanSuratNotification;

use Illuminate\Support\Facades\Notification;
use RealRashid\SweetAlert\Facades\Alert;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil penduduk dari session

        if (session()->has('penduduk')) {
            $penduduk = session('penduduk');

            // Mendapatkan NIK penduduk dari session
            $nikPenduduk = $penduduk->nik;

            // Mengambil data pengajuan berdasarkan NIK penduduk
            $pengajuans = Pengajuan::where('nik_penduduk', $nikPenduduk)->get();
        } else {
            $pengajuans = Pengajuan::all();
            // dd($pengajuans);
        }


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
        // Buat pengajuan
        $pengajuan = Pengajuan::create($request->all());
        $user = User::all();
        Notification::send($user, new PengajuanSuratNotification($pengajuan));

        Alert::success('Berhasil','Pengajuan Berhasil di Ajukan, Silahkan Cek Status Pengajuan');      
        return redirect('/pengajuan');
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
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima dari formulir
        $request->validate([
            'status' => 'required|in:0,1', // Pastikan status hanya bernilai 0 atau 1
            'no_dokumen_perjalanan' => 'nullable|string|max:255',
            // Tambahkan validasi lainnya sesuai kebutuhan
        ]);

        // Temukan data pengajuan berdasarkan ID
        $pengajuan = Pengajuan::findOrFail($id);

        // Update data pengajuan berdasarkan data yang diterima
        
        $pengajuan->update([
            'status' => $request->status,
            'no_dokumen_perjalanan' => $request->no_dokumen_perjalanan,
            // Tambahkan kolom lain sesuai kebutuhan
        ]);

        // Redirect ke halaman pengajuan dengan pesan sukses
        return redirect('/pengajuan')->with('success', 'Pengajuan berhasil diperbarui');
    }

    // public function printSurat($type, $id)
    // {

    //     switch ($type) {
    //         case 'suratketerangantidakmampu':
    //             return $this->suratKeteranganTidakMampu($id);
    //             break;
    //         case 'suratkelahiran':
    //             return $this->suratKelahiran($id);
    //             break;
    //         default:
    //             // Handle default case or show an error
    //             return redirect()->back()->with('error', 'Jenis surat tidak valid');
    //             break;
    //     }
    // }

    // public function suratKeteranganTidakMampu($id)
    // {
    //     $pengajuan = Pengajuan::findOrFail($id);
    //     // $jenissurat = JenisSurat::findOrFail($pengajuan->id_jenis_surat);

    //     return view('surat.suratketerngantidakmampu', [
    //         'pengajuan' => $pengajuan,
    //         // 'jenissurat' => $jenissurat,
    //     ]);
    // }

    // public function cetakSurat($id)
    // {
    //     $pengajuan = Pengajuan::findOrFail($id);
    //     $surat = JenisSurat::where('id',$pengajuan->id_jenis_surat)->first();
    //     // dd($surat);
    //     if ($surat) {
    //         $kataKunci = $surat->name_surat;
    //         // dd($kataKunci);

    //         if ($kataKunci === "Surat Keterangan Tidak Mampu") {
    //             return $this->cetakSuratKeteranganTidakMampu($id);
    //         } elseif ($kataKunci === "Surat Keterangan Kematian") {
    //             return $this->cetakSuratKeteranganKematian($id);
    //         } elseif ($kataKunci === "Surat Keterangan Domisili") {
    //             return $this->cetakSuratDomisili($id);
    //         }
    //     }
    // }

    public function cetakSurat($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $surat = JenisSurat::where('id', $pengajuan->id_jenis_surat)->first();

        if ($surat) {
            $kataKunci = strtolower($surat->name_surat); // Ubah ke huruf kecil untuk perbandingan tanpa memperhatikan huruf besar atau kecil

            // Periksa kata kunci dan panggil fungsi yang sesuai
            if (strpos($kataKunci, "mampu") !== false) {
                return $this->cetakSuratKeteranganTidakMampu($id);
            } elseif (strpos($kataKunci, "domisili") !== false) {
                return $this->cetakSuratDomisili($id);
            } elseif (strpos($kataKunci, "kematian") !== false) {
                return $this->cetakSuratKeteranganKematian($id);
            }
        }
    }


    private function cetakSuratKeteranganTidakMampu($id)
    {
        // Logika untuk mengambil data dan menyiapkan view
        $pengajuan = Pengajuan::where('id', $id)->get();
        // dd($pengajuan);
        $data = [
            'judul' => 'Surat Keterangan Tidak Mampu',
            'pengajuan' => $pengajuan,
        ];
        return view('surat.suratketerangantidakmampu', $data);
    }

    private function cetakSuratKeteranganKematian($id)
    {
        // Logika untuk mengambil data dan menyiapkan view
        $pengajuan = Pengajuan::where('id', $id)->get();
        $data = [
            'judul' => 'Surat Keterangan Kematian',
            'pengajuan' => $pengajuan,
        ];
        return view('surat.suratkematian', $data);
    }

    private function cetakSuratDomisili($id)
    {
        // Logika untuk mengambil data dan menyiapkan view
        $pengajuan = Pengajuan::where('id', $id)->get();
        $data = [
            'judul' => 'Surat Keterangan Domisili',
            'pengajuan' => $pengajuan,
        ];
        return view('surat.suratketerangandomisili', $data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengajuan $pengajuan)
    {
        //
    }
}
