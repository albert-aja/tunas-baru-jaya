<?php

namespace Database\Seeders;

use App\Models\Ref\Pembelian\StatusPembayaran;
use Illuminate\Database\Seeder;

class StatusPembelianPembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusPembayaran::create([
            'nama' => 'Lunas',
        ]);

        StatusPembayaran::create([
            'nama' => 'Belum Lunas',
        ]);
    }
}
