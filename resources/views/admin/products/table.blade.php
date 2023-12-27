  
@section('content')
<div class="row">
<div class="col-lg-12">
<div class="card">
  @if (session('success'))
  <div class="alert alert-success">
     {{ session('success') }}
  </div>
@endif
<div class="card-header">
  <div class="card-title">
      Danh sách sản phẩm
  </div>
  <div class="card-tools"><button class="btn btn-primary "> <a href="{{route('products.create')}}" class="text-white">Thêm mới</a></button></div>
</div>
  <!-- /.card-header -->
  <div class="card-body">
    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
      <div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
      <thead>
      <tr>
        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">ID</th>
        <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column descending" aria-sort="ascending">Tên sản phẩm</th>
        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Giá</th>
        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Giá khuyến mãi</th>
        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Thao tác</th>
      </tr>
      </thead>
      <tbody>
          @foreach ($products as $item )     
      <tr class="odd">  
        <td class="dtr-control" tabindex="0">{{$item->id}}</td>
        <td class="sorting_1">{{$item->name}}</td>
        <td>{{ number_format($item->price, 2, ',', '.') }} đ</td>
        <td>{{ number_format($item->sale_price, 2, ',', '.') }} đ</td>
        <td class="d-flex">
          <form action="{{ route('products.edit', ['product' => $item->id]) }}" class="ms-2" method="GET">
            @csrf
            <button class="btn btn-primary ">Sửa sản phẩm</button>

          </form>
          <form action="{{ route('products.destroy', ['product' => $item->id]) }}" method="POST">
            @csrf
            @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">Xóa sản phẩm</button>
        </form></td>
      </tr>
      @endforeach
      </tbody>
      <tfoot>
      </tfoot>
    </table></div>
  </div>
 </div>
  </div>
  <!-- /.card-body -->
</div>
</div>
</div>
@endsection
@section('title')
Danh sách sản phẩm
@endsection
@extends('admin.layouts.master')
