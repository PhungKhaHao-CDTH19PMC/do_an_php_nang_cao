@extends('giao-vien.main')

@section('main-content')
<div class="content-wrapper">
            <div class="page-header">
              
            </div>
            <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <form class="forms-sample" action="{{ route('xl-xoa-lop',['id' => $lop->id])}}" method="post">
                      @csrf
                      <div class="form-group">
                        <label for="exampleInputUsername1">Tên lớp học</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Tên lớp " name="ten_lop" value="{{$lop->ten_lop}}">
                      </div>
                      <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
@endsection