<?php

namespace App\Models\Config;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory, Uuid;

    protected $table = 'config_menu';
}
