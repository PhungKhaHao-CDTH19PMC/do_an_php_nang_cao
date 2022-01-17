
@extends('giao-vien.main')

@section('main-content')
<div class="content-wrapper">
            <div class="page-header">
            <h3 style="color:#007bff;" class="page-title"> Tên lớp: {{ $lop->ten_lop}} </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('chi-tiet-lop',['id' => $lop->id])}}">Mọi người</a></li>
                  <li class="breadcrumb-item active" aria-current="page"><a href="{{route('ds-bai-viet-giao-vien', ['id' => $lop->id])}}">Bài viết</a></li>
                  <li class="breadcrumb-item"><a href="{{route('hang-cho',['id' => $lop->id])}}">Hàng chờ</a></li>
                </ol>
              </nav>
            </div>
            @error('passed')
              <div class="alert alert-success">{{$message}}</div>
            @enderror
            @error('failed')
              <div class="alert alert-danger">{{$message}}</div>
            @enderror
          <table class="table table-image">
                <thead>
                  <tr>
                    <th scope="col">Họ tên</th>
                    <th scope="col">Ngày sinh</th>
                    <th scope="col">Email</th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                @forelse($sv as $ds)
                <tr>
                    <td>{{ $ds->ho_ten}}</td>
                    <td>{{ $ds->ngay_sinh}}</td>
                    <td>{{ $ds->email}}</td>
                    <td>{{ $ds->sdt}}</td>
                    <td><a href="{{route('xl-hang-cho',['id' => $lop->id,'idsv'=> $ds->id])}}">Thêm</a></td>  
                    <td><a href="{{route('xl-xoa-hang-cho',['id' => $lop->id,'idsv'=> $ds->id])}}">Xóa</a></td>           
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