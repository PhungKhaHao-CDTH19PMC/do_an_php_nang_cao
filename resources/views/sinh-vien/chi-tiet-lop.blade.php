
@extends('sinh-vien.main')

@section('main-content')
<div class="content-wrapper">
            <div class="page-header">
              <h3 style="color:#007bff;" class="page-title"> Tên lớp: {{ $lop->ten_lop}} </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('chi-tiet-lop',['id' => $lop->id])}}">Mọi người</a></li>
                  <li class="breadcrumb-item active" aria-current="page"><a href="{{route('ds-bai-viet-giao-vien', ['id' => $lop->id])}}">Bài viết</a></li>
                </ol>
              </nav>
            </div>
            @error('failed')
              <div class="alert alert-danger">{{$message}}</div>
            @enderror
            @error('passed')
              <div class="alert alert-success">{{$message}}</div>
            @enderror
        <h4>Giảng viên</h4>
        <table class="table">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Họ tên</th>
                    <th scope="col">Ngày sinh</th>
                    <th scope="col">Email</th>
                    <th scope="col">Số điện thoại</th>
                  </tr>
                </thead>
                <tbody>
                <tr>
                    @php
                      $gv= App\Models\TaiKhoan::find($lop->tai_khoan_id);
                    @endphp
                    <td>{{ $gv->id}}</td>
                    <td>{{ $gv->ho_ten}}</td>
                    <td>{{ $gv->ngay_sinh}}</td>
                    <td>{{ $gv->email}}</td>
                    <td>{{ $gv->sdt}}</td>
                </tr>
                </tbody>
              </table>
              <br/>
          <h4>Sinh viên</h4>
          <table class="table">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Họ tên</th>
                    <th scope="col">Ngày sinh</th>
                    <th scope="col">Email</th>
                    <th scope="col">Số điện thoại</th>
                  </tr>
                </thead>
                <tbody>
                @forelse($lop->chiTiet as $ds)
                <tr>
                    <td>{{ $ds->id}}</td>
                    <td>{{ $ds->ho_ten}}</td>
                    <td>{{ $ds->ngay_sinh}}</td>
                    <td>{{ $ds->email}}</td>
                    <td>{{ $ds->sdt}}</td>
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