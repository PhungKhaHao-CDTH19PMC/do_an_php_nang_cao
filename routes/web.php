<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaiKhoanController;
use App\Http\Controllers\LopController;
use App\Http\Controllers\ThamGiaController;
use App\Http\Controllers\DangNhapController;
use App\Http\Controllers\DangKiController;
use App\Http\Controllers\DanhSachLopHocController;
use App\Http\Controllers\DangXuatController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\EmailController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('dang-nhap');
});

Route::get('/dang-nhap',[TaiKhoanController::class, 'dangNhap'])->name('dang-nhap');
Route::post('/dang-nhap',[TaiKhoanController::class, 'xuLyDangNhap'])->name('xl-dang-nhap');
Route::get('/dang-ki',[TaiKhoanController::class, 'dangKi'])->name('dang-ki');

Route::post('/dang-ki',[TaiKhoanController::class, 'xuLyDangKi'])->name('xl-dang-ki');
Route::get('/dang-xuat',[TaiKhoanController::class, 'dangXuat'])->name('dang-xuat');
//reset pass
Route::get('/gui-mail',[MailController::class, 'guiMail'])->name('gui-mail');
Route::post('/revover-pass',[MailController::class, 'recoverPass'])->name('recover-pass');
Route::get('/update-new-pass',[MailController::class, 'updateNewPass'])->name('update-new-pass');
Route::post('/reset-new-pass',[MailController::class, 'resetNewPass'])->name('reset-new-pass');
//gửi mail
Route::get('/email/{id}', [EmailController::class, 'create']);
Route::post('/email/{id}', [EmailController::class, 'sendEmail'])->name('send.email');

Route::middleware('auth')->group(function(){
    Route::get('/tai-khoan/cap-nhat/{id}',[TaiKhoanController::class, 'formCapNhatTaiKhoan'])->name('cap-nhat-tai-khoan');
    Route::post('/tai_khoan/cap-nhat/{id}',[TaiKhoanController::class, 'capNhatTaiKhoan'])->name('xl-cap-nhat-tai-khoan');
    Route::get('/tai-khoan/dat-lai/{id}',[TaiKhoanController::class, 'formDatLaiMatKhau'])->name('dat-lai-mat-khau');
    Route::post('/tai_khoan/dat-lai/{id}',[TaiKhoanController::class, 'datLaiMatKhau'])->name('xl-dat-lai-mat-khau');
    Route::get('/chi-tiet-lop/{id}',[LopController::class, 'chiTietLop'])->name('chi-tiet-lop');
    Route::get('/bai-viet/lop',[PostController::class, 'layDanhSach'])->name('ds-bai-viet');
    Route::get('/bai-viet-giao-vien/lop/{id}',[PostController::class, 'layDSTrangGiaoVien'])->name('ds-bai-viet-giao-vien');
    Route::get('/binh-luan/{id}',[PostController::class, 'layDanhSachBinhLuan'])->name('ds-binh-luan');
    Route::get('/tao-binh-luan/lop/{id}',[PostController::class, 'taoBinhLuan'])->name('tao-binh-luan');
    Route::post('/tao-binh-luan/lop/{id}',[PostController::class, 'xuLyTaoBinhLuan'])->name('xl-tao-binh-luan');
    Route::get('/cap-nhat/binh-luan/{id}',[PostController::class, 'formCapNhatBinhLuan'])->name('cap-nhat-binh-luan');
    Route::post('/cap-nhat/binh-luan/{id}',[PostController::class, 'capNhatBinhLuan'])->name('xl-cap-nhat-binh-luan');
    Route::get('/xoa/binh-luan/{id}',[PostController::class, 'formXoaBinhLuan'])->name('xoa-binh-luan');
    Route::post('/xoa/binh-luan/{id}',[PostController::class, 'xoaBinhLuan'])->name('xl-xoa-binh-luan');
});


Route::group(['middleware' => ['auth','sinhvien']], function () {
    Route::get('/danh-sach-lop-hoc',[TaiKhoanController::class, 'dsLopHoc'])->name('ds-lop-hoc');
    Route::post('/sinh-vien/them-lop',[ThamGiaController::class, 'xuLyHangCho'])->name('xl-them-lop-hoc');
    Route::get('/sinh-vien/lop/roi-khoi/{id}',[TaiKhoanController::class, 'formXoaLophoc'])->name('roi-khoi-lop');
    Route::post('/sinh-vien/lop/roi-khoi/{id}',[TaiKhoanController::class, 'xoaLophoc'])->name('xl-roi-khoi-lop');
    Route::get('/sinh-vien/nop-bai/{id}',[PostController::class, 'NopBai'])->name('form-nop-bai');
    Route::post('/sinh-vien/nop-bai/{id}',[PostController::class, 'xuLyNopBai'])->name('xl-nop-bai');

    
});

Route::group(['middleware' => ['auth','giaovien']], function () {
    Route::get('/danh-sach-lop-day',[LopController::class, 'layDanhSach'])->name('ds-lop-day');
    Route::get('/giao-vien/lop/cap-nhat/{id}',[LopController::class, 'formCapNhatLop'])->name('cap-nhat-lop');
    Route::post('/giao-vien/lop/cap-nhat/{id}',[LopController::class, 'capNhatLop'])->name('xl-cap-nhat-lop');
    Route::get('/giao-vien/lop/xoa/{id}',[LopController::class, 'formXoaLop'])->name('xoa-lop');
    Route::post('/giao-vien/lop/xoa/{id}',[LopController::class, 'xoaLop'])->name('xl-xoa-lop');
    Route::get('/giao-vien/them-lop',[LopController::class, 'themLop'])->name('them-lop');
    Route::post('/giao-vien/them-lop',[LopController::class, 'xuLyThemLop'])->name('xl-them-lop-day');
    Route::get('/giao-vien/xoa-sinh-vien/{id}/{idlop}',[TaiKhoanController::class, 'formXoaSinhVien'])->name('xoa-sinh-vien');
    Route::post('/giao-vien/xoa-sinh-vien/{id}/{idlop}',[TaiKhoanController::class, 'xoaSinhVien'])->name('xl-xoa-sinh-vien');
    Route::get('/giao-vien/xet-duyet/{id}',[ThamGiaController::class, 'layDanhSachHangCho'])->name('hang-cho');
    Route::get('/giao-vien/them-sinh-vien/{id}/{idsv}',[ThamGiaController::class, 'xuLyDanhSachHangCho'])->name('xl-hang-cho');
    Route::get('/giao-vien/xoa-hang-cho/{id}/{idsv}',[ThamGiaController::class, 'xuLyXoaDanhSachHangCho'])->name('xl-xoa-hang-cho');
    Route::post('/giao-vien/tim-kiem-post/{id}',[PostController::class, 'timKiemPost'])->name('tim-kiem-post');
    Route::get('/giao-vien/tim-kiem-sinh-vien/{id}',[TaiKhoanController::class, 'timKiemSinhVien'])->name('tim-kiem-sinh-vien');
    Route::get('/tao-bai-viet/lop/{id}',[PostController::class, 'taoBaiViet'])->name('tao-bai-viet');
    Route::post('/tao-bai-viet/lop/{id}',[PostController::class, 'xuLyTaoBaiViet'])->name('xl-tao-bai-viet');
    Route::get('/giang-vien/cap-nhat/bai-viet/{id}',[PostController::class, 'formCapNhatBaiViet'])->name('cap-nhat-bai-viet');
    Route::post('/giang-vien/cap-nhat/bai-viet/{id}',[PostController::class, 'capNhatBaiViet'])->name('xl-cap-nhat-bai-viet');
    Route::get('/giang-vien/xoa/bai-viet/{id}',[PostController::class, 'formXoaBaiViet'])->name('xoa-bai-viet');
    Route::post('/giang-vien/xoa/bai-viet/{id}',[PostController::class, 'xoaBaiViet'])->name('xl-xoa-bai-viet');
    Route::get('/danh-sach/nop-bai/{id}',[PostController::class, 'dsNopBai'])->name('ds-nop-bai');
});

Route::group(['middleware' => ['auth','both']], function () {
    Route::post('/giao-vien/them/sinh-vien/{id}',[ThamGiaController::class, 'xuLyThemHocSinh'])->name('xl-them-sinh-vien');
});

Route::group(['middleware' => ['auth','quantrivien']], function () {
    Route::get('/danh-sach-lop',[LopController::class, 'layTatCaLop'])->name('ds-lop');
    Route::get('/tao-tai-khoan',[TaiKhoanController::class, 'taoTaiKhoan'])->name('tao-tai-khoan');
    Route::post('/tao-tai-khoan',[TaiKhoanController::class, 'xuLyTaoTaiKhoan'])->name('xl-tao-tai-khoan');
    Route::get('/danh-sach-tai-khoan',[TaiKhoanController::class, 'dsTaiKhoan'])->name('ds-tai-khoan');
    Route::get('/tai-khoan-qtv/cap-nhat/{id}',[TaiKhoanController::class, 'formCapNhatTaiKhoanQtv'])->name('cap-nhat-tai-khoan-qtv');
    Route::post('/tai_khoan-qtv/cap-nhat/{id}',[TaiKhoanController::class, 'capNhatTaiKhoanQtv'])->name('xl-cap-nhat-tai-khoan-qtv');
    Route::get('/tai-khoan-qtv/xoa/{id}',[TaiKhoanController::class, 'formXoaTaiKhoan'])->name('xoa-tai-khoan');
    Route::post('/tai_khoan-qtv/xoa/{id}',[TaiKhoanController::class, 'xoaTaiKhoan'])->name('xl-xoa-tai-khoan');
});
