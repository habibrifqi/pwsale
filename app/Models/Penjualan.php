<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Member;
use App\Models\User;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = "penjualan";

    protected $primaryKey = "id_penjualan";

    protected $guarded = [];

    public function member()
    {
        return $this->hasOne(Member::class,'id_member','id_member');
    }

    public function user()
    {
        return $this->hasOne(User::class,'id','id_user');
    }
}
