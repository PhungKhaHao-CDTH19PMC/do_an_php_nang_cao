
@extends('giao-vien.main')

@section('main-content')
<style>
            .col-custom{
              width: 25%;
              padding: 20px 20px 0px 20px;
              border-radius: 30px;
            }
            .card-header{
              position: relative;
             min-height: 180px;
             
            }
            .card-header img{
              position: absolute;
              top: 0%;
              left: 0%;
              width: 100%;
              height: 180px;
              object-fit: cover;
              border-radius: 15px 15px 0px 0px;
            }
            .border-success{
              border-radius: 15px;
            }
            .card-footer a i {
              font-size: 15px;
              color: gray;
              background-color: none;
            }
       
            .border-custom{
         
           
              border-radius: 15px;
            }
            .bg-shadow{
             
             margin-left: 10px;
             border-radius: 50%;
            }
            .bg-shadow:hover{
             background-color: rgba(0, 0, 0, 0.1);
            }
            .card:hover{
              box-shadow: 1px 5px 18px 5px rgba(0, 0, 0, 0.2);
            }
           </style>
     <div class="content-wrapper">
            @error('failed')
              <div class="alert alert-danger">{{$message}}</div>
            @enderror
            @error('passed')
              <div class="alert alert-success">{{$message}}</div>
            @enderror
            <h4>Danh sách lớp</h4>
            <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
        <div class="container-fluid">
          <div class="row" style="margin: auto;">
          @foreach($lop as $ds)
            <div class="col-custom">
              <div class="card border-custom mb-3" style="width: 100%;">
                <div class="card-header bg-transparent border-0">
                  <img src="{{URL::to('/')}}/images/{{$ds->hinh_anh}}" alt="">
                </div>
                <div class="card-body text-success">
                  <h5 class="card-title">Tên lớp: {{$ds->ten_lop}}</h5>
                  <p class="card-text">Mã lớp: {{$ds->ma_lop}}</p>
                </div>
               <div class="card-footer bg-transparent ">
                  <div class="d-flex flex-row-reverse bd-highlight">
                    <div class="p-2 bd-highlight bg-shadow">
                      <a href="{{route('chi-tiet-lop',['id' => $ds->id])}}">  <i class="fal fa-info-circle"></i></a>
                    </div>
                    <div class="p-2 bd-highlight bg-shadow">
                      <a href="{{route('xoa-lop',['id' => $ds->id])}}">   <i class="far fa-trash"></i></a>
                    </div>
                    <div class="p-2 bd-highlight bg-shadow">
                      <a href="{{route('cap-nhat-lop',['id' => $ds->id])}}">   <i class="far fa-sync"></i></a>
                    </div>
                 </div>
               </div>
              </div>
            </div>
            @endforeach
           </div>
        </div>
        </div>
        </div>
        </div>
        </div>
@endsection

