@extends('giao-vien.main')

@section('main-content')
<div class="content-wrapper">
                                @error('passed')
                                    <div class="alert alert-success">{{$message}}</div>
                                @enderror
                                @error('failed')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
<form method="POST" action="{{route('xl-cap-nhat-bai-viet', ['id' => $post->id])}}" method="POST" enctype="multipart/form-data">
@csrf
<div class="form-group">
    <select class="form-control" name="loai_post">
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
    <input type="text" class="form-control" name="tieu_de" value="{{$post->tieu_de}}" required>
   
  </div>
  <div class="form-group">
  <label for="noidung">Nội dung</label>
  <textarea class="form-control" rows="10" name="noi_dung" required>{{$post->noi_dung}}</textarea>

</div>
 <div class="form-group">
   <input type="file" name="file" placeholder="Choose file" id="file">
         
  </div>
  
  <div class="form-group">
  <label for="noidung">Thời hạn ngày</label>
		<input type="date" name="thoi_han_ngay"class="form-control" value="{{$post->thoi_han_ngay}}">
                                      
 </div>
 <div class="form-group">
  <label for="noidung">Thời hạn giờ</label>
		<input type="time" name="thoi_han_gio"class="form-control" value="{{$post->thoi_han_gio}}">
                                      
 </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
@endsection