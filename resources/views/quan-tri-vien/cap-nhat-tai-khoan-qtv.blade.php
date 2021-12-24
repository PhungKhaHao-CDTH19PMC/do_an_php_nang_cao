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
                    <form class="forms-sample" action="{{ route('xl-cap-nhat-tai-khoan-qtv',['id' => $tk->id])}}" method="post">
                      @csrf
                      <div class="form-group">
                        <select class="form-control" name="phan_quyen">
                            @foreach($quyen as $ds)
                                @if($ds->id==$tk->phan_quyen_id)
                                    <option value="{{ $ds->id}} " selected>{{ $ds->loai_nguoi_dung}}</option>
                                @else
                                    <option value="{{ $ds->id}} ">{{ $ds->loai_nguoi_dung}}</option>
                                @endif
                            @endforeach

                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1">Username</label>
                        <input style="color:black;"type="text" class="form-control" id="exampleInputUsername1" name="username" value="{{$tk->username}}" readonly>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1">Họ Tên</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Họ tên " name="ho_ten" value="{{$tk->ho_ten}}" >
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1">Ngày sinh</label>
                        <input type="date" class="form-control" id="exampleInputUsername1"  name="ngay_sinh" value="{{$tk->ngay_sinh}}" >
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1">Email</label>
                        <input type="email" class="form-control" id="exampleInputUsername1" placeholder="Email" name="email" value="{{$tk->email}}" >
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1">Số điện thoại</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="sdt" name="sdt" value="{{$tk->sdt}}" >
                      </div>
                      <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
@endsection