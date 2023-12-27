<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = DB::table('products')
       ->get();
        return view('admin.products.table', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'routeName' => 'products.store'
        ];
     return view('admin.products.form',$data); 
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('imageProduct') && $request->file('imageProduct')->isValid()) {
            $extension = $request->file('imageProduct')->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $imagePath = $request->file('imageProduct')->storeAs('admin/dist/img', $filename, 'public');
        } else {
            $imagePath = '';
        }
        
        DB::table('products')->insert([
            'name' => $request->nameProduct,
            'slug' =>  Str::slug($request->nameProduct), // Tạo slug dựa trên tên sản phẩm
            'content' => $request->contentProduct,
            'thumbnail' => $imagePath,  // Sử dụng tên trường thumbnail như đã định nghĩa trong schema
            'price' => $request->priceProduct,
            'sale_price' =>$request->saleProduct,
        ]);
    
        return redirect(route('products.index'))->with('success','Thêm sản phẩm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $edit =   DB::table('products')
        ->where('id','=',$id)
        ->first();
        $data = [
            'edit' => $edit,
            'routeName' => 'products.update',
            'routeParams' => ['product' => $id]
        ];
        return view('admin.products.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = DB::table('products')->where('id', $id)->first();
    
        if (!$product) {
            return redirect(route('products.index'))->withErrors(['message' => 'Sản phẩm không tồn tại']);
        }
    
        $imagePath = $product->thumbnail;
    
        if ($request->hasFile('imageProduct') && $request->file('imageProduct')->isValid()) {
            $extension = $request->file('imageProduct')->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $imagePath = $request->file('imageProduct')->storeAs('admin/dist/img', $filename, 'public');
        }
    
        DB::table('products')
            ->where('id', $id)
            ->update([
                'name' => $request->input('nameProduct'),
                'slug' =>  Str::slug($request->nameProduct),
                'content' => $request->input('contentProduct'),
                'thumbnail' => $imagePath,
                'price' => $request->input('priceProduct'),
                'sale_price' => $request->input('saleProduct')
            ]);
        return redirect(route('products.index'))->with('success', 'Sản phẩm đã được sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    DB::table('products')
        ->where('id', '=', $id)
        ->delete();
    return redirect(route('products.index'))->with('success', 'Sản phẩm đã được xóa thành công');
}
}
