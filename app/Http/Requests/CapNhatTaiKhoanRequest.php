<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CapNhatTaiKhoanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ho_ten' => 'required',
            'ngay_sinh' => 'required',
            'email' => 'required|unique:tai_khoan,email,'.$this->id,
            'sdt' => 'required|regex:/^(0)[0-9]{9}$/',
            'hinh_anh' => 'mimes:jpg,jpeg,png,gif|max:2048',
        ];
    }
    public function messages()
    {
        return [
            'ho_ten.required' => 'Chưa nhập họ tên',
            'ngay_sinh.required' => 'Chưa nhập ngày sinh',
            'email.required' => 'Chưa nhập email',
            'email.unique' => 'Email đã tồn tại',
            'sdt.required' => 'Chưa nhập số điện thoại',
            'sdt.regex' => 'Số điện thoại sai định dạng',
            'hinh_anh.mimes' => 'Chỉ chấp nhận hình thẻ với đuôi .jpg .jpeg .png .gif',
			'hinh_anh.max' => 'Hình thẻ giới hạn dung lượng không quá 2M',
        ];
    }
}
