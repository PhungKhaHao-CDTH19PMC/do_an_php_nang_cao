@extends('giao-vien.main')

@section('main-content')


<div class="content-wrapper">
            <div class="page-header">
              <h3 style="color:#007bff;" class="page-title"> Name </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a class="btn-primary" href="{{route('tao-bai-viet', ['id' => $lop->id])}}">Tạo bài viết</a></li>
                  
                </ol>
              </nav>
            </div>
    
    <div class="card mb-3">
    <img class="card-img" src="{{URL::to('/')}}/images/123_auto_x2.jpg" alt="Card image">
    @foreach($post as $ds)
  <div class="card bg-dark m-2">
    <h5 class="card-header">
    @php
      $loai = '';
      switch ($ds->loai_post_id) {
    case 1:
      $loai = 'Thông báo';
    break;
    case 2:
      $loai = 'Bài tập';
    break;
    case 3:
      $loai = 'Bài kiểm tra';
    break;
    case 4:
      $loai = 'Tài liệu';
    break;
      }
    @endphp  
    {{$loai}}: {{$ds->tieu_de}}</h5>
    <p class="card-body">{{$ds->noi_dung}}</p>
    
  </div>
  @endforeach
</div>
</div>
@endsection