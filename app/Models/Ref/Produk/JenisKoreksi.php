<?php

namespace App\Models\Ref\Produk;

use App\Traits\Uuid;
use DigitalCloud\Blameable\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisKoreksi extends Model
{
    use HasFactory, Uuid, SoftDeletes, Blameable;

    protected $table = 'ref_produk_jenis_koreksi';
    protected $fillable = ['nama', 'kondisi'];
}
