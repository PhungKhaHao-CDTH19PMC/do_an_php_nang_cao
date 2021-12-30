<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lop;
use App\Models\ThamGia;

class LopController extends Controller
{
    public function layDanhSach()
    {
        $lop=Lop::where('tai_khoan_id',auth()->user()->id)->get();
        if($lop==null)
        {
            return back()->withErrors(['failed'=>"Không tìm thấy lớp học phần"]);
        }
        return view('giao-vien/danh-sach-lop-day',compact('lop'));
    }

    public function layTatCaLop()
    {
        $lop=Lop::all();
        if($lop==null)
         {
            return back()->withErrors(['failed'=>"Không tìm thấy lớp học phần"]);
         }
        return view('quan-tri-vien/danh-sach-lop',compact('lop'));
    }
    
    public function themLop()
    {
        return view('giao-vien/them-lop');
    }

    public function xuLyThemLop(Request $request)
    {
        $l= new Lop();
        $l->tai_khoan_id=auth()->user()->id;
        $l->ten_lop=$request->ten_lop;
        $l->ma_lop=$request->ma_lop;
        
        $this->validate($request, 
			[
				'hinh_anh' => 'mimes:jpg,jpeg,png,gif|max:2048',
			],			
			[
				'hinh_anh.mimes' => 'Chỉ chấp nhận hình thẻ với đuôi .jpg .jpeg .png .gif',
				'hinh_anh.max' => 'Hình thẻ giới hạn dung lượng không quá 2M',
			]
		);
        $image = $request->file('hinh_anh');
        $ex=  $request->file('hinh_anh')->extension();
        $file_name= time() . '.'.$ex;
        $storedPath = $image->storeAs('images', $file_name);
        $l->hinh_anh=$file_name;

        $dsl=Lop::where('ma_lop',$request->ma_lop)->first();
        if(empty($dsl))
        {
            $l->save();
            return redirect()->route('ds-lop-day');
        }
        return back()->withErrors(['failed'=>"Mã lớp đã tồn tại"]);
    }

    public function chiTietLop($id)
    {
         $lop=Lop::find($id);
         if($lop==null)
         {
            if(auth()->user()->phan_quyen_id==2)
            {
                return redirect()->route('ds-lop-day')->withErrors(['failed'=>"Lớp không tồn tại"]);
            }
            elseif(auth()->user()->phan_quyen_id==3){
                return redirect()->route('ds-lop')->withErrors(['failed'=>"Lớp không tồn tại"]);
            }
            else{
                return redirect()->route('ds-lop-hoc')->withErrors(['failed'=>"Lớp không tồn tại"]);
            }
         }
         else
         {
            if(auth()->user()->phan_quyen_id==2)
            {
                if(auth()->user()->id!=$lop->tai_khoan_id)
                {
                    return redirect()->route('ds-lop-day')->withErrors(['failed'=>"Đây không phải lớp bạn giảng dạy"]);
                }
                return view('giao-vien/chi-tiet-lop', compact('lop'));
            }
            elseif(auth()->user()->phan_quyen_id==3){
               return view('quan-tri-vien/chi-tiet-lop', compact('lop'));
            }
            else{
                $kt=ThamGia::where('tai_khoan_id',auth()->user()->id)->where('lop_id',$id)->first();
                if($kt)
                {
                    return view('sinh-vien/chi-tiet-lop', compact('lop'));
                }
                return redirect()->route('ds-lop-hoc')->withErrors(['failed'=>"Đây không phải lớp bạn đang học"]);
            }
         }
    }

    public function formCapNhatLop($id)
    {
        $lop=Lop::find($id);
        if($lop==null)
        {
            return redirect()->route('ds-lop-day')->withErrors(['failed'=>"Không tìm thấy lớp này"]);
        }
        if($lop->tai_khoan_id!= auth()->user()->id)
        {
            return redirect()->route('ds-lop-day')->withErrors(['failed'=>"Vui lòng không cập nhật thông tin lớp khác"]);
        }
        return view('giao-vien/cap-nhat-lop', compact('lop'));
            
    }

    public function capNhatLop(request $req,$id)
    {
        $lop=Lop::find($id);
        if($lop==null)
        {
            return redirect()->route('ds-lop-day')->withErrors(['failed'=>"Không tìm thấy lớp này"]);
        }
        if($lop->tai_khoan_id!= auth()->user()->id)
        {
            return redirect()->route('ds-lop-day')->withErrors(['failed'=>"Vui lòng không cập nhật thông tin lớp khác"]);
        }
        if ($req->hasFile('hinh_anh')) {
            // Nếu không thì in ra thông báo
            $this->validate($req, 
			[
				'hinh_anh' => 'mimes:jpg,jpeg,png,gif|max:2048',
			],			
			[
				'hinh_anh.mimes' => 'Chỉ chấp nhận hình thẻ với đuôi .jpg .jpeg .png .gif',
				'hinh_anh.max' => 'Hình thẻ giới hạn dung lượng không quá 2M',
			]
            );
            $image = $req->file('hinh_anh');
            $ex=  $req->file('hinh_anh')->extension();
            $file_name= time() . '.'.$ex;
            $storedPath = $image->storeAs('images', $file_name);
            $lop->ten_lop= $req->ten_lop;
            $lop->hinh_anh=$file_name;
            $lop->save();
        }
        else{
            $lop->ten_lop= $req->ten_lop;
            $lop->save();
        }
        return back()->withErrors(['passed'=>"Cập nhật thành công"]);
    }

    public function formXoaLop($id)
    {
        
        $lop=Lop::find($id);
        if($lop==null)
        {
            return redirect()->route('ds-lop-day')->withErrors(['failed'=>"Không tìm thấy lớp này"]);
        }
        if($lop->tai_khoan_id!= auth()->user()->id)
        {
            return redirect()->route('ds-lop-day')->withErrors(['failed'=>"Vui lòng không xóa thông tin lớp khác"]);
        }
        return view('giao-vien/xoa-lop', compact('lop'));
    }
    
    function xoaLop($id)
    {
        $lop=Lop::find($id);
        if($lop==null)
        {
            return redirect()->route('ds-lop-day')->withErrors(['failed'=>"Không tìm thấy lớp này"]);
        }
        if($lop->tai_khoan_id!= auth()->user()->id)
        {
            return redirect()->route('ds-lop-day')->withErrors(['failed'=>"Vui lòng không xóa thông tin lớp khác"]);
        }
        $tg=ThamGia::where('lop_id',$lop->id)->first();
        if(empty($tg))
        {
            $lop->delete();
            return redirect()->route('ds-lop-day')->withErrors(['passed'=>"Đã xóa lớp"]);
        }
        return redirect()->route('ds-lop-day')->withErrors(['failed'=>"Không thể xóa lớp này"]);
    }
    
}
