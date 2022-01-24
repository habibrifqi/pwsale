<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'setting';

    protected $primaryKey = 'id_setting';

    // menentukan colom mana yg harus di jaga
    protected $guarded = [];
}
