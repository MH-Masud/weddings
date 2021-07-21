<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\State;
use App\Models\Country;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = City::orderByDesc('id')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('state_id', function($row){
                        $stateName = State::where('id',$row->state_id)->value('name');
                           $btn = '<span>'.$stateName.'</span>';
                            return $btn;
                    })
                    ->addColumn('action', function($row){
                           $btn = '<a href="'.route('city.edit',$row->id).'" title="Edit" class="btn btn-info btn-sm"><i class="fal fa-edit"></i></a> <a href="'.route('city.destroy',$row->id).'" class="edit btn btn-danger btn-sm" onclick="return confirm_delete('.$row->id.')" title="Delete"><i class="fal fa-trash"></i></a><form id="delete_form_'.$row->id.'" action="'.route('city.destroy',$row->id).'" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                </form>';
                            return $btn;
                    })
                    ->rawColumns(['action','state_id'])
                    ->make(true);
        }
        $title = 'City List';
        $menu = 'Profile Attributes';
        return view('backend.city.index',compact('title','menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'City Add';
        $menu = 'Profile Attributes';
        $country = Country::get();
        $state = State::get();
        return view('backend.city.create',compact('title','menu','state','country'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:100|unique:cities,name',
            'state_id' => 'required|integer',
            'country_id' => 'required|integer',
        ]);
        date_default_timezone_set($request->timezone);
        $city = new City();
        $city->name = $request->name;
        $city->postal_code = $request->postal_code;
        $city->state_id = $request->state_id;
        $city->save();
        return redirect()->route('city.index')->with('success','City is saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $title = 'City Edit';
        $city = City::findOrFail($id);
        $state = State::get();
        $country = Country::get();
        $menu = 'Profile Attributes';
        return view('backend.city.edit',compact('title','menu','city','state','country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required|max:100|unique:cities,name,'.$id,
            'state_id' => 'required|integer',
            'country_id' => 'required|integer',
        ]);
        date_default_timezone_set($request->timezone);
        $updateData = array(
            'name' => $request->name,
            'postal_code' => $request->postal_code,
            'state_id' => $request->state_id,
        );
        City::where('id',$id)->update($updateData);
        return back()->with('success','City is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        date_default_timezone_set('Asia/Dhaka');
        City::findOrFail($id)->delete();
        return back()->with('success','City is deleted successfully!');
    }
}
