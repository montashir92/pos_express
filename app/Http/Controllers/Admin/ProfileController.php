<?php

namespace App\Http\Controllers\Admin;

use Image;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    
    public function index()
    {
        $user = User::find(Auth::id());
        return view('admin.pages.profiles.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editPassword()
    {
        return view('admin.pages.profiles.change_password');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'currentPass' => 'required',
            'password' => 'required|confirmed',
        ]);

        $currentPassword = Auth::user()->password;
        if (Hash::check($request->currentPass, $currentPassword)) {
            if (!Hash::check($request->password, $currentPassword)) {
                $user = Auth::user();
                $user->password = HasH::make($request->password);
                $user->save();
                
                if ($user) {
                    $notification=array(
                        'message'=>'Password Update Successfully',
                        'alert-type'=>'success'
                    );
                    return Redirect()->back()->with($notification);
                } else {
                    $notification=array(
                        'message'=>'Current password not match',
                        'alert-type'=>'error'
                    );
                    return Redirect()->back()->with($notification);
                }
            } else {
                $notification=array(
                    'message'=>'Same as Current password',
                    'alert-type'=>'error'
                );
                return Redirect()->back()->with($notification);
            }
        } else {
            $notification=array(
                'message'=>'Current password not match !',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|min:11',
            'address' => 'required',
            'gender' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png,gif'
        ]);

        $old_img = $request->old_image;
        if ($request->file('image')) {
            unlink($old_img);
            $image = $request->file('image');
            $name_gen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(380,380)->save('admin/image/user/'.$name_gen);
            $save_url = 'admin/image/user/'.$name_gen;

            $profiles = User::find(Auth::user()->id);
            $profiles->name = $request->name;
            $profiles->email = $request->email;
            $profiles->mobile = $request->mobile;
            $profiles->address = $request->address;
            $profiles->gender = $request->gender;
            $profiles->image = $save_url;
            $profiles->save();

        } else {
            $profiles = User::find(Auth::id());
            $profiles->name = $request->name;
            $profiles->email = $request->email;
            $profiles->mobile = $request->mobile;
            $profiles->address = $request->address;
            $profiles->gender = $request->gender;
            $profiles->save();
        }

        $notification=array(
            'message'=>'User Data Updated Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification); 
        
    }

}
