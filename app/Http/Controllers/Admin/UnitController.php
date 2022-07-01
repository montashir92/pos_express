<?php

namespace App\Http\Controllers\Admin;

use App\Models\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UnitController extends Controller
{
    
    public function index()
    {
        $unit = Unit::all();
        return view('admin.pages.unit.index', compact('unit'));
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
            'name' => 'required|max:40'
        ]);

        try {
            $unit = new Unit();
            $unit->name = $request->name;
            $unit->created_by = Auth::user()->id;
            $unit->save();

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
        $unit = Unit::all();
        $unitData = Unit::find($id);
        return view('admin.pages.unit.index', compact('unit', 'unitData'));
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
            'name' => 'max:40'
        ]);

        try {
            $unit = Unit::find($id);
            $unit->name = $request->name;
            $unit->updated_by = Auth::user()->id;
            $unit->save();

            $notification=array(
                'message'=>'Supplier Updated Succefully..',
                'alert-type'=>'success'
            );
            return Redirect()->route('admin.units')->with($notification);

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
        $unit = Unit::find($request->id);
        if(!is_null($unit)){
            $unit->delete();
        }

        $notification=array(
            'message'=>'Data Deleted Succefully..',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}
