<?php

namespace App\Http\Controllers;

use App\Charts\JenisKelamin;
use App\Models\Penduduk;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penduduk = session('penduduk');
        $admin = session('admin');
        if ($penduduk) {
            return view('dashboard', compact('penduduk'));
        }
        if ($admin) {
            $penduduk = Penduduk::all();
            $genderCount = $penduduk->groupBy('jekel')->map->count();
            $chart = new Chart('bar', 'chartjs');
            $chart->labels(['Laki-laki', 'Perempuan']); // Label jenis kelamin
            $chart->dataset('Jenis Kelamin', 'bar', [$genderCount->get('Laki-laki', 0), $genderCount->get('Perempuan', 0)])->backgroundColor(['blue', 'pink']);
            return view('dashboard', compact('admin', 'chart'));
        }
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
