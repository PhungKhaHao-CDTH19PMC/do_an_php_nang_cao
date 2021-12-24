<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PhanQuyen;

class PhanQuyenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pq1= new PhanQuyen();
        $pq1->loai_nguoi_dung='Sinh Viên';
        $pq1->save();

        $pq2= new PhanQuyen();
        $pq2->loai_nguoi_dung='Giáo viên';
        $pq2->save();

        $pq3= new PhanQuyen();
        $pq3->loai_nguoi_dung='Quản trị viên';
        $pq3->save();
    }
}
