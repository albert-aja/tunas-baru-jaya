<?php

namespace App\Models\Ref\Pembelian;

use App\Traits\Uuid;
use DigitalCloud\Blameable\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatusPembayaran extends Model
{
    use HasFactory, Uuid, SoftDeletes, Blameable;

    protected $table = 'ref_pembelian_status_pembayaran';
    protected $fillable = ['nama'];
}
