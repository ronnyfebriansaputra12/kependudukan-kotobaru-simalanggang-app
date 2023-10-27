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
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima dari formulir
        $request->validate([
            'status' => 'required|in:0,1', // Pastikan status hanya bernilai 0 atau 1
            'no_dokumen_perjalanan' => 'required|string|max:255',
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

    public function cetakSurat($jenis_surat)
    {
        // Logika untuk menentukan view berdasarkan jenis surat
        switch ($jenis_surat) {
            case 1:
                // Jika jenis_surat adalah 1 (contoh: suratketerangantidakmampu)
                return $this->cetakSuratKeteranganTidakMampu();
                break;
                // Tambahkan case untuk jenis surat lainnya jika diperlukan
            default:
                abort(404); // Jika jenis surat tidak ditemukan
        }
    }

    private function cetakSuratKeteranganTidakMampu()
    {
        // Logika untuk mengambil data dan menyiapkan view
        $pengajuan = Pengajuan::all();
        $data = [
            'judul' => 'Surat Keterangan Tidak Mampu',
            'pengajuan' => $pengajuan,
        ];
        return view('surat.suratketerangantidakmampu', $data);
    }



    // public function suratketerangantidakmampu($pengajuan_id)
    // {
    //     $pengajuans = Pengajuan::join('penduduks', 'pengajuans.nik_penduduk', '=', 'penduduks.nik')
    //         ->join('jenis_surats', 'pengajuans.id_jenis_surat', '=', 'jenis_surats.id')
    //         ->select('pengajuans.*', 'pengajuans.status', 'pengajuans.no_dokumen_perjalanan', 'pengajuans.status_orang_tua', 'pengajuans.name_orang_tua', 'pengajuans.nik_orang_tua', 'pengajuans.name_bayi', 'pengajuans.jenis_kelamin_bayi', 'pengajuans.tempat_dilahirkan', 'pengajuans.tanggal_lahir_bayi', 'pengajuans.waktu_lahir', 'pengajuans.jenis_kelahiran', 'pengajuans.kelahiran_ke', 'pengajuans.penolong_kelahiran', 'pengajuans.berat_bayi', 'pengajuans.panjang_bayi', 'pengajuans.status_ayah', 'pengajuans.name_ayah', 'pengajuans.nik_ayah', 'pengajuans.status_ibu', 'pengajuans.name_ibu', 'pengajuans.nik_ibu', 'pengajuans.name_jenazah', 'pengajuans.tanggal_kematian', 'pengajuans.waktu_kematian', 'pengajuans.sebab_kematian', 'pengajuans.tempat_kematian', 'pengajuans.saksi_keterangan_kematian', 'pengajuans.jenis_usaha', 'pengajuans.keterangan', 'penduduks.name', 'penduduks.email', 'penduduks.pekerjaan', 'penduduks.tanggal_lahir', 'penduduks.tempat_lahir', 'penduduks.jenis_kelamin', 'penduduks.alamat', 'penduduks.agama', 'penduduks.no_hp', 'jenis_surats.name_surat')
    //         ->where('pengajuans.id', $pengajuan_id)
    //         ->firstOrFail();
    //     // dd($pengajuans);
    //     return view('surat.suratketerangantidakmampu', ['pengajuans' => $pengajuans]);
    // }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengajuan $pengajuan)
    {
        //
    }
}
