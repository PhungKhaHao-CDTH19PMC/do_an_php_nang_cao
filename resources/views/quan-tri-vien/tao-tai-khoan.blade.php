@extends('quan-tri-vien.main')

@section('main-content')
<div class="content-wrapper">
            <div class="page-header">
            @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach($errors->all() as $error)
              <li>{{$error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
              
            </div>
            <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    
                    <form class="forms-sample" action="{{ route('tao-tai-khoan')}}" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                        <label for="exampleInputConfirmPassword1">Country</label>
                        <select class="form-control" name="phan_quyen">
                        @foreach($dsquyen as $ds)
                          <option value="{{ $ds->id}}">{{ $ds->loai_nguoi_dung}}</option>
                        @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1">Username</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" name="username" placeholder="Username">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1">Password</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" name="password" placeholder="password">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1">Họ Tên</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Họ tên " name="ho_ten" >
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1">Ngày sinh</label>
                        <input type="date" class="form-control" id="exampleInputUsername1"  name="ngay_sinh"  >
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1">Email</label>
                        <input type="email" class="form-control" id="exampleInputUsername1" placeholder="Email" name="email"  >
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1">Số điện thoại</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="sdt" name="sdt"  >
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1">Hình ảnh</label>
                        <input type="file" class="form-control" id="exampleInputUsername1" name="hinh_anh">
                      </div>

                      <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
@endsection