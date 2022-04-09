<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $alamat = array(
            "Dusun Krajan, RT 001 RW 001",
            "Dusun Krajan, RT 002 RW 001",
            "Dusun Krajan, RT 003 RW 001",
            "Dusun Krajan, RT 004 RW 002",
            "Dusun Krajan, RT 005 RW 002",
            "Dusun Krajan, RT 006 RW 002",
            "Dusun Kramat, RT 007 RW 003",
            "Dusun Krajan, RT 008 RW 003",
            "Dusun Kramat, RT 009 RW 003",
            "Dusun Nyabrang, RT 010 RW 004",
            "Dusun Nyabrang, RT 011 RW 004",
            "Dusun Ketapang, RT 012 RW 005",
            "Dusun Ketapang, RT 013 RW 005",
            "Dusun Ketapang, RT 014 RW 005",
            "Dusun Lampek, RT 015 RW 006",
            "Dusun Lampek, RT 016 RW 006"
        );

        foreach($alamat as $value){
            \App\Models\Alamat::create([
                "alamat" => $value
            ]);
        }

        $kategori = array(
            "Lainnya",
            "Kependudukan",
            "Aspirasi / Masukan",
            "Pembangunan / Infrastruktur"
        );

        foreach($kategori as $value){
            \App\Models\Kategori::create([
                "kategori" => $value
            ]);
        }

        \App\Models\User::create([
            'nik' => "3513060202980001",
            'nama' => "Hasyim Asy'ari",
            'jk' => "L",
            'alamat_id' => 9,
            'no_hp' => "085330256361",
            'jabatan' => "Adminstrator",
            'username' =>"admin",
            'password' => Hash::make('admin'),
            'roles' => "admin"
        ]);

        \App\Models\User::create([
            'nik' => "3513060202980002",
            'nama' => "Agus Indra Gunawan",
            'jk' => "L",
            'alamat_id' => 11,
            'no_hp' => "085330256000",
            'jabatan' => "Sekertaris Desa",
            'username' =>"petugas",
            'password' => Hash::make('petugas'),
            'roles' => "petugas"
        ]);

        \App\Models\User::create([
            'nik' => "3513060202980003",
            'nama' => "Rizal Efendi",
            'jk' => "L",
            'alamat_id' => 10,
            'no_hp' => "085330256000",
            'username' =>"user",
            'password' => Hash::make('user'),
            'roles' => "user"
        ]);

    }
}
