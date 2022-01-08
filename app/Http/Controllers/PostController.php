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
        $post=Post::Where('lop_id', $id )->get();
        $lop=Lop::find($id);
        if($lop==null)
        {
            return redirect()->route('ds-lop-day')->withErrors(['failed'=>"Không tồn tại lớp"]);
        }
        return view('giao-vien/bai-viet', compact('post','lop'));
    }

    public function taoBaiViet($id)
    {
        $lop=Lop::find($id);
        if($lop==null)
        {
            return redirect()->route('ds-lop-day')->withErrors(['failed'=>"Không tồn tại lớp"]);
        }
        return view('giao-vien/tao-bai-viet',compact('lop'));
    }

    public function xuLyTaoBaiViet(Request $request, $id)
    {
        $lop=Lop::find($id);
        if($lop==null)
        {
            return redirect()->route('ds-lop-day')->withErrors(['failed'=>"Không tồn tại lớp"]);
        }
        $post= new Post();
        $post->lop_id=$lop->id;
        $post->loai_post_id=1;
        $post->tieu_de=$request->tieu_de;
        $post->noi_dung=$request->noi_dung;
        $post->thoi_han=$request->thoi_han;

        $image = $request->file('file');
        $ex=  $request->file('file')->extension();
        $file_name= time() . '.'.$ex;
        $storedPath = $image->storeAs('file', $file_name);
        //$post->file=$file_name;

        $post->save();
        return back()->withErrors(['passed'=>"Tạo thành công"]);
    }
}
