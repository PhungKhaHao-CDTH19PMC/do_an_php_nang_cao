@extends('giao-vien.main')

@section('main-content')
<div class="content-wrapper">
                                @error('passed')
                                    <div class="alert alert-success">{{$message}}</div>
                                @enderror
                                @error('failed')
              <div class="alert alert-danger">{{$message}}</div>
            @enderror
<form method="POST" action="{{route('xl-tao-bai-viet',['id' => $lop->id])}}" method="POST" enctype="multipart/form-data">
@csrf
<div class="form-group">
    <label for="exampleInputConfirmPassword1">Loại Bài Viết</label>
    <select class="form-control" name="loai_post">
    @foreach($loaipost as $ds)
        <option value="{{ $ds->id}}">{{ $ds->loai_post}}</option>
    @endforeach
    </select>
</div>
  <div class="form-group">
    <label for="tieude">Tiêu đề</label>
    <input type="text" class="form-control" name="tieu_de" required>
   
  </div>
  <div class="form-group">
  <label for="noidung">Nội dung</label>
  <textarea class="form-control" rows="10" name="noi_dung" required></textarea>

</div>
 <div class="form-group">
   <input type="file" name="file" placeholder="Choose file" id="file">
         
  </div>
  
  <div class="form-group">
  <label for="noidung">Thời hạn ngày</label>
		<input type="date" name="thoi_han_ngay" class="form-control" >
                                      
 </div>

 <div class="form-group">
  <label for="noidung">Thời hạn giờ</label>
		<input type="time" name="thoi_han_gio" class="form-control" >                            
 </div>

  <button type="submit" class="btn btn-primary">Đăng</button>
</form>
</div>
@endsection