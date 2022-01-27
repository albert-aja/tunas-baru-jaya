<?php

namespace App\Models;

use App\Models\Ref\Produk\Kategori;
use App\Models\Ref\Produk\Satuan;
use App\Traits\Uuid;
use DigitalCloud\Blameable\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produk extends Model
{
    use HasFactory, Uuid, SoftDeletes, Blameable;

    protected $table = 'produk';
    protected $fillable = ['nama', 'kategori', 'satuan', 'foto', 'harga_jual', 'harga_jual_eceran', 'stok'];

    public function get_kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori');
    }

    public function get_satuan()
    {
        return $this->belongsTo(Satuan::class, 'satuan');
    }
}
