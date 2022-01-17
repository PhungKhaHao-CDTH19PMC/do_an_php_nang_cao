
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
            @error('failed')
              <div class="alert alert-danger">{{$message}}</div>
            @enderror
            @error('passed')
              <div class="alert alert-success">{{$message}}</div>
            @enderror
            @if (session('error'))
                <div class="alert alert-danger" style="color: black">
                  {{ session('error') }}
                </div>
            @endif  
            @if (session('thanhcong'))
                <div class="alert alert-success" style="color: black">
                  {{ session('thanhcong') }}
                </div>
            @endif  
            
            <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <form class="forms-sample" action="{{route('xl-them-sinh-vien',['id' => $lop->id])}}" method="post">
                      @csrf
                      <div class="form-group">
                        <label for="exampleInputUsername1">Email Sinh Viên</label>
                        <input  class="form-control" id="exampleInputUsername1" placeholder="email " name="email">
                      </div>
                      <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
        </form>
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
                @forelse($lop->chiTiet as $ds)
                <tr>
                    <td>{{ $ds->id}}</td>
                    <td>{{ $ds->ho_ten}}</td>
                    <td>{{ $ds->ngay_sinh}}</td>
                    <td>{{ $ds->email}}</td>
                    <td>{{ $ds->sdt}}</td>
                    <td><a href="{{route('xoa-sinh-vien',['id' => $ds->id,'idlop' => $lop->id])}}">Xóa</a></td>  
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

@section('search')
<form action="{{route('tim-kiem-sinh-vien',['id' => $lop->id])}}">
  @csrf
<div class="input-group">
  <input type="text" class="form-control" name="email" placeholder="Nhập email sinh viên">
  <div class="input-group-append">
    <button class="btn btn-secondary" type="submit">Search</button>
  </div>
</div>
</form>
@endsection