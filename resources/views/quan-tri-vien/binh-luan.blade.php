@extends('quan-tri-vien.main')

@section('main-content')


<div class="content-wrapper">
  
@error('passed')
              <div class="alert alert-success">{{$message}}</div>
            @enderror
            @error('failed')
              <div class="alert alert-danger">{{$message}}</div>
            @enderror
    
    <div class="card mb-3" >
    <img class="card-img" src="{{URL::to('/')}}/images/123_auto_x2.jpg" alt="Card image">
  <div class="card bg-dark m-2" >
    @php
      $lop= App\Models\Lop::find($post->lop_id);
      $gv= App\Models\TaiKhoan::find($lop->tai_khoan_id);
    @endphp
    <h5 class="card-header">  
    {{$gv->ho_ten }} đã đăng một {{$post->loaiPost->loai_post}} mới: {{$post->tieu_de}}</h5>
    <p class="card-body" >{{$post->noi_dung}}</p>
    @if($post->file!=null)
    <a class="card-footer" href="{{url('/file', $post->file)}}" download>Tải về</a>
    @endif
    <a class="btn btn-success btn-fw" href="{{route('tao-binh-luan', ['id' => $post->id])}}">Binh Luận</a>
  </div>

  @foreach($cmt as $ds)
  @php
    $gv= App\Models\TaiKhoan::find($ds->tai_khoan_id);
  @endphp
  <div class="card bg-dark m-2" >
  <div class="input-group">
  <label class="form-control" style="width:20%">{{$gv->ho_ten}}:</label>
  <label class="form-control"style="width:70%">{{$ds->noi_dung}}</label>
  <div class="input-group-append">
    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Chức năng</button>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="{{route('cap-nhat-binh-luan', ['id' => $ds->id])}}">Sửa</a>
      <a class="dropdown-item" href="{{route('xoa-binh-luan', ['id' => $ds->id])}}">Xóa</a>
    </div>
  </div>
</div>
</div>
@endforeach

</div>
</div>
@endsection