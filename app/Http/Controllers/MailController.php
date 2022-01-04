<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\TaiKhoan;
class MailController extends Controller
{
    public function guiMail()
    {
        return view('gui-mail');
    }
    public function recoverPass(Request $request )
    {
        $data = $request->all();
        $now=Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
        $title_email="Lấy lại mật khẩu Elearning".' ' .$now;
        $token_random=Str::random(10);
        $taikhoan=TaiKhoan::where('email','=',$data['email'])->get();
        foreach($taikhoan as $key => $value)
        {
            $id=$value->id;
        }
        if($taikhoan)
        {
            $count_user=$taikhoan->count();
            if($count_user==0){
                return redirect()->back()->with('error','Email chưa được đăng kí!!');
            }else{
                $token_random=Str::random(10);
                $taikhoan=TaiKhoan::find($id);
                $taikhoan->token=$token_random;
                $taikhoan->save();
                //send email notification
                $to_email=$data['email'];//gui den email nay 
                $link_reset_password=url('/update-new-pass?email='.$to_email.'&token='.$token_random);
                $data=array("name"=>$title_email,"body"=>$link_reset_password,'email'=>$data['email']);//body email
                Mail::send('forgot-pass',['data'=>$data],function($message)use ($title_email,$data){
                    $message->to($data['email'])->subject($title_email);
                    $message->from($data['email'],$title_email);
                });
                return redirect()->back()->with('message','Gửi thành công! Vui lòng kiểm tra email để đặt lại mật khẩu.');
            }
        }
       
}
// public function updateNewPass(Request $request)
// {

// }
}