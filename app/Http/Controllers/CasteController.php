<?php

namespace App\Http\Controllers;

use App\Models\Caste;
use App\Models\Religion;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;

class CasteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Caste::orderByDesc('id')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<a href="'.route('caste.edit',$row->id).'" title="Edit" class="btn btn-info btn-sm"><i class="fal fa-edit"></i></a> <a href="'.route('caste.destroy',$row->id).'" class="edit btn btn-danger btn-sm" onclick="return confirm_delete('.$row->id.')" title="Delete"><i class="fal fa-trash"></i></a><form id="delete_form_'.$row->id.'" action="'.route('caste.destroy',$row->id).'" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                </form>';
                            return $btn;
                    })
                    ->addColumn('religion_id', function($row){
                            $religionName = DB::table('religions')->where('id',$row->religion_id)->value('name');
                            $btn = '<span>'.$religionName.'</span>';
                            return $btn;
                    })
                    ->rawColumns(['action','religion_id'])
                    ->make(true);
        }
        $title = 'Caste List';
        $menu = 'Profile Attributes';
        return view('backend.caste.index',compact('title','menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Add Caste';
        $religion = Religion::get();
        $menu = 'Profile Attributes';
        return view('backend.caste.create',compact('title','menu','religion'));
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
            'name' => 'required|unique:castes|max:20',
            'religion_id' => 'required',
        ]);
        $caste = new Caste();
        $caste->name = $request->name;
        $caste->religion_id = $request->religion_id;
        $caste->save();
        return back()->with('success','Caste saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Caste  $caste
     * @return \Illuminate\Http\Response
     */
    public function show(Caste $caste)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Caste  $caste
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $title = 'Add Caste';
        $caste = Caste::where('id',$id)->first();
        $religion = Religion::get();
        $menu = 'Profile Attributes';
        return view('backend.caste.edit',compact('title','menu','religion','caste'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Caste  $caste
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required|max:20|unique:castes,name,'.$id,
            'religion_id' => 'required',
        ]);

        $updateData = array(
            'name' => $request->name,
            'religion_id' => $request->religion_id,
        );

        Caste::where('id',$id)->update($updateData);
        return back()->with('success','Caste is updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Caste  $caste
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        Caste::findOrFail($id)->delete();
        return back()->with('success','Caste is deleted successfully!');
    }
}
