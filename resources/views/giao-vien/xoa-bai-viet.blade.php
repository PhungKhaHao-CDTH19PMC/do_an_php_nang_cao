@extends('giao-vien.main')

@section('main-content')
<div class="content-wrapper">
                                @error('passed')
                                    <div class="alert alert-success">{{$message}}</div>
                                @enderror
<form method="POST" action="{{route('xl-xoa-bai-viet', ['id' => $post->id])}}" method="POST" enctype="multipart/form-data">
@csrf
<div class="form-group">
    <select class="form-control" name="loai_post" disabled>
        @foreach($loaipost as $ds)
            @if($ds->id==$post->loai_post_id)
                <option value="{{ $ds->id}} " selected>{{ $ds->loai_post}}</option>
            @else
                <option value="{{ $ds->id}} ">{{ $ds->loai_post}}</option>
            @endif
        @endforeach

    </select>
</div>
  <div class="form-group">
    <label for="tieude">Tiêu đề</label>
    <input type="text" style="color:black;"class="form-control" name="tieu_de" value="{{$post->tieu_de}}"readonly>
   
  </div>
  <div class="form-group">
  <label for="noidung">Nội dung</label>
  <textarea style="color:black;" class="form-control" rows="10" name="noi_dung" readonly>{{$post->noi_dung}}</textarea>
</div>
  <div class="form-group">
  <div class="form-group">
  <label for="noidung">Thời hạn ngày</label>
		<input type="date" name="thoi_han_ngay"class="form-control" value="{{$post->thoi_han_ngay}}" readonly style="color:black;">
                                      
 </div>
 <div class="form-group">
  <label for="noidung">Thời hạn giờ</label>
		<input type="time" name="thoi_han_gio"class="form-control" value="{{$post->thoi_han_gio}}" readonly style="color:black;">
                                      
 </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
@endsection