<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TaiKhoanRequest;
use App\Http\Requests\DangNhapRequest;
use App\Http\Requests\CapNhatTaiKhoanRequest;

use Illuminate\Support\Facades\Auth;
use App\Models\TaiKhoan;
use App\Models\ThamGia;
use App\Models\PhanQuyen;
use App\Models\Lop;
use Illuminate\Support\Facades\Hash;

class TaiKhoanController extends Controller
{
    public function dangNhap()
    {
        return view('dang-nhap');
    }

    public function xuLyDangNhap(DangNhapRequest $request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            if(auth()->user()->phan_quyen_id==1)
            {
                return redirect()->route('ds-lop-hoc');
            }
            elseif(auth()->user()->phan_quyen_id==2){
                return redirect()->route('ds-lop-day');
            }
            else{
                return redirect()->route('ds-lop');
            }
        }
        return back()->withErrors(['failed'=>"Vui lòng kiểm tra lại Username/password"]);
    }

    public function dangXuat()
    {
        Auth::logout();
        return redirect()->route('dang-nhap');
    }

    public function dangKi()
    {
        return view('dang-ki');
    }

    public function xuLyDangKi(TaiKhoanRequest $request)
    {
        $tk= new TaiKhoan();
      
        if($request->radio == "giangvien")
        {
            $tk->phan_quyen_id=2;
        }
        if($request->radio == "sinhvien")
        {
            $tk->phan_quyen_id=1;
        }
        
        $tk->username=$request->username;
        $tk->password=Hash::make($request->password);
        $tk->ho_ten=$request->ho_ten;
        $tk->ngay_sinh=$request->ngay_sinh;
        $tk->email=$request->email;
        $tk->sdt=$request->sdt;
        
        $image = $request->file('hinh_anh');
        $ex=  $request->file('hinh_anh')->extension();
        $file_name= time() . '.'.$ex;
        $storedPath = $image->storeAs('images', $file_name);
        $tk->hinh_anh=$file_name;
        $tk->save();
        return back()->withErrors(['passed'=>"Đăng kí thành công"]);
        
    }

    public function formCapNhatTaiKhoan($id)
    {
        $tk=TaiKhoan::find($id);
        if($tk==null)
        {
            if(auth()->user()->phan_quyen_id==1)
            {
                return redirect()->route('ds-lop-hoc')->withErrors(['failed'=>"không tìm thấy tài khoản này"]);
            }
            elseif(auth()->user()->phan_quyen_id==2){
                return redirect()->route('ds-lop-day')->withErrors(['failed'=>"không tìm thấy tài khoản này"]);
            }
            else{
                return redirect()->route('ds-lop')->withErrors(['failed'=>"không tìm thấy tài khoản này"]);
            }
        }
        if($tk->id !=auth()->user()->id)
        {
            if(auth()->user()->phan_quyen_id==1)
            {
                return redirect()->route('ds-lop-hoc')->withErrors(['failed'=>"Vui lòng không cập nhật thông tin tài khoản khác"]);
            }
            elseif(auth()->user()->phan_quyen_id==2){
                return redirect()->route('ds-lop-day')->withErrors(['failed'=>"Vui lòng không cập nhật thông tin tài khoản khác"]);
            }
            else{
                return redirect()->route('ds-lop')->withErrors(['failed'=>"Vui lòng không cập nhật thông tin tài khoản khác"]);
            }
        }
        if(auth()->user()->phan_quyen_id==1)
        {
            return view('sinh-vien/cap-nhat-tai-khoan', compact('tk'));
        }
        elseif(auth()->user()->phan_quyen_id==2){
            return view('giao-vien/cap-nhat-tai-khoan', compact('tk'));
        }
        else{
            return view('quan-tri-vien/cap-nhat-tai-khoan', compact('tk'));
        }
            
    }
    public function capNhatTaiKhoan(CapNhatTaiKhoanRequest $req,$id)
    {
        $tk=TaiKhoan::find($id);
        if($tk==null)
        {
            if(auth()->user()->phan_quyen_id==1)
            {
                return redirect()->route('ds-lop-hoc')->withErrors(['failed'=>"không tìm thấy tài khoản này"]);
            }
            elseif(auth()->user()->phan_quyen_id==2){
                return redirect()->route('ds-lop-day')->withErrors(['failed'=>"không tìm thấy tài khoản này"]);
            }
            else{
                return redirect()->route('ds-lop')->withErrors(['failed'=>"không tìm thấy tài khoản này"]);
            }
        }
        if($tk->id !=auth()->user()->id)
        {
            if(auth()->user()->phan_quyen_id==1)
            {
                return redirect()->route('ds-lop-hoc')->withErrors(['failed'=>"Vui lòng không cập nhật thông tin tài khoản khác"]);
            }
            elseif(auth()->user()->phan_quyen_id==2){
                return redirect()->route('ds-lop-day')->withErrors(['failed'=>"Vui lòng không cập nhật thông tin tài khoản khác"]);
            }
            else{
                return redirect()->route('ds-lop')->withErrors(['failed'=>"Vui lòng không cập nhật thông tin tài khoản khác"]);
            }
        }
        if ($req->hasFile('hinh_anh')) {
            $image = $req->file('hinh_anh');
            $ex=  $req->file('hinh_anh')->extension();
            $file_name= time() . '.'.$ex;
            $storedPath = $image->storeAs('images', $file_name);
            $tk->ho_ten= $req->ho_ten;
            $tk->ngay_sinh= $req->ngay_sinh;
            $tk->email= $req->email;
            $tk->sdt= $req->sdt;
            $tk->hinh_anh=$file_name;
            $tk->save();
        }
        else{
            $tk->ho_ten= $req->ho_ten;
            $tk->ngay_sinh= $req->ngay_sinh;
            $tk->email= $req->email;
            $tk->sdt= $req->sdt;
            $tk->save();
        }
        return back()->withErrors(['passed'=>"Cập nhật thành công"]);
    }

    public function taoTaiKhoan()
    {
        $dsquyen= PhanQuyen::all();
        return view('quan-tri-vien/tao-tai-khoan', compact('dsquyen'));
    }

    public function xuLyTaoTaiKhoan(TaiKhoanRequest $request)
    {
        $tk= new TaiKhoan();
        $tk->phan_quyen_id=$request->phan_quyen;
        $tk->username=$request->username;
        $tk->password=Hash::make($request->password);
        $tk->ho_ten=$request->ho_ten;
        $tk->ngay_sinh=$request->ngay_sinh;
        $tk->email=$request->email;
        $tk->sdt=$request->sdt;
        
        $image = $request->file('hinh_anh');
        $ex=  $request->file('hinh_anh')->extension();
        $file_name= time() . '.'.$ex;
        $storedPath = $image->storeAs('images', $file_name);
        $tk->hinh_anh=$file_name;

        $tk->save();
        return back()->withErrors(['passed'=>"Đăng kí thành công"]);
        
    }

    public function formDatLaiMatKhau($id)
    {
        $tk=TaiKhoan::find($id);
        if($tk==null)
        {
            if(auth()->user()->phan_quyen_id==1)
            {
                return redirect()->route('ds-lop-hoc')->withErrors(['failed'=>"không tìm thấy tài khoản này"]);
            }
            elseif(auth()->user()->phan_quyen_id==2){
                return redirect()->route('ds-lop-day')->withErrors(['failed'=>"không tìm thấy tài khoản này"]);
            }
            else{
                return redirect()->route('ds-lop')->withErrors(['failed'=>"không tìm thấy tài khoản này"]);
            }
        }
        if($tk->id !=auth()->user()->id)
        {
            if(auth()->user()->phan_quyen_id==1)
            {
                return redirect()->route('ds-lop-hoc')->withErrors(['failed'=>"Vui lòng không cập nhật thông tin tài khoản khác"]);
            }
            elseif(auth()->user()->phan_quyen_id==2){
                return redirect()->route('ds-lop-day')->withErrors(['failed'=>"Vui lòng không cập nhật thông tin tài khoản khác"]);
            }
            else{
                return redirect()->route('ds-lop')->withErrors(['failed'=>"Vui lòng không cập nhật thông tin tài khoản khác"]);
            }
        }
        if(auth()->user()->phan_quyen_id==1)
        {
            return view('sinh-vien/dat-lai-mat-khau', compact('tk'));
        }
        elseif(auth()->user()->phan_quyen_id==2){
            return view('giao-vien/dat-lai-mat-khau', compact('tk'));
        }
        else{
            return view('quan-tri-vien/dat-lai-mat-khau', compact('tk'));
        }
            
    }
    public function datLaiMatKhau(request $req,$id)
    {
        $tk=TaiKhoan::find($id);
        if($tk==null)
        {
            if(auth()->user()->phan_quyen_id==1)
            {
                return redirect()->route('ds-lop-hoc')->withErrors(['failed'=>"không tìm thấy tài khoản này"]);
            }
            elseif(auth()->user()->phan_quyen_id==2){
                return redirect()->route('ds-lop-day')->withErrors(['failed'=>"không tìm thấy tài khoản này"]);
            }
            else{
                return redirect()->route('ds-lop')->withErrors(['failed'=>"không tìm thấy tài khoản này"]);
            }
        }
        if($tk->id !=auth()->user()->id)
        {
            if(auth()->user()->phan_quyen_id==1)
            {
                return redirect()->route('ds-lop-hoc')->withErrors(['failed'=>"Vui lòng không cập nhật thông tin tài khoản khác"]);
            }
            elseif(auth()->user()->phan_quyen_id==2){
                return redirect()->route('ds-lop-day')->withErrors(['failed'=>"Vui lòng không cập nhật thông tin tài khoản khác"]);
            }
            else{
                return redirect()->route('ds-lop')->withErrors(['failed'=>"Vui lòng không cập nhật thông tin tài khoản khác"]);
            }
        }
        if(!Hash::check($req->password,auth()->user()->password))
        {
            return back()->withErrors(['failed'=>"Mật khẩu sai! Hãy nhập lại"]);
        }
        elseif($req->mat_khau_moi!=$req->nhap_lai)
        {
            return back()->withErrors(['failed'=>"Mật khẩu không trùng khớp! Hãy nhập lại"]);
        }
        $tk->password= Hash::make($req->mat_khau_moi);
        $tk->save();
        return back()->withErrors(['passed'=>"Cập nhật mật khẩu thành công"]);
    }

    public function dsLopHoc()
    {
        $sinhVien=TaiKhoan::find(auth()->user()->id);
        return view('sinh-vien/danh-sach-lop-hoc', compact('sinhVien'));
    }

    public function formXoaLophoc($id)
    {
        
        $lop=Lop::find($id);
        if($lop==null)
        {
            return redirect()->route('ds-lop-hoc')->withErrors(['failed'=>"Không tìm thấy lớp này"]);
        }
        $kt=ThamGia::where('tai_khoan_id',auth()->user()->id)->where('lop_id',$lop->id)->first();
        if($kt)
        {
            return view('sinh-vien/xoa-lop', compact('lop'));
        }
        return redirect()->route('ds-lop-hoc')->withErrors(['failed'=>"Bạn không phải thành viên của lớp"]);
    }
    
    function xoaLophoc($id)
    {
        $lop=Lop::find($id);
        if($lop==null)
        {
            return redirect()->route('ds-lop-hoc')->withErrors(['failed'=>"Không tìm thấy lớp này"]);
        }
        $kt=ThamGia::where('tai_khoan_id',auth()->user()->id)->where('lop_id',$lop->id)->first();
        if($kt)
        {
            $kt->delete();
            return redirect()->route('ds-lop-hoc')->withErrors(['passed'=>"Đã rời khỏi lớp học"]);
        }
        return redirect()->route('ds-lop-hoc')->withErrors(['failed'=>"Bạn không phải thành viên của lớp"]);
    }
    
    public function dsTaiKhoan()
    {
        $ds=TaiKhoan::where('id','!=', auth()->user()->id)->get();
        return view('quan-tri-vien/danh-sach-tai-khoan', compact('ds'));
    }

    public function formCapNhatTaiKhoanQtv($id)
    {
        $quyen=PhanQuyen::all();
        $tk=TaiKhoan::find($id);
        if($tk==null)
        {
            return redirect()->route('ds-tai-khoan')->withErrors(['failed'=>"Không tìm thấy tài khoản này"]);
        }
        return view('quan-tri-vien/cap-nhat-tai-khoan-qtv', compact('tk','quyen'));     
    }

    public function capNhatTaiKhoanQtv(CapNhatTaiKhoanRequest $req,$id)
    {
        $tk=TaiKhoan::find($id);
        if($tk==null)
        {
            return back()->route('ds-tai-khoan')->withErrors(['failed'=>"Không tìm thấy tài khoản này"]);
        }
        $tk->phan_quyen_id= $req->phan_quyen;
        $tk->ho_ten= $req->ho_ten;
        $tk->ngay_sinh= $req->ngay_sinh;
        $tk->email= $req->email;
        $tk->sdt= $req->sdt;
        $tk->save();
        return redirect()->route('ds-tai-khoan')->withErrors(['passed'=>"Cập nhật thành công"]);
    }
    public function formXoaTaiKhoan($id)
    {
        $quyen=PhanQuyen::all();
        $tk=TaiKhoan::find($id);
        if($tk==null)
        {
            return redirect()->route('ds-tai-khoan')->withErrors(['failed'=>"Không tìm thấy tài khoản này"]);
        }
        return view('quan-tri-vien/xoa-tai-khoan', compact('tk','quyen'));     
    }

    public function xoaTaiKhoan(request $req,$id)
    {
        $tk=TaiKhoan::find($id);
        if($tk==null)
        {
            return redirect()->route('ds-tai-khoan')->withErrors(['failed'=>"Không tìm thấy tài khoản này"]);
        }
        $tg=ThamGia::where('tai_khoan_id',$tk->id)->get();
        if($tg)
        {
            $tg=ThamGia::where('tai_khoan_id',$tk->id)->delete();
        }
        $lop=Lop::where('tai_khoan_id',$tk->id)->get();
        if($lop)
        {
            $lop=Lop::where('tai_khoan_id',$tk->id)->delete();
        }
        $tk->delete();
        return redirect()->route('ds-tai-khoan')->withErrors(['passed'=>"Xóa thành công"]);
    }
    public function formXoaSinhVien($id,$idlop)
    {
        $tk=TaiKhoan::find($id);
        if($tk==null)
        {
            return redirect()->route('ds-lop-day')->withErrors(['failed'=>"Không tìm thấy tài khoản này"]);
        }
        $lop=Lop::find($idlop);
        if($lop==null)
        {
            return redirect()->route('ds-lop-day')->withErrors(['failed'=>"Không tìm thấy lớp này"]);
        }
        if(auth()->user()->id!=$lop->tai_khoan_id)
        {
            return redirect()->route('ds-lop-day')->withErrors(['failed'=>"Đây không phải lớp bạn giảng dạy"]);
        }
        $tg=ThamGia::where('tai_khoan_id',$tk->id)->where('lop_id',$idlop)->first();
        if($tg)
        {
            return view('giao-vien/xoa-sinh-vien', compact('tk','lop'));  
        }
        return redirect()->route('chi-tiet-lop', ['id'=>$lop->id])->withErrors(['failed'=>"Sinh viên không học tại lớp"]);
    }

    public function xoaSinhVien($id,$idlop)
    {
        $tk=TaiKhoan::find($id);
        if($tk==null)
        {
            return redirect()->route('ds-lop-day')->withErrors(['failed'=>"Không tìm thấy tài khoản này"]);
        }
        $lop=Lop::find($idlop);
        if($lop==null)
        {
            return redirect()->route('ds-lop-day')->withErrors(['failed'=>"Không tìm thấy lớp này"]);
        }
        if(auth()->user()->id!=$lop->tai_khoan_id)
        {
            return redirect()->route('ds-lop-day')->withErrors(['failed'=>"Đây không phải lớp bạn giảng dạy"]);
        }
        $tg=ThamGia::where('tai_khoan_id',$tk->id)->where('lop_id',$idlop)->first();
        if($tg)
        {
            $tg->delete();
            return redirect()->route('chi-tiet-lop', ['id'=>$lop->id])->withErrors(['passed'=>"Xóa thành công"]);
        }
        return redirect()->route('chi-tiet-lop', ['id'=>$lop->id])->withErrors(['failed'=>"Sinh viên không học tại lớp"]);
    }
    public function timKiemSinhVien(Request $request,$id)
    {
        $lop=Lop::find($id);
        if($lop==null)
        {
            return back()->withErrors(['failed'=>"Lớp không tồn tại"]);
        }
        $sv = TaiKhoan::where('email', $request->email)->first();
        if($sv==null)
        {
            return back()->withErrors(['failed'=>"Email sinh viên không tồn tại"]);
        }
        if($sv->phan_quyen_id==2||$sv->phan_quyen_id==3)
        {
            return back()->withErrors(['failed'=>"Đây không phải email sinh viên"]);
        }
        $tg= ThamGia::where('tai_khoan_id',$sv->id)->where('lop_id',$lop->id)->first();
        if($tg==null)
        {
            return back()->withErrors(['failed'=>"Sinh viên không học tại lớp"]);
        }
        return view('giao-vien/search-sinh-vien', compact('sv','lop'));
    }
}
