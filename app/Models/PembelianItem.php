<?php

namespace App\Models;

use App\Traits\Uuid;
use DigitalCloud\Blameable\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PembelianItem extends Model
{
    use HasFactory, Uuid, SoftDeletes, Blameable;

    protected $table = 'pembelian_item';
    protected $fillable = ['pembelian', 'produk', 'kuantitas', 'harga_beli', 'harga_jual'];

    public function get_produk()
    {
        return $this->belongsTo(Produk::class, 'produk')->withTrashed();
    }
}
