@extends('quan-tri-vien.main')

@section('main-content')
<div class="content-wrapper">
            @error('passed')
              <div class="alert alert-success">{{$message}}</div>
            @enderror
            <h4>Cập nhật tài khoản</h4>
            <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="form-group">
                      <div id="errormessage"><a href="{{ route('dat-lai-mat-khau',['id' => auth()->user()->id])}}">Đặt lại mật khẩu</a></div>
                    </div>
                    <form class="forms-sample" action="{{ route('xl-cap-nhat-tai-khoan',['id' => auth()->user()->id])}}" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                        <label for="exampleInputUsername1">Username</label>
                        <input style="color:black;"type="text" class="form-control" id="exampleInputUsername1" name="username" value="{{$tk->username}}" readonly>

                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1">Họ Tên</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Họ tên " name="ho_ten" value="{{$tk->ho_ten}}" >
                        @error('ho_ten')
                          <span style="color:red;">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1">Ngày sinh</label>
                        <input type="date" class="form-control" id="exampleInputUsername1"  name="ngay_sinh" value="{{$tk->ngay_sinh}}" >
                        @error('ngay_sinh')
                          <span style="color:red;">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1">Email</label>
                        <input type="email" class="form-control" id="exampleInputUsername1" placeholder="Email" name="email" value="{{$tk->email}}" >
                        @error('email')
                          <span style="color:red;">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1">Số điện thoại</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="sdt" name="sdt" value="{{$tk->sdt}}" >
                        @error('sdt')
                          <span style="color:red;">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1">Hình ảnh (Có thể không chọn)</label>
                        <input type="file" class="form-control" id="exampleInputUsername1" name="hinh_anh">
                        @error('hinh_anh')
                          <span style="color:red;">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <img src="{{URL::to('/')}}/images/{{$tk->hinh_anh}}" alt="" border=3 height=200 width=270></img>
                      </div>
                      <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
@endsection