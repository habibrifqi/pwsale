<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('setting')->insert([
            'id_setting' => 1,
            'nama_perusahaan' => 'PW Sale Store',
            'alamat' => 'Jl.jetis,sendangsari,pajangan,bantul',
            'telepon' => '0895366039821',
            'tipe_nota' => 1,//tipe nota kecil,
            'diskon' => 5,
            'path_logo' => '/image/logo/habib.png',
            'path_kartu_member' => '/image/member.png',

        ]);
    }
}
