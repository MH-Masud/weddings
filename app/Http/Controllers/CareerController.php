<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;
use DataTables;

class CareerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Career::orderByDesc('id')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<a href="'.route('career.edit',$row->id).'" title="Edit" class="btn btn-info btn-sm"><i class="fal fa-edit"></i></a> <a href="'.route('career.destroy',$row->id).'" class="edit btn btn-danger btn-sm" onclick="return confirm_delete('.$row->id.')" title="Delete"><i class="fal fa-trash"></i></a><form id="delete_form_'.$row->id.'" action="'.route('career.destroy',$row->id).'" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                </form>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        $title = 'Career List';
        $menu = 'Extra Settings';
        return view('backend.career.index',compact('title','menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Career Add';
        $menu = 'Extra Settings';
        return view('backend.career.create',compact('title','menu'));
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
            'title' => 'required|max:255',
            'description' => 'required',
        ]);
        $career = new Career();
        $career->title = $request->title;
        $career->description = $request->description;
        $career->save();
        return redirect()->route('career.index')->with('success','Career is saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function show(Career $career)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Career Edit';
        $menu = 'Extra Settings';
        $career = Career::findOrFail($id);
        return view('backend.career.edit',compact('title','menu','career'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' => 'required|max:255',
            'description' => 'required',
        ]);
        $updateData = array(
            'title' => $request->title,
            'description' => $request->description,
        );
        Career::where('id',$id)->update($updateData);
        return back()->with('success','Career is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Career::findOrFail($id)->delete();
        return back()->with('success','Career is deleted successfully!');
    }
}
