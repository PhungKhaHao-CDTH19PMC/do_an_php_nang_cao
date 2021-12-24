<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ThamGia;
use App\Models\Lop;
use App\Models\TaiKhoan;

class ThamGiaController extends Controller
{
    public function xuLyThemLop(Request $request)
    {
        $ml=Lop::where('ma_lop',$request->ma_lop)->first();
        if(empty($ml))
        {
            return back()->withErrors(['failed'=>"Mã lớp không tồn tại"]);
        }
        $kt=ThamGia::where('tai_khoan_id',auth()->user()->id)->where('lop_id',$ml->id)->first();
        if(empty($kt))
        {
            $tg= new ThamGia();
            $tg->tai_khoan_id=auth()->user()->id;
            $tg->lop_id=$ml->id;
            $tg->save();
            return redirect()->route('ds-lop-hoc')->withErrors(['failed'=>"Thêm thành công"]);
        }
        return back()->withErrors(['failed'=>"Bạn đã là thành viên của lớp"]);
    }

    public function xuLyThemHocSinh(Request $request, $id)
    {
        $tk=TaiKhoan::where('email',$request->email)->first();
        if(empty($tk))
        {
            return back()->withErrors(['failed'=>"Email sinh viên không tồn tại"]);
        }
        if($tk->phan_quyen_id==2)
        {
            return back()->withErrors(['failed'=>"Đây là tài khoản giáo viên"]);
        }
        if($tk->phan_quyen_id==3)
        {
            return back()->withErrors(['failed'=>"Đây là tài khoản quản trị viên"]);
        }
        $kt=ThamGia::where('tai_khoan_id',$tk->id)->where('lop_id',$id)->first();
        if(empty($kt))
        {
            $tg= new ThamGia();
            $tg->tai_khoan_id=$tk->id;
            $tg->lop_id=$id;
            $tg->save();
            return redirect()->route('chi-tiet-lop', ['id'=>$id])->withErrors(['failed'=>"Thêm thành công"]);
        }
        return back()->withErrors(['failed'=>"Sinh viên đã được thêm vào lớp trước đó"]);
    }
}
