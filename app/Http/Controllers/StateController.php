<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use DataTables;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = State::orderByDesc('id')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('country_id', function($row){
                        $countryName = Country::where('id',$row->country_id)->value('name');
                           $btn = '<span>'.$countryName.'</span>';
                            return $btn;
                    })
                    ->addColumn('action', function($row){
                           $btn = '<a href="'.route('state.edit',$row->id).'" title="Edit" class="btn btn-info btn-sm"><i class="fal fa-edit"></i></a> <a href="'.route('state.destroy',$row->id).'" class="edit btn btn-danger btn-sm" onclick="return confirm_delete('.$row->id.')" title="Delete"><i class="fal fa-trash"></i></a><form id="delete_form_'.$row->id.'" action="'.route('state.destroy',$row->id).'" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                </form>';
                            return $btn;
                    })
                    ->rawColumns(['action','country_id'])
                    ->make(true);
        }
        $title = 'State List';
        $menu = 'Profile Attributes';
        return view('backend.state.index',compact('title','menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'State Add';
        $menu = 'Profile Attributes';
        $country = Country::get();
        return view('backend.state.create',compact('title','menu','country'));
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
            'name' => 'required|max:50|unique:states,name',
            'country_id' => 'required|integer',
        ]);
        $state = new State();
        $state->name = $request->name;
        $state->country_id = $request->country_id;
        $state->save();
        return redirect()->route('state.index')->with('success','State is saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $title = 'State Edit';
        $state = State::findOrFail($id);
        $menu = 'Profile Attributes';
        $country = Country::get();
        return view('backend.state.edit',compact('title','menu','state','country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required|max:50|unique:states,name,'.$id,
            'country_id' => 'required|integer',
        ]);
        $updateData = array(
            'name' => $request->name,
            'country_id' => $request->country_id,
        );
        State::where('id',$id)->update($updateData);
        return back()->with('success','State is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        State::findOrFail($id)->delete();
        return back()->with('success','State is deleted successfully!');
    }
}
