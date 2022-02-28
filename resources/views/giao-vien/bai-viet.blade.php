@extends('giao-vien.main')

@section('main-content')


<div class="content-wrapper">
@error('passed')
              <div class="alert alert-success">{{$message}}</div>
            @enderror
            @error('failed')
              <div class="alert alert-danger">{{$message}}</div>
            @enderror
            <div class="page-header">
              <h3 style="color:#007bff;" class="page-title"> Name </h3>
              <nav aria-label="breadcrumb">
                
                  <a class="btn btn-inverse-success btn-fw" href="{{route('tao-bai-viet', ['id' => $lop->id])}}">Tạo bài viết</a>
                  
                  
              </nav>
            </div>
    
    <div class="card mb-3" >
    <img class="card-img" src="{{URL::to('/')}}/images/123_auto_x2.jpg" alt="Card image">
    @foreach($post as $ds)
  <div class="card bg-dark m-2" >
    @php
      $lop= App\Models\Lop::find($ds->lop_id);
      $gv= App\Models\TaiKhoan::find($lop->tai_khoan_id);
    @endphp
    <h5 class="card-header">  
    {{$gv->ho_ten }} đã đăng một {{$ds->loaiPost->loai_post}} mới: {{$ds->tieu_de}}</h5>
    
    <p class="card-body" >{{$ds->noi_dung}}</p>
    @if($ds->file!=null)
    <a class="card-footer" href="{{url('/file', $ds->file)}}" download>Tải về</a>
    @endif
    <div class="dropdown">
                        <button class="btn btn-success btn-fw" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Chức năng </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                          <a class="dropdown-item" href="{{route('cap-nhat-bai-viet', ['id' => $ds->id])}}">Cập nhật</a>
                          <a class="dropdown-item" href="{{route('xoa-bai-viet', ['id' => $ds->id])}}">Xóa</a>
                          <a class="dropdown-item" href="{{route('ds-binh-luan', ['id' => $ds->id])}}">Xem thêm</a>
                        </div>
                      </div>
  </div>
  @endforeach
</div>
</div>
@endsection


@section('search')
<form action="{{route('tim-kiem-post',['id' => $lop->id])}}" method="post">
  @csrf
<div class="input-group">
  <input type="text" class="form-control" name="tieu_de" placeholder="Nhập tiêu đề bài viết">
  <div class="input-group-append">
    <button class="btn btn-secondary" type="submit">Search</button>
  </div>
</div>
</form>
@endsection