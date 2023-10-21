<?php

namespace App\Imports;

use App\Models\Penduduk;
use Maatwebsite\Excel\Concerns\ToModel;

class PenduduksImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        try {
            // Pemeriksaan sebelum parsing tanggal
            $tgl_lahir = $row[6];
            if ($tgl_lahir !== 'TANGGAL LAHIR') {
                $tgl_lahir = \Carbon\Carbon::parse($tgl_lahir)->format('Y-m-d');
            } else {
                // Atau, berikan nilai default jika data tidak valid
                $tgl_lahir = null;
            }

            return new Penduduk([
                'desa_kelurahan' => $row[0],
                'alamat' => $row[1],
                'dusun' => $row[2],
                'no_kk' => $row[3],
                'nik' => (int)$row[4],
                'nama' => $row[5],
                'tgl_lahir' => $tgl_lahir,
                'tmp_lahir' => $row[7],
                'jekel' => $row[8],
                'pekerjaan' => $row[9],
                'ibu_kandung' => $row[10],
                'hub_kel' => $row[11],
            ]);
        } catch (\Exception $e) {
            // Penanganan kesalahan
            \Log::error("Error importing data: " . $e->getMessage());
            return null;
        }
    }
}
