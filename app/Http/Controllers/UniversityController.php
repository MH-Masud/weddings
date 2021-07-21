<?php

namespace App\Http\Controllers;

use App\Models\University;
use Illuminate\Http\Request;
use DataTables;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = University::orderByDesc('id')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<a href="'.route('university.edit',$row->id).'" title="Edit" class="btn btn-info btn-sm"><i class="fal fa-edit"></i></a> <a href="'.route('university.destroy',$row->id).'" class="edit btn btn-danger btn-sm" onclick="return confirm_delete('.$row->id.')" title="Delete"><i class="fal fa-trash"></i></a><form id="delete_form_'.$row->id.'" action="'.route('university.destroy',$row->id).'" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                </form>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        $title = 'University List';
        $menu = 'Profile Attributes';
        return view('backend.university.index',compact('title','menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'University Add';
        $menu = 'Profile Attributes';
        return view('backend.university.create',compact('title','menu'));
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
            'name' => 'required|max:255|unique:universities,name',
        ]);
        $university = new University();
        $university->name = $request->name;
        $university->save();
        return redirect()->route('university.index')->with('success','University is saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\University  $university
     * @return \Illuminate\Http\Response
     */
    public function show(University $university)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\University  $university
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $title = 'University Edit';
        $menu = 'Profile Attributes';
        $university = University::findOrFail($id);
        return view('backend.university.edit',compact('title','menu','university'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\University  $university
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required|max:255|unique:universities,name,'.$id,
        ]);
        $updateData = array(
            'name' => $request->name,
        );
        University::where('id',$id)->update($updateData);
        return back()->with('success','University is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\University  $university
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        University::findOrFail($id)->delete();
        return back()->with('success','University is deleted successfully!');
    }
}
