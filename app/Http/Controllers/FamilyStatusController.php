<?php

namespace App\Http\Controllers;

use App\Models\FamilyStatus;
use Illuminate\Http\Request;
use DataTables;

class FamilyStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = FamilyStatus::orderByDesc('id')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<a href="'.route('family-status.edit',$row->id).'" title="Edit" class="btn btn-info btn-sm"><i class="fal fa-edit"></i></a> <a href="'.route('family-status.destroy',$row->id).'" class="edit btn btn-danger btn-sm" onclick="return confirm_delete('.$row->id.')" title="Delete"><i class="fal fa-trash"></i></a><form id="delete_form_'.$row->id.'" action="'.route('family-status.destroy',$row->id).'" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                </form>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        $title = 'Family Status List';
        $menu = 'Profile Attributes';
        return view('backend.family-status.index',compact('title','menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Family Status Add';
        $menu = 'Profile Attributes';
        return view('backend.family-status.create',compact('title','menu'));
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
            'name' => 'required|max:100|unique:family_statuses,name'
        ]);
        $familyStatus = new FamilyStatus();
        $familyStatus->name = $request->name;
        $familyStatus->save();
        return redirect()->route('family-status.index')->with('success','Family status is saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FamilyStatus  $familyStatus
     * @return \Illuminate\Http\Response
     */
    public function show(FamilyStatus $familyStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FamilyStatus  $familyStatus
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Family Status Edit';
        $menu = 'Profile Attributes';
        $familyStatus = FamilyStatus::findOrFail($id);
        return view('backend.family-status.edit',compact('title','menu','familyStatus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FamilyStatus  $familyStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required|max:100|unique:family_statuses,name,'.$id
        ]);
        $updateData = array(
            'name' => $request->name,
        );
        FamilyStatus::where('id',$id)->update($updateData);
        return back()->with('success','Family status is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FamilyStatus  $familyStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        FamilyStatus::findOrFail($id)->delete();
        return back()->with('success','Family status is deleted successfully!');
    }
}
