
@extends('giao-vien.main')

@section('main-content')
<div class="content-wrapper">
          <table class="table">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Họ tên</th>
                    <th scope="col">Ngày sinh</th>
                    <th scope="col">Email</th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{ $sv->id}}</td>
                    <td>{{ $sv->ho_ten}}</td>
                    <td>{{ $sv->ngay_sinh}}</td>
                    <td>{{ $sv->email}}</td>
                    <td>{{ $sv->sdt}}</td>
                    <td><a href="{{route('xoa-sinh-vien',['id' => $sv->id,'idlop' => $lop->id])}}">Xóa</a></td>  
                </tr>
                </tbody>
              </table>
              </div>
@endsection
