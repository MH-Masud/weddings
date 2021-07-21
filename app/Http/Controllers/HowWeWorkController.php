<?php

namespace App\Http\Controllers;

use App\Models\HowWeWork;
use Illuminate\Http\Request;
use DataTables;

class HowWeWorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = HowWeWork::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('image', function($row){
                            $image = json_decode($row->image);
                            if ($image) {
                                $btn = '<img src="'.asset('uploads/how_we_work/'.$image[0]->image).'" title="icon'.$row->id.'" alt="icon'.$row->id.'" width="24" height="24">';
                            } else {
                                $btn = '';
                            }
                            return $btn;
                    })
                    ->addColumn('action', function($row){
                           $btn = '<a href="'.route('how-we-work.edit',$row->id).'" title="Edit" class="edit btn btn-info btn-sm">Edit</a> <a href="'.route('how-we-work.destroy',$row->id).'" class="edit btn btn-danger btn-sm" onclick="return confirm_delete('.$row->id.')" title="Delete">Delete</a><form id="delete_form_'.$row->id.'" action="'.route('how-we-work.destroy',$row->id).'" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                </form>';
                            return $btn;
                    })
                    ->rawColumns(['image','action'])
                    ->make(true);
        }
        $title = 'How We Work';
        $menu = "Frontend Settings";
        return view('backend.how-we-work.index',compact('title','menu'));
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
            'image' => 'required|image|mimes:png,jpg,jpeg',
            'title' => 'required|max:255',
            'description' => 'required'
        ]);
        if ($request->file('image')) {
            $image = $this->uploadImage($request->file('image'), 'uploads/how_we_work', 16,16);
        } else {
            $image = null;
        }
        $howWeWork = new HowWeWork();
        $howWeWork->title = $request->title;
        $howWeWork->description = $request->description;
        $howWeWork->image = $image;
        $howWeWork->save();
        return back()->with('success','How we work saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HowWeWork  $howWeWork
     * @return \Illuminate\Http\Response
     */
    public function show(HowWeWork $howWeWork)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HowWeWork  $howWeWork
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $howWeWork = HowWeWork::findOrFail($id);
        $title = 'Edit How We Work';
        $menu = 'Frontend Settings';
        return view('backend.how-we-work.edit',compact('title','menu','howWeWork'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HowWeWork  $howWeWork
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'image' => 'image|mimes:png,jpg,jpeg',
            'title' => 'required|max:255',
            'description' => 'required',
        ]);
        if ($request->file('image')) {
            $oldImage = json_decode(HowWeWork::where('id',$id)->value('image'));
            @unlink('uploads/how_we_work/'.$oldImage[0]->image);
            @unlink('uploads/how_we_work/'.$oldImage[0]->thumb);

            $image = $this->uploadImage($request->file('image'), 'uploads/how_we_work', 16,16);
            
            $updateInfo = array(
                'image' => $image,
                'title' => $request->title,
                'description' => $request->description,
            );

        } else {
            $updateInfo = array(
                'title' => $request->title,
                'description' => $request->description,
            );
        }
        
        HowWeWork::where('id',$id)->update($updateInfo);
        return back()->with('success','How we work updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HowWeWork  $howWeWork
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $oldImage = json_decode(HowWeWork::where('id',$id)->value('image'));
        @unlink('uploads/how_we_work/'.$oldImage[0]->image);
        @unlink('uploads/how_we_work/'.$oldImage[0]->thumb);
        HowWeWork::where('id',$id)->delete();
        return back()->with('success','How we work is deleted successfully!');
    }
}
