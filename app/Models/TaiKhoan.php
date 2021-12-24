<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class TaiKhoan extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;
    protected $table='tai_khoan';

    public function dsLopHoc()
    {
        return $this->belongsToMany('App\Models\Lop','tham_gia');
    }
    public function phanQuyen()
    {
        return $this->belongsTo('App\Models\PhanQuyen');
    }
}
