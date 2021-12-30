@extends('sinh-vien.main')

@section('main-content')
<div class="content-wrapper">
            <div class="page-header">
              <h3 style="color:#007bff;" class="page-title"> Name </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="">Mọi người</a></li>
                  <li class="breadcrumb-item active" aria-current="page"><a href="{{route('ds-bai-viet')}}">Bài viết</a></li>
                </ol>
              </nav>
            </div>
    
    <div class="card mb-3">
    <img class="card-img" src="{{URL::to('/')}}/images/123_auto_x2.jpg" alt="Card image">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
  </div>
</div>
</div>
@endsection