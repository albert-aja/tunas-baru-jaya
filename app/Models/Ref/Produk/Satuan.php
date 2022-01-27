<?php

namespace App\Models\Ref\Produk;

use App\Traits\Uuid;
use DigitalCloud\Blameable\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Satuan extends Model
{
    use HasFactory, Uuid, SoftDeletes, Blameable;

    protected $table = 'ref_produk_satuan';
    protected $fillable = ['nama'];
}
