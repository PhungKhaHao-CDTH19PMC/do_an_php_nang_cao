<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\TaiKhoan;
class EmailController extends Controller
{
    public function create($id)
    {
      $tk=TaiKhoan::find($id);
        return view('email', compact('tk'));
    }

    public function sendEmail(Request $request,$id)
    {
      $tk=TaiKhoan::find($id);
      
        $request->validate([
          'email' => 'required|email',
          'subject' => 'required',
          'name' => 'required',
          'content' => 'required',
        ]);

        $data = [
          'subject' => $request->subject,
          'name' => $request->name,
          'email' => $request->email,
          'content' => $request->content
        ];

        Mail::send('email-template', $data, function($message) use ($data) {
          $message->to($data['email'])->subject($data['subject']);
          $message->from($data['email'],$data['name']);
        });

        return back()->with(['message' => 'Email successfully sent!']);
    }
}