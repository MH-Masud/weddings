<?php

namespace App\Http\Controllers;

use App\Models\OnBehalf;
use Illuminate\Http\Request;
use DataTables;

class OnBehalfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = OnBehalf::orderByDesc('id')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<a href="'.route('on-behalf.edit',$row->id).'" title="Edit" class="btn btn-info btn-sm"><i class="fal fa-edit"></i></a> <a href="'.route('on-behalf.destroy',$row->id).'" class="edit btn btn-danger btn-sm" onclick="return confirm_delete('.$row->id.')" title="Delete"><i class="fal fa-trash"></i></a><form id="delete_form_'.$row->id.'" action="'.route('on-behalf.destroy',$row->id).'" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                </form>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        $title = 'On Behalf List';
        $menu = 'Profile Attributes';
        return view('backend.on-behalf.index',compact('title','menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'On Behalf Add';
        $menu = 'Profile Attributes';
        return view('backend.on-behalf.create',compact('title','menu'));
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
            'name' => 'required|max:100|unique:on_behalves,name',
        ]);
        $onBehalf = new OnBehalf();
        $onBehalf->name = $request->name;
        $onBehalf->save();
        return redirect()->route('on-behalf.index')->with('success','On behalf is saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OnBehalf  $onBehalf
     * @return \Illuminate\Http\Response
     */
    public function show(OnBehalf $onBehalf)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OnBehalf  $onBehalf
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $title = 'On Behalf Edit';
        $menu = 'Profile Attributes';
        $onBehalf = OnBehalf::findOrFail($id);
        return view('backend.on-behalf.edit',compact('title','menu','onBehalf'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OnBehalf  $onBehalf
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required|max:100|unique:on_behalves,name',
        ]);
        $updateData = array(
            'name' => $request->name,
        );
        OnBehalf::where('id',$id)->update($updateData);
        return back()->with('success','On Behalf is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OnBehalf  $onBehalf
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        OnBehalf::findOrFail($id)->delete();
        return back()->with('success','On behalf is deleted successfully!');
    }
}
