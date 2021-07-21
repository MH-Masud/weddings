<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;
use DataTables;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Education::orderByDesc('id')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<a href="'.route('education.edit',$row->id).'" title="Edit" class="btn btn-info btn-sm"><i class="fal fa-edit"></i></a> <a href="'.route('education.destroy',$row->id).'" class="edit btn btn-danger btn-sm" onclick="return confirm_delete('.$row->id.')" title="Delete"><i class="fal fa-trash"></i></a><form id="delete_form_'.$row->id.'" action="'.route('education.destroy',$row->id).'" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                </form>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        $title = 'Education List';
        $menu = 'Profile Attributes';
        return view('backend.education.index',compact('title','menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Education Add';
        $menu = 'Profile Attributes';
        return view('backend.education.create',compact('title','menu'));
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
            'name' => 'required|max:100|unique:education,name',
        ]);
        $education = new Education();
        $education->name = $request->name;
        $education->save();
        return redirect()->route('education.index')->with('success','Education is saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function show(Education $education)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $title = 'Education Edit';
        $menu = 'Profile Attributes';
        $education = Education::findOrFail($id);
        return view('backend.education.edit',compact('title','menu','education'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required|max:100|unique:education,name,'.$id,
        ]);
        $updateData = array(
            'name' => $request->name,
        );
        Education::where('id',$id)->update($updateData);
        return back()->with('success','Education is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        Education::findOrFail($id)->delete();
        return back()->with('success','Education is deleted successfully!');
    }
}
