@extends('sinh-vien.main')

@section('main-content')
<form method="POST" action="">
@csrf
  <div class="form-check">
                                <input class="form-check-input" type="radio" name="radio" value="1" checked>
                                <label class="form-check-label" for="1">
                                    Thông báo
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="radio" value="2" >
                                <label class="form-check-label" for="2">
                                    Bài tập
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="radio" value="3" >
                                <label class="form-check-label" for="3">
                                    Bài kiểm tra
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="radio" value="4" >
                                <label class="form-check-label" for="4">
                                    Tài liệu
                                </label>
                            </div>
  <div class="form-group">
    <label for="tieude">Tiêu đề</label>
    <input type="text" class="form-control" name="tieude">
  </div>
  <div class="form-group">
  <label for="noidung">Nội dung</label>
  <textarea class="form-control" rows="10" name="noidung"></textarea>
</div>
 <div class="form-group">
   <input type="file" name="file" placeholder="Choose file" id="file">
                       
  </div>
  
  <div class="form-group">
  <label for="noidung">Thời hạn</label>
		<input style="height: 45px; border: 3px solid #ddd;background: #f8f8f8" 
        type="date" name="thoihan" class="form-control" >
                                      
 </div>
  <button type="submit" class="btn btn-primary">Đăng</button>
</form>

@endsection