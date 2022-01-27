<?php

namespace App\Models;

use App\Models\Ref\Pembelian\StatusPembayaran;
use App\Traits\Uuid;
use DigitalCloud\Blameable\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pembelian extends Model
{
    use HasFactory, Uuid, SoftDeletes, Blameable;

    protected $table = 'pembelian';
    protected $fillable = ['supplier', 'waktu_transaksi', 'no_faktur', 'keterangan', 'pembayaran'];

    public function get_status_pembayaran()
    {
        return $this->belongsTo(StatusPembayaran::class, 'pembayaran');
    }

    public function get_item()
    {
        return $this->hasMany(PembelianItem::class, 'pembelian', 'id');
    }

    public function get_pembayaran()
    {
        return $this->hasMany(PembelianPembayaran::class, 'pembelian', 'id');
    }

    public function get_supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier', 'id');
    }

    public function get_total_harga()
    {
        return $this->get_item->sum(function ($get_item) {
            return $get_item->kuantitas * $get_item->harga_beli;
        });
    }

    public function get_total_pembayaran()
    {
        return $this->get_pembayaran->sum(function ($get_pembayaran) {
            return $get_pembayaran->nominal;
        });
    }
}
