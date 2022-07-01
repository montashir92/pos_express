<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    
    public function index()
    {
        $category = Category::all();
        return view('admin.pages.category.index', compact('category'));
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
            'name' => 'required|max:60',
        ]);

        try {
            $category = new Category();
            $category->name = $request->name;
            $category->created_by = Auth::user()->id;
            $category->save();

            $notification=array(
                'message'=>'category Craeted Succefully..',
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
        $category = Category::all();
        $categoryData = Category::find($id);
        return view('admin.pages.category.index', compact('category', 'categoryData'));
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
            'name' => 'max:60',
        ]);

        try {
            $category = Category::find($id);
            $category->name = $request->name;
            $category->updated_by = Auth::user()->id;
            $category->save();

            $notification=array(
                'message'=>'Category Updated Succefully..',
                'alert-type'=>'success'
            );
            return Redirect()->route('admin.categories')->with($notification);

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
        $category = Category::find($request->id);
        if(!is_null($category)){
            $category->delete();
        }

        $notification=array(
            'message'=>'Category Deleted Succefully..',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}
