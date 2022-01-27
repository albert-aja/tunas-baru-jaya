<?php

namespace App\Models;

use App\Models\Ref\Produk\JenisKoreksi;
use App\Traits\Uuid;
use DigitalCloud\Blameable\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProdukKoreksi extends Model
{
    use HasFactory, Uuid, SoftDeletes, Blameable;

    protected $table = 'produk_koreksi';
    protected $fillable = ['produk', 'jenis_koreksi', 'kuantitas'];

    public function get_jenis_koreksi()
    {
        return $this->belongsTo(JenisKoreksi::class, 'jenis_koreksi');
    }
}
