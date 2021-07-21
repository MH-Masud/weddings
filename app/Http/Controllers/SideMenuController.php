<?php

namespace App\Http\Controllers;

use App\Models\SideMenu;
use Illuminate\Http\Request;
use DataTables;

class SideMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = SideMenu::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<a href="'.route('side-menu.edit',$row->id).'" title="Edit" class="edit btn btn-info btn-sm">Edit</a> <a href="'.route('side-menu.destroy',$row->id).'" class="edit btn btn-danger btn-sm" onclick="return confirm_delete('.$row->id.')" title="Delete">Delete</a><form id="delete_form_'.$row->id.'" action="'.route('side-menu.destroy',$row->id).'" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                </form>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        $title = 'Side Menu';
        $menu = "Frontend Settings";
        return view('backend.side-menu.index',compact('title','menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => 'required|max:255',
            'url' => 'required|max:255'
        ]);

        $sideMenu = new SideMenu();
        $sideMenu->name = $request->name;
        $sideMenu->url = $request->url;
        $sideMenu->save();

        return redirect()->route('side-menu.index')->with('success','Side menu is saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SideMenu  $sideMenu
     * @return \Illuminate\Http\Response
     */
    public function show(SideMenu $sideMenu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SideMenu  $sideMenu
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $title = 'Side Menu';
        $menu = "Frontend Settings";
        $sideMenu = SideMenu::findOrFail($id);
        return view('backend.side-menu.edit',compact('title','menu','sideMenu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SideMenu  $sideMenu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required|max:255',
            'url' => 'required|max:255'
        ]);

        $sideMenu = new SideMenu();
        $updateData = array(
            'name' => $request->name,
            'url' => $request->url,
        );
        SideMenu::where("id",$id)->update($updateData);

        return redirect()->route('side-menu.index')->with('success','Side menu is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SideMenu  $sideMenu
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        SideMenu::where('id',$id)->delete();
        return back()->with('success','Side menu is deleted successfully!');
    }
}
