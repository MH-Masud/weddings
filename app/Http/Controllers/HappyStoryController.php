<?php

namespace App\Http\Controllers;

use App\Models\HappyStory;
use App\Models\Member;
use Illuminate\Http\Request;
use DataTables;

class HappyStoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = HappyStory::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('first_name', function($row){
                            $firstName = Member::where('id',$row->posted_by)->value('first_name');
                            $btn = '<span>'.$firstName.'</span>';
                            return $btn;
                    })
                    ->addColumn('created_at', function($row){
                            $btn = '<span>'.date('jS \\of F Y h:i:s A', strtotime($row->created_at)).'</span>';
                            return $btn;
                    })
                    ->addColumn('image1', function($row){
                            $images = json_decode($row->image1);
                            if ($images) {
                                $btn = '<img alt="'.$row->first_name.'" title="'.$row->first_name.'" src="'.asset('uploads/happy_story_image').'/'.$images[0]->thumb.'" width="100" height="100">';
                            }else{
                                $btn = '';
                            }
                            return $btn;
                    })
                    ->addColumn('image2', function($row){
                            $images = json_decode($row->image2);
                            if ($images) {
                                $btn = '<img alt="'.$row->first_name.'" title="'.$row->first_name.'" src="'.asset('uploads/happy_story_image').'/'.$images[0]->thumb.'" width="100" height="100">';
                            }else{
                                $btn = '';
                            }
                            return $btn;
                    })
                    ->addColumn('action', function($row){
                           if ($row->approval_status == 'yes') {
                                $btn = '<a href="javascript:void(0)" onclick="return unpublish_story('.$row->id.')" class="edit btn btn-dark btn-sm" title="Unpublish"><i class="fal fa-times"></i></a> ';
                           } else {
                                $btn = '<a href="javascript:void(0)" onclick="return publish_story('.$row->id.')" class="edit btn btn-dark btn-sm" title="Publish"><i class="fal fa-check"></i></a> ';
                           }
                           $btn .= '<a href="'.route('happy-story.edit',$row->id).'" title="Edit" class="edit btn btn-info btn-sm"><i class="fal fa-edit"></i></a> <a href="'.route('happy-story.destroy',$row->id).'" class="edit btn btn-danger btn-sm" onclick="return confirm_delete('.$row->id.')" title="Delete"><i class="fal fa-trash"></i></a><form id="delete_form_'.$row->id.'" action="'.route('happy-story.destroy',$row->id).'" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                </form>';
                            return $btn;
                    })
                    ->rawColumns(['created_at','first_name','image1','image2','action'])
                    ->make(true);
        }
        $title = 'Happy Story List';
        $menu = 'Frontend Settings';
        return view('backend.happy-story.index',compact('title','menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Happy Story Add';
        $menu = 'Frontend Settings';
        return view('backend.happy-story.create',compact('title','menu'));
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
            'title' => 'required',
            'image1' => 'required|image|mimes:png,jpg,jpeg',
            'image2' => 'image|mimes:png,jpg,jpeg',
            'partner_name' => 'required',
            'posted_by' => 'required|integer',
        ]);
        if ($request->file('image1')) {
            $image1 = $this->uploadImage($request->file('image1'), 'uploads/happy_story_image', 400, 400, 400, 400);
        } else {
            $image1 = null;
        }
        if ($request->file('image2')) {
            $image2 = $this->uploadImage($request->file('image2'), 'uploads/happy_story_image', 400, 400, 400, 400);
        } else {
            $image2 = null;
        }
        date_default_timezone_set($request->timezone);
        $happyStory = new HappyStory();
        $happyStory->title = $request->title;
        $happyStory->description = $request->description;
        $happyStory->image1 = $image1;
        $happyStory->image2 = $image2;
        $happyStory->partner_name = $request->partner_name;
        $happyStory->posted_by = $request->posted_by;
        $happyStory->approval_status = 'yes';
        $happyStory->save();
        return redirect()->route('happy-story.index')->with('success','Happy Story is saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HappyStory  $happyStory
     * @return \Illuminate\Http\Response
     */
    public function show(HappyStory $happyStory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HappyStory  $happyStory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Happy Story Edit';
        $menu = 'Frontend Settings';
        $happyStory = HappyStory::findOrFail($id);
        return view('backend.happy-story.edit',compact('title','menu','happyStory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HappyStory  $happyStory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' => 'required',
            'image1' => 'image|mimes:png,jpg,jpeg',
            'image2' => 'image|mimes:png,jpg,jpeg',
            'partner_name' => 'required',
            'posted_by' => 'required|integer',
        ]);
        // dd($request);
        $happyStory = HappyStory::where('id',$id)->select('image1','image2')->first();
        $img1 = [];
        if ($request->file('image1')) {
            $image1 = $this->uploadImage($request->file('image1'), 'uploads/happy_story_image', 400, 400, 400, 400);
            $image1_old = json_decode($happyStory->image1);
            @unlink('uploads/happy_story_image/'.$image1_old[0]->image);
            @unlink('uploads/happy_story_image/'.$image1_old[0]->thumb);

            $img1 = array(
                'image1' => $image1,
            );
        }else{
            $img1 = array(
            );
        }
        $img2 = [];
        if ($request->file('image2')) {
            $image2 = $this->uploadImage($request->file('image2'), 'uploads/happy_story_image', 400, 400, 400, 400);
            $image2_old = json_decode($happyStory->image2);
            @unlink('uploads/happy_story_image/'.$image2_old[0]->image);
            @unlink('uploads/happy_story_image/'.$image2_old[0]->thumb);

            $img2 = array(
                'image2' => $image2,
            );
        }else{
            $img2 = array(
            );
        }
        $updateInfo = array(
            'title' => $request->title,
            'description' => $request->description,
            'partner_name' => $request->partner_name,
            'posted_by' => $request->posted_by,
            'approval_status' => $request->approval_status,
        );
        $updateData = array_merge($updateInfo,$img1,$img2);
        date_default_timezone_set($request->timezone);
        HappyStory::where('id',$id)->update($updateData);
        return back()->with('success','Happy story is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HappyStory  $happyStory
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $happyStory = HappyStory::where('id',$id)->select('image1','image2')->first();
        $image1 = json_decode($happyStory->image1);
        $image2 = json_decode($happyStory->image2);

        @unlink('uploads/happy_story_image/'.$image1[0]->image);
        @unlink('uploads/happy_story_image/'.$image1[0]->thumb);

        @unlink('uploads/happy_story_image/'.$image2[0]->image);
        @unlink('uploads/happy_story_image/'.$image2[0]->thumb);
        
        HappyStory::findOrFail($id)->delete();
        return back()->with('success','Happy story is deleted successfully!');
    }
}
