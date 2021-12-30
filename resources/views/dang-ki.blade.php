<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Đăng kí E-learning</title>
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style2.css">
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
    </head>
    <body>
	<div style="float:right; width: 50%;">
	</div>
        <div class="top-content">
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                                @error('passed')
                                    <div class="alert alert-success">{{$message}}</div>
                                @enderror
                        			<h3>Đăng kí</h3>
                            		<p>Nhập vào biểu mẫu bên dưới để đăng kí</p>
                                    <a href="{{route('dang-nhap')}}">Trở về đăng nhập</a>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-key"></i>
                        		</div>
                            </div>

                            <div class="form-bottom">
			                    <form role="form" action="{{route('xl-dang-ki')}}" method="POST" class="login-form" enctype="multipart/form-data">
                                @csrf
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="radio" value="sinhvien" checked>
                                <label class="form-check-label" for="sinhvien">
                                    Sinh viên
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="radio" value="giangvien" >
                                <label class="form-check-label" for="giangvien">
                                    Giảng viên
                                </label>
                            </div>
			                    	<div class="form-group">
			                        	<input  style="height: 45px; border: 3px solid #ddd;background: #f8f8f8" name="username" placeholder="Username..." class="form-control"  >
                                        @error('username')
                                            <span style="color:red;">{{$message}}</span>
                                        @enderror
                                    </div>
			                        <div class="form-group">
			                        	<input style="height: 45px; border: 3px solid #ddd;background: #f8f8f8" name="password" placeholder="Password..." class="form-control" >
                                        @error('password')
                                            <span style="color:red;">{{$message}}</span>
                                        @enderror
                                    </div>
									<div class="form-group">
			                        	<input style="height: 45px; border: 3px solid #ddd;background: #f8f8f8" name="ho_ten" placeholder="Họ tên" class="form-control"  >
                                        @error('ho_ten')
                                            <span style="color:red;">{{$message}}</span>
                                        @enderror
                                    </div>
									<div class="form-group">
			                        	<input style="height: 45px; border: 3px solid #ddd;background: #f8f8f8" type="date" name="ngay_sinh" class="form-control" >
                                        @error('ngay_sinh')
                                            <span style="color:red;">{{$message}}</span>
                                        @enderror
                                    </div>
									<div class="form-group">
			                        	<input style="border: 3px solid #ddd; height:45px;background: #f8f8f8" type="email" name="email" placeholder="Email..." class="form-control" >
                                        @error('email')
                                            <span style="color:red;">{{$message}}</span>
                                        @enderror
                                    </div>
									<div class="form-group">
			                        	<input style="height: 45px; border: 3px solid #ddd;background: #f8f8f8" name="sdt" placeholder="Sdt..." class="form-control"  >
                                        @error('sdt')
                                            <span style="color:red;">{{$message}}</span>
                                        @enderror
                                    </div>
									<div class="form-group">
			                        	<input type="file" name="hinh_anh" class="form-control"  >
                                        @error('hinh_anh')
                                            <span style="color:red;">{{$message}}</span>
                                        @enderror
                                    </div>
			                        <button type="submit" class="btn">Đăng kí!</button>
			                    </form>
		                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>
    </body>

</html>
