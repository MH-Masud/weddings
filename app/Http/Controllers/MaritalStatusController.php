<?php

namespace App\Http\Controllers;

use App\Models\MaritalStatus;
use Illuminate\Http\Request;
use DataTables;

class MaritalStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = MaritalStatus::orderByDesc('id')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<a href="'.route('marital-status.edit',$row->id).'" title="Edit" class="btn btn-info btn-sm"><i class="fal fa-edit"></i></a> <a href="'.route('marital-status.destroy',$row->id).'" class="edit btn btn-danger btn-sm" onclick="return confirm_delete('.$row->id.')" title="Delete"><i class="fal fa-trash"></i></a><form id="delete_form_'.$row->id.'" action="'.route('marital-status.destroy',$row->id).'" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                </form>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        $title = 'Marital Status List';
        $menu = 'Profile Attributes';
        return view('backend.marital-status.index',compact('title','menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Marital Status Add';
        $menu = 'Profile Attributes';
        return view('backend.marital-status.create',compact('title','menu'));
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
            'name' => 'required|max:100|unique:marital_statuses,name',
        ]);
        $maritalStatus = new MaritalStatus();
        $maritalStatus->name = $request->name;
        $maritalStatus->save();
        return redirect()->route('marital-status.index')->with('success','Marital status is saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MaritalStatus  $maritalStatus
     * @return \Illuminate\Http\Response
     */
    public function show(MaritalStatus $maritalStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MaritalStatus  $maritalStatus
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $title = 'Marital Status Edit';
        $menu = 'Profile Attributes';
        $maritalStatus = MaritalStatus::findOrFail($id);
        return view('backend.marital-status.edit',compact('title','menu','maritalStatus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MaritalStatus  $maritalStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required|max:100|unique:marital_statuses,name,'.$id,
        ]);
        $updateData = array(
            'name' => $request->name
        );
        MaritalStatus::where('id',$id)->update($updateData);
        return back()->with('success','Marital status is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MaritalStatus  $maritalStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        MaritalStatus::findOrFail($id)->delete();
        return back()->with('success','Marital status is deleted successfully!');
    }
}
