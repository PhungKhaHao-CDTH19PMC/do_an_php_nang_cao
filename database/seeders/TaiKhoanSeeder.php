<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TaiKhoan;
use Illuminate\Support\Facades\Hash;

class TaiKhoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tk= new TaiKhoan();
        $tk->phan_quyen_id=2;
        $tk->username='giangvien';
        $tk->password=Hash::make('123456');
        $tk->ho_ten="adminstator";
        $tk->ngay_sinh='1900-01-01';
        $tk->email='giangvien@gmail.com';
        $tk->sdt='0123456789';
        $tk->hinh_anh='adminstator.jpg';
        $tk->save();

        $tk= new TaiKhoan();
        $tk->phan_quyen_id=1;
        $tk->username='sinhvien';
        $tk->password=Hash::make('123456');
        $tk->ho_ten="adminstator";
        $tk->ngay_sinh='1900-01-01';
        $tk->email='sinhvien@gmail.com';
        $tk->sdt='0123456789';
        $tk->hinh_anh='adminstator.jpg';
        $tk->save();

        $tk= new TaiKhoan();
        $tk->phan_quyen_id=3;
        $tk->username='admin';
        $tk->password=Hash::make('123456');
        $tk->ho_ten="adminstator";
        $tk->ngay_sinh='1900-01-01';
        $tk->email='adminstator@gmail.com';
        $tk->sdt='0123456789';
        $tk->hinh_anh='adminstator.jpg';
        $tk->save();
    }
}
