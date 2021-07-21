<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use Illuminate\Http\Request;
use DataTables;

class FollowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Follow::orderByDesc('id')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('image', function($row){
                           $image = json_decode($row->image);
                           if ($image) {
                               $btn = '<img src="'.asset('uploads/follow_image/'.$image[0]->thumb).'" title="'.$row->title.'" alt="'.$row->title.'" width="100" height="100">';
                           } else {
                               $btn = '';
                           }
                            return $btn;
                    })
                    ->addColumn('action', function($row){
                           $btn = '<a href="'.route('follow.edit',$row->id).'" title="Edit" class="btn btn-info btn-sm"><i class="fal fa-edit"></i></a> <a href="'.route('follow.destroy',$row->id).'" class="edit btn btn-danger btn-sm" onclick="return confirm_delete('.$row->id.')" title="Delete"><i class="fal fa-trash"></i></a><form id="delete_form_'.$row->id.'" action="'.route('follow.destroy',$row->id).'" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                </form>';
                            return $btn;
                    })
                    ->rawColumns(['image','action'])
                    ->make(true);
        }
        $title = 'Follow List';
        $menu = 'Extra Settings';
        return view('backend.follow.index',compact('title','menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Follow Add';
        $menu = 'Extra Settings';
        return view('backend.follow.create',compact('title','menu'));
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
            'image' => 'required|image|mimes:png,jpg,jpeg',
            'link' => 'required'
        ]);
        if ($request->file('image')) {
            $image = $this->uploadImage($request->file('image'), 'uploads/follow_image', 50, 50, 50, 50);
        }else{
            $image = null;
        }
        $follow = new Follow();
        $follow->title = $request->title;
        $follow->image = $image;
        $follow->link = $request->link;
        $follow->save();
        return redirect()->route('follow.index')->with('success','Follow is saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Follow  $follow
     * @return \Illuminate\Http\Response
     */
    public function show(Follow $follow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Follow  $follow
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Follow Edit';
        $menu = 'Extra Settings';
        $follow = Follow::findOrFail($id);
        return view('backend.follow.edit',compact('title','menu','follow'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Follow  $follow
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' => 'required|max:255',
            'image' => 'image|mimes:png,jpg,jpeg',
            'link' => 'required'
        ]);
        $oldImage = json_decode(Follow::where('id',$id)->value('image'));
        if ($request->file('image')) {
            $image = $this->uploadImage($request->file('image'), 'uploads/follow_image', 50, 50, 50, 50);
            @unlink('uploads/follow_image/'.$oldImage[0]->image);
            @unlink('uploads/follow_image/'.$oldImage[0]->thumb);
            $updateData = array(
                'title' => $request->title,
                'image' => $image,
                'link' => $request->link,
            );
        }else{
            $updateData = array(
                'title' => $request->title,
                'link' => $request->link,
            );
        }
        Follow::where('id',$id)->update($updateData);
        return back()->with('success','Follow is updated successfully!');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Follow  $follow
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $oldImage = json_decode(Follow::where('id',$id)->value('image'));
        @unlink('uploads/follow_image/'.$oldImage[0]->image);
        @unlink('uploads/follow_image/'.$oldImage[0]->thumb);
        Follow::findOrFail($id)->delete();
        return back()->with('success','Follow is deleted successfully!');
    }
}
