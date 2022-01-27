<?php

namespace App\Models;

use App\Traits\Uuid;
use DigitalCloud\Blameable\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PembelianPembayaran extends Model
{
    use HasFactory, Uuid, SoftDeletes, Blameable;

    protected $table = 'pembelian_pembayaran';
    protected $fillable = ['pembelian', 'waktu_transaksi', 'nominal', 'bukti_transaksi', 'keterangan'];
}
