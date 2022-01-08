<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Lop;

class PostController extends Controller
{
    public function layDanhSach()
    {
        return view('sinh-vien/danh-sach-bai-viet');
    }

    public function layDSTrangGiaoVien($id)
    {
        $lop=Post::Where('lop_id', $id )->get();
        return view('giao-vien/bai-viet', compact('lop'));
    }

    public function taoBaiViet($id)
    {
        $lop=Post::Where('lop_id', $id )->first();
        return view('giao-vien/tao-bai-viet');
    }

    public function xuLyTaoBaiViet(Request $request, $id)
    {
        
        $lop=Lop::find($id);
       
        
    }
}
