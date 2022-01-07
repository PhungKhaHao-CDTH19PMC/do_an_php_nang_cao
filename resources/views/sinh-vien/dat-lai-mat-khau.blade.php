@extends('sinh-vien.main')

@section('main-content')
<div class="content-wrapper">

            @error('failed')
              <div class="alert alert-danger">{{$message}}</div>
            @enderror
            @error('passed')
              <div class="alert alert-success">{{$message}}</div>
            @enderror
            <h4>Đặt lại mật khẩu</h4>

            <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <form class="forms-sample" action="{{ route('xl-dat-lai-mat-khau',['id' => auth()->user()->id])}}" method="post" >
                      @csrf
                      <div class="form-group">
                        <label for="exampleInputUsername1">Mật khẩu</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="mật khẩu " name="password" >
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1">Mật khẩu mới</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="mật khẩu mới" name="mat_khau_moi">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1">Nhập lại</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="nhập lại " name="nhap_lai" >
                      </div>
                      <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>

@endsection