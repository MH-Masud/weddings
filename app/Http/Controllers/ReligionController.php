<?php

namespace App\Http\Controllers;

use App\Models\Religion;
use Illuminate\Http\Request;
use DataTables;

class ReligionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Religion::orderByDesc('id')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<a href="'.route('religion.edit',$row->id).'" title="Edit" class="btn btn-info btn-sm"><i class="fal fa-edit"></i></a> <a href="'.route('religion.destroy',$row->id).'" class="edit btn btn-danger btn-sm" onclick="return confirm_delete('.$row->id.')" title="Delete"><i class="fal fa-trash"></i></a><form id="delete_form_'.$row->id.'" action="'.route('religion.destroy',$row->id).'" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                </form>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        $title = 'Religion List';
        $menu = 'Profile Attributes';
        return view('backend.religion.index',compact('title','menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Add Religion';
        $menu = 'Profile Attributes';
        return view('backend.religion.create',compact('title','menu'));
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
            'name' => 'required|unique:religions|max:20'
        ]);
        $religion = new Religion();
        $religion->name = $request->name;
        $religion->save();
        return back()->with('success','Religion is saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Religion  $religion
     * @return \Illuminate\Http\Response
     */
    public function show(Religion $religion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Religion  $religion
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $religion = Religion::findOrFail($id);
        $title = 'Edit Religion';
        $menu = 'Profile Attributes';
        return view('backend.religion.edit',compact('title','menu','religion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Religion  $religion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required|max:20|unique:religions,name,'.$id
        ]);
        $updateData = array(
            'name' => $request->name
        );
        Religion::where('id',$id)->update($updateData);
        return back()->with('success','Religion is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Religion  $religion
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        Religion::findOrFail($id)->delete();
        return back()->with('success','Religion is deleted successfully!');
    }
}
