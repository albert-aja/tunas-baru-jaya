<?php

namespace App\Models;

use App\Traits\Uuid;
use DigitalCloud\Blameable\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory, Uuid, SoftDeletes, Blameable;

    protected $table = 'supplier';
    protected $fillable = ['nama', 'hp', 'tlp', 'fax', 'email', 'alamat'];
}
