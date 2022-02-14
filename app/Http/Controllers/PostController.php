<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Lop;
use App\Models\LoaiPost;
use App\Models\BinhLuan;
use App\Models\NopBai;

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
        if(auth()->user()->phan_quyen_id==1)
        {
            return view('sinh-vien/bai-viet', compact('post','lop'));
        }
        if(auth()->user()->phan_quyen_id==2)
        {
            return view('giao-vien/bai-viet', compact('post','lop'));
        }
        if(auth()->user()->phan_quyen_id==3)
        {
            return view('quan-tri-vien/bai-viet', compact('post','lop'));
        }
    }

    public function taoBaiViet($id)
    {
        $lop=Lop::find($id);
        $loaipost=LoaiPost::all();
        if($lop==null)
        {
            return redirect()->route('ds-lop-day')->withErrors(['failed'=>"Không tồn tại lớp"]);
        }
        return view('giao-vien/tao-bai-viet',compact('lop','loaipost'));
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
        
        $post->loai_post_id = $request->loai_post;
        $post->tieu_de=$request->tieu_de;
        $post->noi_dung=$request->noi_dung;
        
        if($request->loai_post==3||$request->loai_post==4)
        {
            if($request->thoi_han_ngay==null||$request->thoi_han_gio==null)
            {
                return back()->withErrors(['failed'=>"Loại bài viết này cần thời gian đến hạn"]);
            }
            $post->thoi_han_ngay=$request->thoi_han_ngay;
            $post->thoi_han_gio=$request->thoi_han_gio;
        }
        if($request->hasfile('file'))
        {
            $file = $request->file('file');
            $ex=  $request->file('file')->extension();
            $file_name= time() . '.'.$ex;
            $storedPath = $file->storeAs('file', $file_name);
            $post->file=$file_name;
        }
        $post->save();
        return redirect()->route('ds-bai-viet-giao-vien',['id' => $lop->id])->withErrors(['passed'=>"Tạo thành công"]);
    }

    public function formCapNhatBaiViet($id)
    {
        $loaipost=LoaiPost::all();
        $post=Post::find($id);
        if($post==null)
        {
            return redirect()->route('ds-tai-khoan')->withErrors(['failed'=>"Không tìm thấy bài viết này"]);
        }
        return view('giao-vien/cap-nhat-bai-viet', compact('post','loaipost'));     
    }

    public function capNhatBaiViet(Request $request,$id)
    {
        $post=Post::find($id);
        if($post==null)
        {
            return back()->route('ds-tai-khoan')->withErrors(['failed'=>"Không tìm thấy bài viết này"]);
        }
        $post->loai_post_id = $request->loai_post;
        $post->tieu_de=$request->tieu_de;
        $post->noi_dung=$request->noi_dung;
        if($request->loai_post==3||$request->loai_post==4)
        {
            if($request->thoi_han_ngay==null||$request->thoi_han_gio==null)
            {
                return back()->withErrors(['failed'=>"Loại bài viết này cần thời gian đến hạn"]);
            }
            $post->thoi_han_ngay=$request->thoi_han_ngay;
            $post->thoi_han_gio=$request->thoi_han_gio;
        
        }
        if($request->hasfile('file'))
        {
            $file = $request->file('file');
            $ex=  $request->file('file')->extension();
            $file_name= time() . '.'.$ex;
            $storedPath = $file->storeAs('file', $file_name);
            $post->file=$file_name;
        }

        $post->save();
        return redirect()->route('ds-bai-viet-giao-vien',['id' => $post->lop_id])->withErrors(['passed'=>"Cập nhật thành công"]);
    }
    public function formXoaBaiViet($id)
    {
        $loaipost=LoaiPost::all();
        $post=Post::find($id);
        if($post==null)
        {
            return redirect()->route('ds-tai-khoan')->withErrors(['failed'=>"Không tìm thấy bài viết này"]);
        }
        return view('giao-vien/xoa-bai-viet', compact('post','loaipost'));     
    }

    public function xoaBaiViet(Request $request,$id)
    {
        $post=Post::find($id);
        if($post==null)
        {
            return back()->route('ds-tai-khoan')->withErrors(['failed'=>"Không tìm thấy bài viết này"]);
        }
        $post->delete();
        return redirect()->route('ds-bai-viet-giao-vien',['id' => $post->lop_id])->withErrors(['passed'=>"Xoa thành công"]);
    }
    public function layDanhSachBinhLuan($id)
    {
        $post=Post::find($id);
        if($post==null)
        {
            return redirect()->route('ds-bai-viet-giao-vien',['id' => $post->lop_id])->withErrors(['failed'=>"Không tìm thấy bài viết này"]);
        }
        $cmt=BinhLuan::Where('post_id', $id )->get();
        if(auth()->user()->phan_quyen_id==1)
        {
            return view('sinh-vien/binh-luan', compact('cmt','post'));
        }
        if(auth()->user()->phan_quyen_id==2)
        {
            return view('giao-vien/binh-luan', compact('cmt','post'));
        }
        if(auth()->user()->phan_quyen_id==3)
        {
            return view('quan-tri-vien/binh-luan', compact('cmt','post'));
        }
        
    }

    public function taoBinhLuan($id)
    {
        $cmt=Post::find($id);
        if($cmt==null)
        {
            return back()->withErrors(['failed'=>"Không tồn tại bài viết"]);
        }
        if(auth()->user()->phan_quyen_id==1)
        {
            return view('sinh-vien/tao-binh-luan',compact('cmt'));
        }
        if(auth()->user()->phan_quyen_id==2)
        {
            return view('giao-vien/tao-binh-luan',compact('cmt'));
        }
        if(auth()->user()->phan_quyen_id==3)
        {
            return view('quan-tri-vien/tao-binh-luan',compact('cmt'));
        }
       
    }

    public function xuLyTaoBinhLuan(Request $request, $id)
    {
        $post=Post::find($id);
        if($post==null)
        {
            return back()->withErrors(['failed'=>"Không tồn tại bài viết"]);
        }
        $cmt= new BinhLuan();
        $cmt->post_id=$id;
        $cmt->tai_khoan_id=auth()->user()->id;
        $cmt->noi_dung=$request->noi_dung;
        $cmt->save();
        
        return redirect()->route('ds-binh-luan',['id' => $id])->withErrors(['passed'=>"Tạo thành công"]);
    }

    public function formCapNhatBinhLuan($id)
    {
        $cmt=BinhLuan::find($id);
        if($cmt==null)
        {
            if(auth()->user()->phan_quyen_id==1)
            {
                return back()->withErrors(['failed'=>"Không tồn tại bình luận"]);   

            }
            if(auth()->user()->phan_quyen_id==2)
            {
                return back()->withErrors(['failed'=>"Không tồn tại bình luận"]);

            }
            if(auth()->user()->phan_quyen_id==3)
            {
                return back()->withErrors(['failed'=>"Không tồn tại bình luận"]);

            }
        }
        if($cmt->tai_khoan_id!=auth()->user()->id)
        {
            return redirect()->route('ds-binh-luan',['id' => $cmt->post_id])->withErrors(['failed'=>"Đây là bình luận của tài khoản khác"]);
        }
        if(auth()->user()->phan_quyen_id==1)
        {
            return view('sinh-vien/cap-nhat-binh-luan', compact('cmt'));     

        }
        if(auth()->user()->phan_quyen_id==2)
        {
            return view('giao-vien/cap-nhat-binh-luan', compact('cmt'));     

        }
        if(auth()->user()->phan_quyen_id==3)
        {
            return view('quan-tri-vien/cap-nhat-binh-luan', compact('cmt'));     

        }
    }

    public function capNhatBinhLuan(Request $request,$id)
    {
        $cmt=BinhLuan::find($id);
        if($cmt==null)
        {
            if(auth()->user()->phan_quyen_id==1)
            {
                return back()->withErrors(['failed'=>"Không tồn tại bình luận"]);   

            }
            if(auth()->user()->phan_quyen_id==2)
            {
                return back()->withErrors(['failed'=>"Không tồn tại bình luận"]);

            }
            if(auth()->user()->phan_quyen_id==3)
            {
                return back()->withErrors(['failed'=>"Không tồn tại bình luận"]);

            }
        }
        if($cmt->tai_khoan_id!=auth()->user()->id)
        {
            return redirect()->route('ds-binh-luan',['id' => $cmt->post_id])->withErrors(['failed'=>"Đây là bình luận của tài khoản khác"]);
        }
        $cmt->noi_dung=$request->noi_dung;
        $cmt->save();
        return redirect()->route('ds-binh-luan',['id' => $cmt->post_id])->withErrors(['passed'=>"Cập nhật thành công"]);
    }
    public function formXoaBinhLuan($id)
    {
        $cmt=BinhLuan::find($id);
        if($cmt==null)
        {
            if(auth()->user()->phan_quyen_id==1)
            {
                return back()->withErrors(['failed'=>"Không tồn tại bình luận"]);   

            }
            if(auth()->user()->phan_quyen_id==2)
            {
                return back()->withErrors(['failed'=>"Không tồn tại bình luận"]);

            }
            if(auth()->user()->phan_quyen_id==3)
            {
                return back()->withErrors(['failed'=>"Không tồn tại bình luận"]);

            }
        }
        if($cmt->tai_khoan_id!=auth()->user()->id)
        {
            return redirect()->route('ds-binh-luan',['id' => $cmt->post_id])->withErrors(['failed'=>"Đây là bình luận của tài khoản khác"]);
        }
        if(auth()->user()->phan_quyen_id==1)
        {
            return view('sinh-vien/xoa-binh-luan', compact('cmt'));      


        }
        if(auth()->user()->phan_quyen_id==2)
        {
            return view('giao-vien/xoa-binh-luan', compact('cmt'));      

        }
        if(auth()->user()->phan_quyen_id==3)
        {
            return view('quan-tri-vien/xoa-binh-luan', compact('cmt'));      

        }
    }

    public function xoaBinhLuan(Request $request,$id)
    {
        $cmt=BinhLuan::find($id);
        if($cmt==null)
        {
            if(auth()->user()->phan_quyen_id==1)
            {
                return back()->withErrors(['failed'=>"Không tồn tại bình luận"]);   

            }
            if(auth()->user()->phan_quyen_id==2)
            {
                return back()->withErrors(['failed'=>"Không tồn tại bình luận"]);

            }
            if(auth()->user()->phan_quyen_id==3)
            {
                return back()->withErrors(['failed'=>"Không tồn tại bình luận"]);

            }
        }
        if($cmt->tai_khoan_id!=auth()->user()->id)
        {
            return redirect()->route('ds-binh-luan',['id' => $cmt->post_id])->withErrors(['failed'=>"Đây là bình luận của tài khoản khác"]);
        }
        $cmt->delete();
        return redirect()->route('ds-binh-luan',['id' => $cmt->post_id])->withErrors(['passed'=>"Xoa thành công"]);
    }

    public function timKiemPost(Request $request,$id)
    {
        $lop=Lop::find($id);
        $post = Post::where('tieu_de', 'LIKE', '%'. $request->tieu_de. '%')->where('lop_id',$id)->get();
        if($post==null)
        {
            return redirect()->route('ds-bai-viet-giao-vien',['id' => $id])->withErrors(['failed'=>"Không tồn tại bài viết này"]);
        }
        return view('giao-vien/bai-viet', compact('post','lop'));
    }
    public function NopBai($id)
    {
        $cmt=Post::find($id);
        if($cmt==null)
        {
            return back()->withErrors(['failed'=>"Không tồn tại bài viết"]);
        }
        return view('sinh-vien/nop-bai',compact('cmt'));

    }

    public function xuLyNopBai(Request $request, $id)
    {
        $post=Post::find($id);
        if($post==null)
        {
            return back()->withErrors(['failed'=>"Không tồn tại bài viết"]);
        }
        $nopbai= new NopBai();
        $nopbai->post_id=$id;
        $nopbai->tai_khoan_id=auth()->user()->id;

        $file = $request->file('file');
        $ex=  $request->file('file')->extension();
        $file_name= time() . '.'.$ex;
        $storedPath = $file->storeAs('fileBaiNop', $file_name);
        $nopbai->file=$file_name;
        $nopbai->save();
        
        return redirect()->route('ds-binh-luan',['id' => $id])->withErrors(['passed'=>"Nộp thành công"]);
    }

    public function dsNopBai($id)
    {
        $post=Post::find($id);
        if($post==null)
        {
            return back()->withErrors(['failed'=>"Không tồn tại bài viết"]);
        }
        $nopbai=NopBai::where('post_id',$id)->get();
        return view('giao-vien/ds-nop-bai',compact('post','nopbai'));

    }
}
