<?php

namespace App\Http\Controllers;

use App\Models\Occupation;
use Illuminate\Http\Request;
use DataTables;

class OccupationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Occupation::orderByDesc('id')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<a href="'.route('occupation.edit',$row->id).'" title="Edit" class="btn btn-info btn-sm"><i class="fal fa-edit"></i></a> <a href="'.route('occupation.destroy',$row->id).'" class="edit btn btn-danger btn-sm" onclick="return confirm_delete('.$row->id.')" title="Delete"><i class="fal fa-trash"></i></a><form id="delete_form_'.$row->id.'" action="'.route('occupation.destroy',$row->id).'" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                </form>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        $title = 'Occupation List';
        $menu = 'Profile Attributes';
        return view('backend.occupation.index',compact('title','menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Occupation Add';
        $menu = 'Profile Attributes';
        return view('backend.occupation.create',compact('title','menu'));
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
            'name' => 'required|max:100|unique:occupations,name',
        ]);
        $occupation = new Occupation();
        $occupation->name = $request->name;
        $occupation->save();
        return redirect()->route('occupation.index')->with('success','Occupation is saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Occupation  $occupation
     * @return \Illuminate\Http\Response
     */
    public function show(Occupation $occupation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Occupation  $occupation
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $title = 'Occupation Edit';
        $menu = 'Profile Attributes';
        $occupation = Occupation::findOrFail($id);
        return view('backend.occupation.edit',compact('title','menu','occupation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Occupation  $occupation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $this->validate($request,[
            'name' => 'required|max:100|unique:occupations,name,'.$id,
        ]);
        $updateData = array(
            'name' => $request->name,
        );
        Occupation::where('id',$id)->update($updateData);
        return back()->with('success','Occupation is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Occupation  $occupation
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        Occupation::findOrFail($id)->delete();
        return back()->with('success','Occupation is successfully!');
    }
}
