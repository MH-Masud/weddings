<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use DataTables;


class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Country::orderByDesc('id')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<a href="'.route('country.edit',$row->id).'" title="Edit" class="btn btn-info btn-sm"><i class="fal fa-edit"></i></a> <a href="'.route('country.destroy',$row->id).'" class="edit btn btn-danger btn-sm" onclick="return confirm_delete('.$row->id.')" title="Delete"><i class="fal fa-trash"></i></a><form id="delete_form_'.$row->id.'" action="'.route('country.destroy',$row->id).'" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                </form>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        $title = 'Country List';
        $menu = 'Profile Attributes';
        return view('backend.country.index',compact('title','menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Country Add';
        $menu = 'Profile Attributes';
        return view('backend.country.create',compact('title','menu'));
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
            'sortname' => 'required|max:50|unique:countries,sortname',
            'name' => 'required|max:50|unique:countries,name',
            'phonecode' => 'required|integer|unique:countries,phonecode'
        ]);
        $country = new Country();
        $country->sortname = $request->sortname;
        $country->name = $request->name;
        $country->phonecode = $request->phonecode;
        $country->save();
        return redirect()->route('country.index')->with('success','Country is saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $country = Country::findOrFail($id);
        $title = 'Country Edit';
        $menu = 'Profile Attributes';
        return view('backend.country.edit',compact('title','menu','country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'sortname' => 'required|max:50|unique:countries,sortname,'.$id,
            'name' => 'required|max:50|unique:countries,name,'.$id,
            'phonecode' => 'required|integer|unique:countries,phonecode,'.$id
        ]);
        $updateData = array(
            'sortname' => $request->sortname,
            'name' => $request->name,
            'phonecode' => $request->phonecode,
        );
        Country::where('id',$id)->update($updateData);
        return back()->with('success','Country is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        Country::findOrFail($id)->delete();
        return back()->with('success','Country is deleted successfully!');
    }
}
