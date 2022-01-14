<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    //karena penamaan bukan singular,,maka harus mendeskripsikan table dari database sebagai berikut
    protected $table = 'member';

    protected $primaryKey = 'id_member';

    // menentukan colom mana yg harus di jaga
    protected $guarded = [];
}
