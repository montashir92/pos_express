<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    public function index()
    {
        $data['product'] = Product::all();
        $data['suppliers'] = Supplier::all();
        $data['units'] = Unit::all();
        $data['categories'] = Category::all();
        return view('admin.pages.products.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required',
            'unit_id' => 'required',
            'category_id' => 'required',
            'name' => 'required|max:100',
        ]);

        try {
            $product = new Product();
            $product->supplier_id = $request->supplier_id;
            $product->unit_id = $request->unit_id;
            $product->category_id = $request->category_id;
            $product->name = $request->name;
            $product->save();

            $notification=array(
                'message'=>'Product Added Succefully..',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);

        } catch (\Exception $e) {
            $notification=array(
                'message'=>'Something went wrong!',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['productData'] = Product::find($id);
        $data['product'] = Product::all();
        $data['suppliers'] = Supplier::all();
        $data['units'] = Unit::all();
        $data['categories'] = Category::all();
        return view('admin.pages.products.index', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'supplier_id' => 'required',
            'unit_id' => 'required',
            'category_id' => 'required',
            'name' => 'required|max:100',
        ]);

        try {
            $product = Product::find($id);
            $product->supplier_id = $request->supplier_id;
            $product->unit_id = $request->unit_id;
            $product->category_id = $request->category_id;
            $product->name = $request->name;
            $product->save();

            $notification=array(
                'message'=>'Product Updated Succefully..',
                'alert-type'=>'success'
            );
            return Redirect()->route('admin.products')->with($notification);

        } catch (\Exception $e) {
            $notification=array(
                'message'=>'Something went wrong!',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $product = Product::find($request->id);
        if($product){
            $product->delete();
        }

        $notification=array(
            'message'=>'Product Deleted Succefully..',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}
