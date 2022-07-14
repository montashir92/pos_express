<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{

    public function index()
    {
        $customer = Customer::all();
        return view('admin.pages.customer.index', compact('customer'));
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
            'mobile' => 'required|min:11|max:20|unique:customers',
            'email' => 'max:100',
            'address' => 'required|max:191',
        ]);

        try {
            $customer = new Customer();
            $customer->name = $request->name;
            $customer->mobile = $request->mobile;
            $customer->email = $request->email;
            $customer->address = $request->address;
            $customer->created_by = Auth::user()->id;
            $customer->save();

            $notification=array(
                'message'=>'Customer Created Succefully..',
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::all();
        $customerData = Customer::find($id);
        return view('admin.pages.customer.index', compact('customer', 'customerData'));
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
            'mobile' => 'required|min:11|max:20',
            'email' => 'max:100',
            'address' => 'required|max:191',
        ]);

        try {
            $customer = Customer::find($id);
            $customer->name = $request->name;
            $customer->mobile = $request->mobile;
            $customer->email = $request->email;
            $customer->address = $request->address;
            $customer->updated_by = Auth::user()->id;
            $customer->save();

            $notification=array(
                'message'=>'Customer Updated Succefully..',
                'alert-type'=>'success'
            );
            return Redirect()->route('admin.customers')->with($notification);

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
        $customer = Customer::find($request->id);
        if($customer){
            $customer->delete();
        }

        $notification=array(
            'message'=>'Customer Deleted Succefully..',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}
