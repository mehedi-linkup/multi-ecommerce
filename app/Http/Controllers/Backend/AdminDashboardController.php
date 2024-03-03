<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use App\Models\User;

class AdminDashboardController extends Controller
{
    
    public function index()
    {
        return view('backend.pages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return view('backend.pages.profiles.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editImage()
    {
        return view('backend.pages.profiles.edit_image');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateImage(Request $request)
    {
        $user = User::find(Auth::user()->id);
        
        $image = $request->file('image');
        if($image){
            $imgName = date('YmdHi').$image->getClientOriginalName();
            $image->move('frontend/media/', $imgName);
            if(file_exists('frontend/media/'.$user->image) AND !empty($user->image)){
                unlink('frontend/media/'.$user->image);
            }
            $user->image = $imgName;
        }
        
        $user->save();

        $notification=array(
            'message'=>'Image Successfully Updated',
            'alert-type'=>'success'
        );
        return Redirect()->route('admin.profiles')->with($notification);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function password()
    {
        return view('backend.pages.profiles.change_password');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_passsword' => 'required|min:8',
            'password_confirmaion' => 'required|min:8',
        ]);
        
        if(Auth::attempt(['id' => Auth::user()->id, 'password' => $request->old_password])){
            $user = User::findOrFail(Auth::id());
            $user->password = Hash::make($request->new_passsword);
            $user->save();
            
            Auth::logout();
            
            $notification=array(
              'message'=>'Your Password Change Success. Now Login With New Password',
              'alert-type'=>'success'
            );
            return Redirect()->route('login')->with($notification);
        }else{
            $notification=array(
                'message'=>'Old Password Not Match',
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
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ],[
            'name.required' => 'input your name',
        ]);

        User::findOrFail(Auth::id())->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'updated_at' => Carbon::now(),
        ]);

        $notification=array(
            'message'=>'Your Profile Updated Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allUsers() 
    {
        $users = User::where('role_id','!=',1)->orderBy('id','DESC')->get();
        return view('backend.pages.users.index',compact('users'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function banned($id) 
    {
        User::findOrFail($id)->update(['isban' => 1]);
        $notification=array(
            'message'=>'User Banned Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function unbanned($id) 
    {
        User::findOrFail($id)->update(['isban' => 0]);
        $notification=array(
            'message'=>'User Unbanned Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

}
