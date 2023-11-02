<?php

namespace App\Http\Controllers;

use App\Charts\JenisKelamin;
use App\Models\Penduduk;
use App\Models\Pengajuan;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengajuan = Pengajuan::with('jenisSurat')->get();
        $penduduk = session('penduduk');
        $admin = session('admin');
        if ($penduduk) {
            return view('dashboard', compact('penduduk'));
        }
        if ($admin) {
            $penduduk = Penduduk::all();
            $pengajuan = Pengajuan::with('jenisSurat')->get();
            $genderCount = $penduduk->groupBy('jekel')->map->count();
            $domisiliCount = $penduduk->groupBy('dusun')->map->count();
            $pengajuanCount = $pengajuan->groupBy('id_jenis_surat')->map->count();
            // dd($pengajuanCount);

            $chart = new Chart('bar', 'chartjs');
            $chart->labels(['Laki-laki', 'Perempuan']); // Label jenis kelamin
            $chart->dataset('Jenis Kelamin', 'bar', [$genderCount->get('Laki-laki', 0), $genderCount->get('Perempuan', 0)])->backgroundColor(['blue', 'red']);

            $domisili = new Chart('pie', 'chartjs'); // Menggunakan Pie Chart untuk domisili
            $domisili->labels(array_map('ucwords', ['Tabek Panjang', 'Koto Baru', 'Parumpang'])); // Label domisili dengan huruf besar di awal kata
            $domisili->dataset('Domisili', 'pie', [
                $domisiliCount->get(strtoupper('Tabek Panjang'), 0),
                $domisiliCount->get(strtoupper('Koto Baru'), 0),
                $domisiliCount->get(strtoupper('Parumpung'), 0),
            ])->backgroundColor(['black', 'green', 'yellow']);

            $pengajuanSurat = new Chart('pie', 'chartjs'); // Menggunakan Pie Chart untuk domisili
            $jenisSuratLabels = $pengajuan->pluck('jenisSurat.name_surat')->toArray();
            // dd($jenisSuratLabels);
            $pengajuanSurat->labels(array_map('ucwords', $jenisSuratLabels));

            $jenisSuratColors = [
                'Surat Keterangan Tidak Mampu' => 'red',
                'Surat Keterangan Kematian' => 'orange',
                'Surat Keterangan Domisili' => 'grey',
            ];

            // dd($pengajuanSurat->datasets);
            $pengajuanSurat->dataset('Pengajuan Surat', 'pie', [
                $pengajuanCount->get(strtoupper(1), 0),
                $pengajuanCount->get(strtoupper(3), 0),
                $pengajuanCount->get(strtoupper(2), 0),
            ])->backgroundColor(array_values($jenisSuratColors));

            $suratTidakMampu = 0;
            $suratDomisili = 0;
            $suratKematian = 0;

            // Loop through pengajuan
            foreach ($pengajuan as $p) {
                // Cocokkan nama surat menggunakan stripos (case-insensitive)
                if (stripos($p->jenisSurat->name_surat, 'mampu') !== false) {
                    $suratTidakMampu++;
                } elseif (stripos($p->jenisSurat->name_surat, 'domisili') !== false) {
                    $suratDomisili++;
                } elseif (stripos($p->jenisSurat->name_surat, 'kematian') !== false) {
                    $suratKematian++;
                }
            }

            $pengajuans = Pengajuan::where('status', '1')->latest()->get();
            // dd($pengajuan);
        }
        return view('dashboard', compact('admin', 'chart', 'domisili', 'pengajuanSurat','suratTidakMampu', 'suratDomisili', 'suratKematian', 'pengajuans'));
    }
    // public function showChart()
    // {
    //     $chart = new JenisKelamin;
    //     $chart->options([
    //         'responsive' => true,
    //     ]);

    //     // Isi data grafik dari database
    //     $data = Penduduk::pluck('jekel');
    //     $chart->labels($data->keys());
    //     $chart->dataset('Data Penjualan', 'line', $data->values())->options([
    //         'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
    //         'borderColor' => 'rgba(54, 162, 235, 1)',
    //         'borderWidth' => 1,
    //     ]);

    //     return view('dashboard', compact('chart'));
    // }
}
