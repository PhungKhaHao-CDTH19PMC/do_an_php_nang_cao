@extends('giao-vien.main')

@section('main-content')
<div class="content-wrapper">
            @error('failed')
              <div class="alert alert-danger">{{$message}}</div>
            @enderror
            <h4>Thêm lớp</h4>
            <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <form class="forms-sample" action="{{route('xl-them-lop-day')}}" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                        <label for="exampleInputUsername1">Tên lớp học</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Tên lớp " name="ten_lop" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1">Mã lớp</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Mã lớp"name="ma_lop"required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1">Hình ảnh</label>
                        <input type="file" class="form-control" id="exampleInputUsername1" name="hinh_anh"required>
                      </div>
                      <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
@endsection