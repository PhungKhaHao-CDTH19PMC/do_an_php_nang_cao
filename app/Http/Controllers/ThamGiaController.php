<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ThamGia;
use App\Models\Lop;
use App\Models\TaiKhoan;
use App\Models\HangCho;

class ThamGiaController extends Controller
{
    public function xuLyHangCho(Request $request)
    {
        $ml=Lop::where('ma_lop',$request->ma_lop)->first();
        if(empty($ml))
        {
            return back()->withErrors(['failed'=>"Mã lớp không tồn tại"]);
        }
        $kt=HangCho::where('tai_khoan_id',auth()->user()->id)->where('lop_id',$ml->id)->first();
        if(empty($kt))
        {
            $kt=ThamGia::where('tai_khoan_id',auth()->user()->id)->where('lop_id',$ml->id)->first();
            if(empty($kt))
            {
                $tg= new HangCho();
                $tg->tai_khoan_id=auth()->user()->id;
                $tg->lop_id=$ml->id;
                $tg->save();
                return redirect()->route('ds-lop-hoc')->withErrors(['passed'=>"Thêm thành công, hãy đợi giảng viên xét duyệt "]);
            }
            return back()->withErrors(['failed'=>"Bạn đã là thành viên của lớp"]);
        }
        return back()->withErrors(['failed'=>"Đang chờ xét duyệt"]);
    }

    public function xuLyThemHocSinh(Request $a, $id)
    {
        // $tk=TaiKhoan::where('email',$request->email)->first();
        // if(empty($tk))
        // {
        //     return back()->withErrors(['failed'=>"Email sinh viên không tồn tại"]);
        // }
        // if($tk->phan_quyen_id==2)
        // {
        //     return back()->withErrors(['failed'=>"Đây là tài khoản giáo viên"]);
        // }
        // if($tk->phan_quyen_id==3)
        // {
        //     return back()->withErrors(['failed'=>"Đây là tài khoản quản trị viên"]);
        // }
        // $kt=ThamGia::where('tai_khoan_id',$tk->id)->where('lop_id',$id)->first();
        // if(empty($kt))
        // {
        //     $tg= new ThamGia();
        //     $tg->tai_khoan_id=$tk->id;
        //     $tg->lop_id=$id;
        //     $tg->save();
        //     return redirect()->route('chi-tiet-lop', ['id'=>$id])->withErrors(['passed'=>"Thêm thành công"]);
        // }
        // return back()->withErrors(['failed'=>"Sinh viên đã được thêm vào lớp trước đó"]);
        $dsemail=explode(":", $a->email);
        foreach($dsemail as $email)
        {
            $sinhvien=TaiKhoan::where("email","$email")->first();
            if(empty($sinhvien))
            {
            return redirect()->route("chi-tiet-lop",['id'=>$id])->with('error',"Email $email này không hợp lệ");   
            }
            $hc= ThamGia::where('lop_id',$id)->where('tai_khoan_id',$sinhvien->id)->first();
            if($hc)
            {
                return redirect()->route("chi-tiet-lop",['id'=>$id])->with('error',"Email $email đã có trong lớp mời bạn kiểm tra lại nhé");  
            }
            if($sinhvien->phan_quyen_id==2){
        
                return redirect()->route("chi-tiet-lop",['id'=>$id])->with('error',"Email $email này là của giáo viên mời bạn kiểm tra lại nhé");   
            }
            elseif($sinhvien->phan_quyen_id==3)
            {
                return redirect()->route("chi-tiet-lop",['id'=>$id])->with('error',"Email $email này là của Admin mời bạn kiểm tra lại nhé");   
            }
        }
        $dem=0;
        foreach($dsemail as $email)
        {
            $sinhvien=TaiKhoan::where("email","$email")->first();
            $hc= HangCHo::where('lop_id',$id)->where('tai_khoan_id',$sinhvien->id)->first();
            if($hc)
            {
                $hc->delete();
                $add=new ThamGia;
                $add->lop_id=$id;
                $add->tai_khoan_id=$sinhvien->id;
                $add->save();
                $dem++;
            }
            else{
                $add=new ThamGia;
                $add->lop_id=$id;
                $add->tai_khoan_id=$sinhvien->id;
                $add->save();
                $dem++;
            }
        }
         return redirect()->route("chi-tiet-lop",["id"=>$id])->with('thanhcong',"Bạn đã thêm thành công $dem sinh viên");
    }
    public function layDanhSachHangCho($id)
    {
        $hc = HangCho::where('lop_id',$id)->get();
        $lop=Lop::find($id);
        $sv=[];
        $tk=TaiKhoan::all();
        foreach($tk as $ac)
        {
            foreach($hc as $sd)
            {
               
                if($ac->id==$sd->tai_khoan_id)
                {
                    $sv[]  = TaiKhoan::where('id',$sd->tai_khoan_id)->first();
                }
            }
              
        }
        return view('giao-vien/hang-cho',compact('sv','lop'));
    }
    public function xuLyDanhSachHangCho($id,$idsv)
    {
        $sv = HangCho::where('lop_id',$id)->where('tai_khoan_id',$idsv)->first();
        $sv->delete();
        $tg = new ThamGia;
        $tg->lop_id =$id;
        $tg->tai_khoan_id =$idsv;
        $tg->save();
        return redirect()->route('hang-cho',['id'=>$sv->lop_id])->withErrors(['passed'=>"Thêm thành công"]);   
    }

    function xuLyXoaDanhSachHangCho($id,$sv){
        $sv = HangCho::where('lop_id',$id)->where('tai_khoan_id',$sv)->first();
        $sv->delete();
        return redirect()->route('hang-cho',['id'=>$sv->lop_id])->withErrors(['passed'=>"Xóa thành công"]);   
    }
}
