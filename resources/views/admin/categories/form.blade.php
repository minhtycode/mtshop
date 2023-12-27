@section('content')
<div class="card card-primary">
    <div class="card-header">
      @if (request()->routeIs('categories.create*'))
      <h3 class="card-title">Thêm danh mục</h3>
    @else
      <h3 class="card-title">Sửa danh mục</h3>
    @endif
  
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form method="POST" enctype="multipart/form-data" action="{{route($routeName, $routeParams ?? '')}}">  @csrf
      @csrf <!-- {{ csrf_field() }} -->
      @if (request()->routeIs('categories.create*'))
      @else
      @method('PUT')
      @endif
      <div class="card-body">
        <div class="row">
        <div class="col-lg-6">
        <div class="form-group">
          <label for="nameCategory">Tên danh mục</label>
          <input type="text" name="nameCategory" value="{{$edit->name ?? ''}}"   class="form-control" id="nameProduct" placeholder="Tên danh mục">
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
          <label for="contentCategory">Nội dung</label>
          <input type="text" name="contentCategory" value="{{$edit->content ?? ''}}"   class="form-control" id="contentProduct" placeholder="Mô tả">
        </div>
      </div>
        </div>
    </div>
      <!-- /.card-body -->
      <div class="card-footer">
        @if (request()->routeIs('categories.create'))
        <button type="submit" class="btn btn-primary">Thêm danh mục</button>
        @else
        <button type="submit" class="btn btn-primary">Sửa danh mục</button>
         @endif
       </div>
    </form>
  </div>
@endsection
@section('title')
@if (request()->routeIs('categories.create*'))
   Thêm danh mục
@else
 Sửa danh mục
@endif
@endsection
@extends('admin.layouts.master')