<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\User::factory()->create([
            'name' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('qwerty123'),
            'password_confirmation' => bcrypt('qwerty123'),
            'role' => 'superadmin',
            'no_hp' => '081234567890',
            'avatar' => null

        ]);

        // \App\Models\Penduduk::factory()->create([
        //     'uid' => '1234567890',
        //     'nik' => '112233445566',
        //     'no_kk' => '2131231233',
        //     'password' => bcrypt('qwerty123'),
        //     'password_confirmation' => bcrypt('qwerty123'),
        //     'nama' => 'penduduk1',
        //     'tmp_lahir' => 'padang',
        //     'tgl_lahir' => '2002-08-03',
        //     'agama' => 'islam',
        //     'jekel' => 'Laki-laki',
        //     'status_perkawinan' => 'Belum Kawin',
        //     'ibu_kandung' => 'ibu1',
        //     'hub_kel' => 'anak',
        //     'alamat' => 'padang',
        //     'pekerjaan' => 'mahasiswa',
        //     'desa_kelurahan' => 'payakumbuh',
        //     'dusun' => null,

        // ]);

        // \App\Models\Penduduk::factory()->create([
        //     // 'uid' => 'qwerty1234',
        //     'nik' => '112233445560',
        //     'no_kk' => '2131231233',
        //     'password' => bcrypt('qwerty123'),
        //     'password_confirmation' => bcrypt('qwerty123'),
        //     'nama' => 'penduduk2',
        //     'tmp_lahir' => 'padang',
        //     'tgl_lahir' => '2002-08-03',
        //     'jekel' => 'Laki-laki',
        //     'ibu_kandung' => 'ibu1',
        //     'hub_kel' => 'anak',
        //     'alamat' => 'padang',
        //     'pekerjaan' => 'mahasiswa',
        //     'desa_kelurahan' => 'payakumbuh',
        //     'dusun' => null,

        // ]);

        // \App\Models\Penduduk::factory()->create([
        //     // 'uid' => 'qwerty1234',
        //     'nik' => '112233445561',
        //     'no_kk' => '2131231233',
        //     'password' => bcrypt('qwerty123'),
        //     'password_confirmation' => bcrypt('qwerty123'),
        //     'nama' => 'penduduk3',
        //     'tmp_lahir' => 'padang',
        //     'tgl_lahir' => '2002-08-03',
        //     'jekel' => 'Laki-laki',
        //     'ibu_kandung' => 'ibu1',
        //     'hub_kel' => 'anak',
        //     'alamat' => 'padang',
        //     'pekerjaan' => 'mahasiswa',
        //     'desa_kelurahan' => 'payakumbuh',
        //     'dusun' => null,

        // ]);
    }
}
