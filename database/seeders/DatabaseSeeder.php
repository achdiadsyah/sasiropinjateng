<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\AppConfig;
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
        $this->call([
            ProvinceSeeder::class,
            CitySeeder::class,
        ]);
        
        User::create([
            'email'                 => 'admin@iropinjateng.com',
            'name'                  => 'Administrator',
            'email_verified_at'     => date("Y-m-d H:i:s"),
            'password'              => Hash::make('PassWord'),
            'created_at'            => date("Y-m-d H:i:s"),
            'updated_at'            => date("Y-m-d H:i:s"),
        ]);

        AppConfig::create([
            'nama_bank'         => 'BCA',
            'atas_nama'         => 'IDA FARIDA',
            'rekening'          => '8030665351',
            'biaya'             => '300000',
            'gambar'            => '',
            'contact_person'    => '6281353214718',
        ]);
    }
}
