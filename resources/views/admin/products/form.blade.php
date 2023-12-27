@section('content')
<div class="card card-primary">
    <div class="card-header">
      @if (request()->routeIs('products.create*'))
      <h3 class="card-title">Thêm sản phẩm</h3>
    @else
      <h3 class="card-title">Sửa sản phẩm</h3>
    @endif
  
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form method="POST" enctype="multipart/form-data" action="{{route($routeName, $routeParams ?? '')}}">  @csrf
      @csrf <!-- {{ csrf_field() }} -->
      @if (request()->routeIs('products.create*'))
      @else
      @method('PUT')
      @endif
      <div class="card-body">
        <div class="row">
        <div class="col-lg-6">
        <div class="form-group">
          <label for="nameProduct">Tên sản phẩm</label>
          <input type="text" name="nameProduct" value="{{$edit->name ?? ''}}"   class="form-control" id="nameProduct" placeholder="Tên sản phẩm">
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
          <label for="priceProduct">Giá</label>
          <input type="text" name="priceProduct" value="{{$edit->price ?? ''}}"   class="form-control" id="priceProduct" placeholder="Giá sản phẩm">
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
          <label for="saleProduct">Giá khuyến mãi</label>
          <input type="text" name="saleProduct" value="{{$edit->sale_price ?? ''}}"   class="form-control" id="saleProduct" placeholder="Giá khuyến mãi">
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
          <label for="contentProduct">Nội dung</label>
          <input type="text" name="contentProduct" value="{{$edit->content ?? ''}}"   class="form-control" id="contentProduct" placeholder="Nội dung">
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
          <label for="imageProduct">Ảnh</label>
          <input type="file" name="imageProduct" value="{{$edit->thumbnail ?? ''}}"   class="form-control" id="imageProduct">
        </div>
      </div>
     
        </div>
    </div>
      <!-- /.card-body -->
      <div class="card-footer">
        @if (request()->routeIs('products.create'))
        <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
        @else
        <button type="submit" class="btn btn-primary">Sửa sản phẩm</button>
         @endif
       </div>
    </form>
  </div>
@endsection
@section('title')
@if (request()->routeIs('products.create*'))
   Thêm sản phẩm
@else
 Sửa sản phẩm
@endif
@endsection
@extends('admin.layouts.master')