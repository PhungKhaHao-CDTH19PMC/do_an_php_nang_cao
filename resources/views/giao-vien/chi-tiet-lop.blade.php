
@extends('giao-vien.main')

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
                    <form class="forms-sample" action="{{route('xl-them-sinh-vien',['id' => $lop->id])}}" method="post">
                      @csrf
                      <div class="form-group">
                        <label for="exampleInputUsername1">Email Sinh Viên</label>
                        <input type="email" class="form-control" id="exampleInputUsername1" placeholder="email " name="email">
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