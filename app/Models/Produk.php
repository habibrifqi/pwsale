<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    //karena penamaan bukan singular,,maka harus mendeskripsikan table dari database sebagai berikut
    protected $table = 'produk';

    protected $primaryKey = 'id_produk';

    // menentukan colom mana yg harus di jaga
    protected $guarded = [];
}
