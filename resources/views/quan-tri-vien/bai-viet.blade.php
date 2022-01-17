@extends('quan-tri-vien.main')

@section('main-content')


<div class="content-wrapper">
<div class="page-header">
              <h3 style="color:#007bff;" class="page-title"> Tên lớp: {{ $lop->ten_lop}} </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('chi-tiet-lop',['id' => $lop->id])}}">Mọi người</a></li>
                  <li class="breadcrumb-item active" aria-current="page"><a href="{{route('ds-bai-viet-giao-vien', ['id' => $lop->id])}}">Bài viết</a></li>
                </ol>
              </nav>
            </div>
@error('passed')
              <div class="alert alert-success">{{$message}}</div>
            @enderror
            
    
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
    <a class="btb btn btn-primary" href="{{route('ds-binh-luan', ['id' => $ds->id])}}">Xem thêm</a>
  </div>
  @endforeach
  
</div>
</div>
@endsection