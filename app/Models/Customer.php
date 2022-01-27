<?php

namespace App\Models;

use App\Traits\Uuid;
use DigitalCloud\Blameable\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, Uuid, SoftDeletes, Blameable;

    protected $table = 'customer';
    protected $fillable = ['nama', 'hp', 'tlp', 'fax', 'email', 'alamat'];

    public function get_penjualan()
    {
        return $this->hasMany(Penjualan::class, 'customer', 'id');
    }

    public function get_total_utang()
    {
        return $this->get_penjualan->sum(function ($get_penjualan) {
            return ($get_penjualan->get_status_pembayaran->nama == 'Belum Lunas' ? $get_penjualan->get_total_harga() - $get_penjualan->get_total_pembayaran() : 0);
        });
    }
}
