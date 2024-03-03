<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Role;

class PermissionController extends Controller
{
    
    public function index()
    {
        $permissions = Permission::with('role')->get();
        return view('backend.pages.permissions.index',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('id','!=',2)->get();
        return view('backend.pages.permissions.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'role_id' => 'required|numeric|unique:permissions,role_id'
        ]);

        Permission::create($request->all());
        $notification=array(
            'message'=>'permission Created Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('permission.index')->with($notification);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::find($id);
        $roles = Role::where('id','!=',2)->get();
        return view('backend.pages.permissions.edit',compact('permission','roles'));
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
            'role_id' => 'required|exists:permissions,role_id'
        ]);

        Permission::findOrFail($id)->update($request->all());
        $notification=array(
            'message'=>'permission Update Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('permission.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Permission::findOrFail($id)->delete();
        $notification=array(
            'message'=>'permission Delete Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}
