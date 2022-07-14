<?php

namespace App\Http\Controllers\Admin;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    
    public function index()
    {
        $supplier = Supplier::all();
        return view('admin.pages.suppliers.index', compact('supplier'));
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
            'mobile' => 'required|min:11',
            'email' => 'required|email',
            'address' => 'required',
        ]);

        try {
            $supplier = new Supplier();
            $supplier->name = $request->name;
            $supplier->mobile = $request->mobile;
            $supplier->email = $request->email;
            $supplier->address = $request->address;
            $supplier->created_by = Auth::user()->id;
            $supplier->save();

            $notification=array(
                'message'=>'Supplier Craeted Succefully..',
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
        $editData = Supplier::find($id);
        $supplier = Supplier::all();
        return view('admin.pages.suppliers.index', compact('editData', 'supplier'));
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
            'name' => 'required|max:60',
            'mobile' => 'required|min:11',
            'email' => 'required|email',
            'address' => 'required',
        ]);

        $supplier = Supplier::find($id);
        $supplier->name = $request->name;
        $supplier->mobile = $request->mobile;
        $supplier->email = $request->email;
        $supplier->address = $request->address;
        $supplier->created_by = Auth::user()->id;
        $supplier->save();

        $notification=array(
            'message'=>'Supplier Updated Succefully..',
            'alert-type'=>'success'
        );
        return Redirect()->route('admin.suppliers')->with($notification);

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $supplier = Supplier::find($request->id);
        if($supplier){
            $supplier->delete();
        }

        $notification=array(
            'message'=>'Supplier Deleted Succefully..',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}
