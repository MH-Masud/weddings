<?php

namespace App\Http\Controllers;

use App\Models\FamilyValue;
use Illuminate\Http\Request;
use DataTables;

class FamilyValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = FamilyValue::orderByDesc('id')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<a href="'.route('family-value.edit',$row->id).'" title="Edit" class="btn btn-info btn-sm"><i class="fal fa-edit"></i></a> <a href="'.route('family-value.destroy',$row->id).'" class="edit btn btn-danger btn-sm" onclick="return confirm_delete('.$row->id.')" title="Delete"><i class="fal fa-trash"></i></a><form id="delete_form_'.$row->id.'" action="'.route('family-value.destroy',$row->id).'" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                </form>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        $title = 'Family Value List';
        $menu = 'Profile Attributes';
        return view('backend.family-value.index',compact('title','menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Family Value Add';
        $menu = 'Profile Attributes';
        return view('backend.family-value.create',compact('title','menu'));
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
            'name' => 'required|max:100|unique:family_values,name',
        ]);
        $familyValue = new FamilyValue();
        $familyValue->name = $request->name;
        $familyValue->save();
        return redirect()->route('family-value.index')->with('success','Family value is saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FamilyValue  $familyValue
     * @return \Illuminate\Http\Response
     */
    public function show(FamilyValue $familyValue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FamilyValue  $familyValue
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Family Value Edit';
        $menu = 'Profile Attributes';
        $familyValue = FamilyValue::findOrFail($id);
        return view('backend.family-value.edit',compact('title','menu','familyValue'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FamilyValue  $familyValue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required|max:100|unique:family_values,name,'.$id,
        ]);
        $updateData = array(
            'name' => $request->name,
        );
        FamilyValue::where('id',$id)->update($updateData);
        return back()->with('success','Family value is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FamilyValue  $familyValue
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        FamilyValue::findOrFail($id)->delete();
        return back()->with('success','Family value is deleted successfully!');
    }
}
