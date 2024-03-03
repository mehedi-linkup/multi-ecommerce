<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Division;
use App\Models\District;
use App\Models\State;

class ShippingAreaController extends Controller
{
    
    public function index()
    {
        $divisions = Division::orderBy('id','DESC')->get();
        return view('backend.pages.divisions.index', compact('divisions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.divisions.create');
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
            'name' => 'required',
        ]);
        
        $division = new Division();
        $division->name = $request->name;
        $division->save();
        
        $notification=array(
            'message'=>'Added Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $division = Division::findOrFail($id);
        return view('backend.pages.divisions.edit', compact('division'));
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
            'name' => 'required',
        ]);
        
        $division = Division::findOrFail($id);
        $division->name = $request->name;
        $division->save();
        
        $notification=array(
            'message'=>'Updated Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('admin.divisions')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $division = Division::find($request->id);
        if(!is_null($division)){
            $division->delete();
        }
        
        $notification=array(
            'message'=>'Division Deleted Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
    
    //District Methos
    
    public function indexDistrict()
    {
        $districts = District::orderBy('id','DESC')->get();
        return view('backend.pages.districts.index', compact('districts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createDistrict()
    {
        $divisions = Division::orderBy('name','ASC')->get();
        return view('backend.pages.districts.create', compact('divisions'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeDistrict(Request $request)
    {
        $request->validate([
            'division_id' => 'required',
            'district_name' => 'required',
        ]);
        
        $district = new District();
        $district->division_id = $request->division_id;
        $district->district_name = $request->district_name;
        $district->save();
        
        $notification=array(
            'message'=>'Added Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editDistrict($id)
    {
        $district = District::findOrFail($id);
        return view('backend.pages.districts.edit', compact('distric'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateDistrict(Request $request, $id)
    {
        $request->validate([
            'division_id' => 'required',
            'district_name' => 'required',
        ]);
        
        $district = District::findOrFail($id);
        $district->division_id = $request->division_id;
        $district->district_name = $request->district_name;
        $district->save();
        
        $notification=array(
            'message'=>'Updated Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('admin.districts')->with($notification);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteDistrict(Request $request)
    {
        $district = District::find($request->id);
        if(!is_null($district)){
            $district->delete();
        }
        
        $notification=array(
            'message'=>'District Deleted Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
    
    //State Methos
    
    public function indexState()
    {
        $states = State::orderBy('id','DESC')->get();
        return view('backend.pages.states.index', compact('states'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createState()
    {
        $divisions = Division::orderBy('name','ASC')->get();
        return view('backend.pages.states.create', compact('divisions'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDistrict($id)
    {
        $ship = District::where('division_id', $id)->orderBy('district_name', 'ASC')->get();
        return json_encode($ship);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeState(Request $request)
    {
        $request->validate([
            'division_id' => 'required',
            'district_id' => 'required',
            'state_name' => 'required',
        ]);
        
        $state = new State();
        $state->division_id = $request->division_id;
        $state->district_id = $request->district_id;
        $state->state_name = $request->state_name;
        $state->save();
        
        $notification=array(
            'message'=>'Added Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editState($id)
    {
        $state = State::findOrFail($id);
        $divisions = Division::orderBy('name','ASC')->get();
        return view('backend.pages.states.edit', compact('state', 'divisions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateState(Request $request, $id)
    {
        $request->validate([
            'division_id' => 'required',
            'district_id' => 'required',
            'state_name' => 'required',
        ]);
        
        $state = State::findOrFail($id);
        $state->division_id = $request->division_id;
        $state->district_id = $request->district_id;
        $state->state_name = $request->state_name;
        $state->save();
        
        $notification=array(
            'message'=>'Updated Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('admin.states')->with($notification);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteState(Request $request)
    {
        $state = State::find($request->id);
        if(!is_null($state)){
            $state->delete();
        }
        
        $notification=array(
            'message'=>'State Deleted Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}
