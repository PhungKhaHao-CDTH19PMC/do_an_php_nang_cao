<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lop extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='lop';

    public function chiTiet()
    {
        return $this->belongsToMany('App\Models\TaiKhoan','tham_gia');
    }
}
