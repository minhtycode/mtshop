<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $categories = DB::table('categories')
        ->select('id','name','content')
        ->get();
        return view('admin.categories.table',['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'routeName' => 'categories.store'
        ];
     return view('admin.categories.form',$data); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        DB::table('categories')->insert([
            'name' => $request->nameCategory,
            'content' => $request->contentCategory,
        ]);
        return redirect(route('categories.index'))->with('success','Sản phẩm đã được thêm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $edit =   DB::table('categories')
        ->where('id','=',$id)
        ->first();
        $data = [
            'edit' => $edit,
            'routeName' => 'categories.update',
            'routeParams' => ['category' => $id]
        ];
        return view('admin.categories.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    
    {
        
        $product = DB::table('categories')->where('id', $id)->first();
        DB::table('categories')
        ->where('id', $id)
        ->update([
            'name' => $request->input('nameCategory'),
            'content' => $request->input('contentCategory'),
        ]);
        $data = [
            'routeName' => 'categories.update', ['category' => $id]
        ];
    return redirect(route('categories.index'))->with('success', 'Danh mục đã được sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('categories')
        ->where('id', '=', $id)
        ->delete();
    return redirect(route('categories.index'))->with('success', 'Danh mục đã được xóa thành công');
    }
}
