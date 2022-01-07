<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\TaiKhoan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class MailController extends Controller
{
    public function guiMail()
    {
        return view('gui-mail');
    }
    public function updateNewPass()
    {
        return view('reset-pass');
    }
    public function recoverPass(Request $request )
    {
        $data = $request->all();
        $now=Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $title_email="Lấy lại mật khẩu Elearning".' ' .$now;
        
        $token_random=Str::random(40);
        $taikhoan=TaiKhoan::where('email','=',$data['email'])->first();
        if($taikhoan==null) 
        {
            return redirect()->back()->with('error','Email chưa được đăng kí!!');
        }
            else{
                $id=$taikhoan->id;
                $token_random=Str::random(40);
                $taikhoan=TaiKhoan::find($id);
                $taikhoan->token=$token_random;
                $taikhoan->save();
                //send email notification
                $to_email=$taikhoan->email;//gui den email nay 
                $link_reset_password=url('/update-new-pass?email='.$to_email.'&token='.$token_random);
                $data=array("name"=>$title_email,"body"=>$link_reset_password,'email'=>$data['email'],"hoten"=>$taikhoan->ho_ten);//body email
                Mail::send('forgot-pass',['data'=>$data],function($message)use ($title_email,$data){
                    $message->to($data['email'])->subject($title_email);
                    $message->from($data['email'],"Elearning");
                });
                return redirect()->back()->with('message','Gửi thành công! Vui lòng kiểm tra email để đặt lại mật khẩu.');
            }
        } 
       


 public function resetNewPass(Request $request)
 {
     $data = $request->all();
     $token_random=Str::random(40);
     
    $taikhoan=TaiKhoan::where('email',$data['email'])->where('token',$data['token'])->first();  
     
    if($taikhoan!=null) 
    {
    $id=$taikhoan->id;
     $reset=TaiKhoan::find($id);
     $reset->password=Hash::make($data['password']);
     $reset->token=$token_random;
     $reset->save();
     return redirect('dang-nhap')->with('message','Mật khẩu cập nhật thành công');
    }else{
       return redirect('gui-mail')->with('error','Đổi mật khẩu không thành công vì email đã hết hạn!!!');
    }
 }
 public function sendEmailAd(Request $request,$id)
 {
 }
}