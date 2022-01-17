@extends('quan-tri-vien.main')

@section('main-content')
<div class="content-wrapper">
                                @error('passed')
                                    <div class="alert alert-success">{{$message}}</div>
                                @enderror
<form method="POST" action="{{route('xl-xoa-binh-luan',['id' => $cmt->id])}}">
@csrf
  <div class="form-group">
  <label for="noidung">Nội dung</label>
  <textarea class="form-control" rows="10" name="noi_dung">{{$cmt->noi_dung}}</textarea>
</div>
 
  <button type="submit" class="btn btn-primary">Đăng</button>
</form>
</div>
@endsection