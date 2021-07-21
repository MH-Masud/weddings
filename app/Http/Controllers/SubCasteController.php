<?php

namespace App\Http\Controllers;

use App\Models\Caste;
use App\Models\SubCaste;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;

class SubCasteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = SubCaste::orderByDesc('id')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<a href="'.route('sub-caste.edit',$row->id).'" title="Edit" class="btn btn-info btn-sm"><i class="fal fa-edit"></i></a> <a href="'.route('sub-caste.destroy',$row->id).'" class="edit btn btn-danger btn-sm" onclick="return confirm_delete('.$row->id.')" title="Delete"><i class="fal fa-trash"></i></a><form id="delete_form_'.$row->id.'" action="'.route('sub-caste.destroy',$row->id).'" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                </form>';
                            return $btn;
                    })
                    ->addColumn('caste_id', function($row){
                            $religionName =  DB::table('castes')->where('id',$row->caste_id)->value('name');
                            $btn = '<span>'.$religionName.'</span>';
                            return $btn;
                    })
                    ->rawColumns(['action','caste_id'])
                    ->make(true);
        }
        $title = 'Sub Caste List';
        $menu = 'Profile Attributes';
        return view('backend.sub-caste.index',compact('title','menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Sub Caste Add';
        $caste = Caste::get();
        $menu = 'Profile Attributes';
        return view('backend.sub-caste.create',compact('title','menu','caste'));
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
            'name' => 'required|max:20|unique:sub_castes',
            'caste_id' => 'required'
        ]);
        $subCaste = new SubCaste();
        $subCaste->name = $request->name;
        $subCaste->caste_id = $request->caste_id;
        $subCaste->save();
        return redirect()->route('sub-caste.index')->with('success','Sub Caste is saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCaste  $subCaste
     * @return \Illuminate\Http\Response
     */
    public function show(SubCaste $subCaste)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCaste  $subCaste
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $title = 'Sub Caste Edit';
        $subCaste = SubCaste::findOrFail($id);
        $caste = Caste::get();
        $menu = 'Profile Attributes';
        return view('backend.sub-caste.edit',compact('title','menu','caste','subCaste'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubCaste  $subCaste
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required|max:20|unique:sub_castes,name,'.$id,
            'caste_id' => 'required'
        ]);
        $updateData = array(
            'name' => $request->name,
            'caste_id' => $request->caste_id
        );
        SubCaste::where('id',$id)->update($updateData);
        return back()->with('success','Sub Caste is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCaste  $subCaste
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        SubCaste::findOrFail($id)->delete();
        return back()->with('success','Sub Caste is deleted successfully!');
    }
}
