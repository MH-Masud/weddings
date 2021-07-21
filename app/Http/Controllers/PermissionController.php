<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use DataTables;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:permission-list', ['only' => ['index','store']]);
         $this->middleware('permission:permission-create', ['only' => ['create','store']]);
         $this->middleware('permission:permission-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
         $this->middleware('permission:permission-show', ['only' => ['show']]);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Permission::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<a href="'.route('permission.edit',$row->id).'" title="Edit" class="edit btn btn-info btn-sm">Edit</a> <a href="'.route('permission.destroy',$row->id).'" class="edit btn btn-danger btn-sm" onclick="return confirm_delete('.$row->id.')" title="Delete">Delete</a><form id="delete_form_'.$row->id.'" action="'.route('permission.destroy',$row->id).'" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                </form>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        $title = 'Permission List';
        $menu = 'Admin Settings';
        $permissions = Permission::get();
        return view('backend.permission.index',compact('title','permissions','menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create Permission';
        $menu = 'Admin Settings';
        return view('backend.permission.create',compact('title','menu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:permissions',
        ]);
        $permission = new Permission();
        $permission->name = $request->name;
        $permission->guard_name	 = 'web';
        $permission->save();
        return redirect()->route('permission.index')->with('success', 'Permission Created Successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Edit Permission';
        $menu = 'Admin Settings';
        $permission = Permission::findOrFail($id);
        return view('backend.permission.edit',compact('title','permission','menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255|unique:permissions,name,'.$id,
        ]);
        $input = $request->all('name');
        $user = Permission::where('id',$id)->update($input);
        return redirect()->route('permission.index')->with('success', 'Permission is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        Permission::findOrFail($id)->delete();
        return back()->with('success', 'Permission deleted successfully!');
    }
}
