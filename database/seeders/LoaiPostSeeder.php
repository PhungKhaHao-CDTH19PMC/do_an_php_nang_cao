<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LoaiPost;

class LoaiPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pq1= new LoaiPost();
        $pq1->loai_post='thông báo';
        $pq1->save();

        $pq2= new LoaiPost();
        $pq2->loai_post='bài tập';
        $pq2->save();

        $pq3= new LoaiPost();
        $pq3->loai_post='bài kiểm tra';
        $pq3->save();

        $pq4= new LoaiPost();
        $pq4->loai_post='bài thi';
        $pq4->save();

        $pq5= new LoaiPost();
        $pq5->loai_post='tài liệu';
        $pq5->save();
    }
}
