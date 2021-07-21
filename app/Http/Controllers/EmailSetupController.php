<?php

namespace App\Http\Controllers;

use App\Models\EmailSetup;
use Illuminate\Http\Request;
use DataTables;

class EmailSetupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = EmailSetup::orderByDesc('id')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<a href="'.route('email-setup.edit',$row->id).'" title="Edit" class="btn btn-info btn-sm"><i class="fal fa-edit"></i></a> <a href="'.route('email-setup.destroy',$row->id).'" class="edit btn btn-danger btn-sm" onclick="return confirm_delete('.$row->id.')" title="Delete"><i class="fal fa-trash"></i></a><form id="delete_form_'.$row->id.'" action="'.route('email-setup.destroy',$row->id).'" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                </form>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        $title = 'Email Setup List';
        $menu = 'Email Settings';
        return view('backend.email-setup.index',compact('title','menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Email Setup Add';
        $menu = 'Email Settings';
        return view('backend.email-setup.create',compact('title','menu'));
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
            'name' => 'required|max:255|unique:email_setups,name',
            'subject' => 'required|max:255',
            'body' => 'required',
        ]);
        $emailSetup = new EmailSetup();
        $emailSetup->name = $request->name;
        $emailSetup->subject = $request->subject;
        $emailSetup->body = $request->body;
        $emailSetup->save();
        return redirect()->route('email-setup.index')->with('success','Email setup is saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmailSetup  $emailSetup
     * @return \Illuminate\Http\Response
     */
    public function show(EmailSetup $emailSetup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmailSetup  $emailSetup
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $title = 'Email Setup Edit';
        $menu = 'Email Settings';
        $emailSetup = EmailSetup::findOrFail($id);
        return view('backend.email-setup.edit',compact('title','menu','emailSetup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmailSetup  $emailSetup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required|max:255|unique:email_setups,name,'.$id,
            'subject' => 'required|max:255',
            'body' => 'required',
        ]);
        // dd($request);
        $updateData = array(
            'name' => $request->name,
            'subject' => $request->subject,
            'body' => $request->body,
        );
        EmailSetup::where('id',$id)->update($updateData);
        return back()->with('success','Email setup is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmailSetup  $emailSetup
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        EmailSetup::findOrFail($id)->delete();
        return back('/email-setup')->with('success','Email setup is deleted successfully!');
    }
}
