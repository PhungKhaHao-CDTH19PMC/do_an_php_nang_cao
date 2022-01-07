
@extends('quan-tri-vien.main')

@section('main-content')
<div class="content-wrapper">
            @error('passed')
              <div class="alert alert-success">{{$message}}</div>
            @enderror
            @error('failed')
              <div class="alert alert-danger">{{$message}}</div>
            @enderror
            <h4>Danh sách tài khoản</h4>
          <table class="table table-image">
                <thead>
                  <tr>
                    <th scope="col">Hình ảnh </th>
                    <th scope="col">Họ tên</th>
                    <th scope="col">Ngày sinh</th>
                    <th scope="col">Email</th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col">Chức vụ</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    
                  </tr>
                </thead>
                <tbody>
                @forelse($ds as $ds)
                <tr>
                    <td><img src="images/{{$ds->hinh_anh}}" style="width:50px; height:50px"></img></td> 
                    <td>{{ $ds->ho_ten}}</td>
                    <td>{{ $ds->ngay_sinh}}</td>
                    <td>{{ $ds->email}}</td>
                    <td>{{ $ds->sdt}}</td>
                    <td>{{ $ds->phanQuyen->loai_nguoi_dung}}</td>
                    <td><a href="{{ route('send.email',['id' => $ds->id])}}">Gửi mail</a></td>
                    <td><a href="{{route('cap-nhat-tai-khoan-qtv',['id' => $ds->id])}}">Cập nhật</a></td>
                    <td><a href="{{route('xoa-tai-khoan',['id' => $ds->id])}}">Xóa</a></td>  
                              
                </tr>
                @empty
                <tr>
                    <td colspan="2">Không có dữ liệu</td>
                </tr>
                @endforelse
                </tbody>
              </table>
</div>
@endsection