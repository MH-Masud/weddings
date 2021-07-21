<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;
use DataTables;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Income::orderByDesc('id')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<a href="'.route('income.edit',$row->id).'" title="Edit" class="btn btn-info btn-sm"><i class="fal fa-edit"></i></a> <a href="'.route('income.destroy',$row->id).'" class="edit btn btn-danger btn-sm" onclick="return confirm_delete('.$row->id.')" title="Delete"><i class="fal fa-trash"></i></a><form id="delete_form_'.$row->id.'" action="'.route('income.destroy',$row->id).'" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                </form>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        $title = 'Income List';
        $menu = 'Profile Attributes';
        return view('backend.income.index',compact('title','menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Income Add';
        $menu = 'Profile Attributes';
        return view('backend.income.create',compact('title','menu'));
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
            'name' => 'required|max:255|unique:incomes,name',
        ]);
        $income = new Income();
        $income->name = $request->name;
        $income->save();
        return redirect()->route('income.index')->with('success','Income is saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function show(Income $income)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $title = 'Income Edit';
        $menu = 'Profile Attributes';
        $income = Income::findOrFail($id);
        return view('backend.income.edit',compact('title','menu','income'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required|max:255|unique:incomes,name,'.$id,
        ]);
        $updateData = array(
            'name' => $request->name,
        );
        Income::where('id',$id)->update($updateData);
        return back()->with('success','Income is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        Income::findOrFail($id)->delete();
        return back()->with('success','Income is deleted successfully!');
    }
}
