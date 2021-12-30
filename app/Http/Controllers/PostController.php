<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function layDanhSach()
    {
        return view('sinh-vien/danh-sach-bai-viet');
    }
}
