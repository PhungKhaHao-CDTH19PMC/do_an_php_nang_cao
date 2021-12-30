@extends('giao-vien.main')

@section('main-content')
<div class="content-wrapper">
            <div class="page-header">
            @if ($errors->any())
          <div class="alert alert-success">
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
                    <form class="forms-sample" action="{{route('xl-cap-nhat-lop',['id' => $lop->id])}}" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                        <label for="exampleInputUsername1">Tên lớp học</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Tên lớp " required name="ten_lop" value="{{$lop->ten_lop}}">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1">Hình ảnh (Có thể không chọn)</label>
                        <input type="file" class="form-control" id="exampleInputUsername1" name="hinh_anh">
                      </div>
                      <div class="form-group">
                        <img src="{{URL::to('/')}}/images/{{$lop->hinh_anh}}" alt="" border=3 height=200 width=270></img>
                      </div>
                      <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
@endsection
