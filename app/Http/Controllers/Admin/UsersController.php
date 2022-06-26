<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    
    public function index()
    {
        $data['allData'] = User::all();
        return view('admin.pages.users.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'usertype' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);
        
        try {
            $users = new User();
            $users->name = $request->name;
            $users->usertype = $request->usertype;
            $users->email = $request->email;
            $users->password = bcrypt($request->password);
            $users->save();

            $notification=array(
                'message'=>'User Craeted Succefully..',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
    
        } catch (\Throwable $th) {
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
        $user = User::find($id);
        return view('backend.pages.users.index', compact('user'));
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
        $this->validate($request, [
            'name' => 'required',
            'usertype' => 'required',
            'email' => 'required|email',
        ]);
        
        $user = User::find($id);
        $user->name = $request->name;
        $user->usertype = $request->usertype;
        $user->email = $request->email;
        $user->save();

        $notification=array(
            'message'=>'User Updated Succefully..',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $user = User::find($request->id);
        if($user)
        {
            if(file_exists($user->image) AND !empty($user->image))
            {
                unlink($user->image);
            }
            
            $user->delete();
        }

        $notification=array(
            'message'=>'User Updated Succefully..',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}
