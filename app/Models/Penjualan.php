<?php

namespace App\Models;

use App\Models\Ref\Penjualan\StatusPembayaran;
use App\Traits\Uuid;
use DigitalCloud\Blameable\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penjualan extends Model
{
    use HasFactory, Uuid, SoftDeletes, Blameable;

    protected $table = 'penjualan';
    protected $fillable = ['customer', 'waktu_transaksi', 'no_faktur', 'keterangan', 'pembayaran'];

    public function get_status_pembayaran()
    {
        return $this->belongsTo(StatusPembayaran::class, 'pembayaran');
    }

    public function get_item()
    {
        return $this->hasMany(PenjualanItem::class, 'penjualan', 'id');
    }

    public function get_pembayaran()
    {
        return $this->hasMany(PenjualanPembayaran::class, 'penjualan', 'id');
    }

    public function get_customer()
    {
        return $this->belongsTo(Customer::class, 'customer', 'id');
    }

    public function get_total_harga()
    {
        return $this->get_item->sum(function ($get_item) {
            return $get_item->kuantitas * $get_item->harga_jual;
        });
    }

    public function get_total_pembayaran()
    {
        return $this->get_pembayaran->sum(function ($get_pembayaran) {
            return $get_pembayaran->nominal;
        });
    }
}
