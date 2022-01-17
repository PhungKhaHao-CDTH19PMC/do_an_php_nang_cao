@extends('sinh-vien.main')

@section('main-content')
<div class="content-wrapper">
                                @error('passed')
                                    <div class="alert alert-success">{{$message}}</div>
                                @enderror
                                @error('failed')
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror
<form method="POST" action="{{route('xl-nop-bai', ['id' => $cmt->id])}}" method="POST" enctype="multipart/form-data">
@csrf
  <div class="form-group">
  <label for="noidung">Nội dung</label>
  <input type="file" class="form-control" name="file">
</div>
 
  <button type="submit" class="btn btn-primary">Đăng</button>
</form>
</div>
@endsection