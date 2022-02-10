
@extends('giao-vien.main')

@section('main-content')
<div class="content-wrapper">

          <table class="table">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Họ tên</th>
                    <th scope="col">Ngày sinh</th>
                    <th scope="col">Email</th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                @forelse($nopbai as $np)
                @php
                    $ds= App\Models\TaiKhoan::find($np->tai_khoan_id);
                @endphp
                <tr>
                    <td>{{ $ds->id}}</td>
                    <td>{{ $ds->ho_ten}}</td>
                    <td>{{ $ds->ngay_sinh}}</td>
                    <td>{{ $ds->email}}</td>
                    <td>{{ $ds->sdt}}</td>
                    <td><a href="{{url('/fileBaiNop', $np->file)}}" download>Tệp đính kèm</td>
                </tr>
                @empty
                <tr>
                    <td colspan="2">Không có dữ liệu</td>
                </tr>
                @endforelse
                </tbody>
              </table>
              </div>
@endsection