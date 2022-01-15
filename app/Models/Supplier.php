<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

     //karena penamaan bukan singular,,maka harus mendeskripsikan table dari database sebagai berikut
     protected $table = 'supplier';

     protected $primaryKey = 'id_supplier';
 
     // menentukan colom mana yg harus di jaga
     protected $guarded = [];
}
