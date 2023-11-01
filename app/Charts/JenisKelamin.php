<?php

namespace App\Charts;

use App\Models\Penduduk;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class JenisKelamin extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        $data = Penduduk::select('jekel')->get();
        $laki_laki = $data->where('jekel', 'Laki-laki')->count();
        $perempuan = $data->where('jekel', 'Perempuan')->count();

        $this->labels(['Laki-laki', 'Perempuan']);
        $this->dataset('Jenis Kelamin', 'pie', [$laki_laki, $perempuan])
            ->backgroundColor(['#007BFF', '#FF5733']);
    }
}
