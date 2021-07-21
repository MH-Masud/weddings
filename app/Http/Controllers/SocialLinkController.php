<?php

namespace App\Http\Controllers;

use App\Models\SocialLink;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use DataTables;

class SocialLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = SocialLink::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('image', function($row){
                            $image = json_decode($row->image);
                            if ($image) {
                                $btn = '<img src="'.asset('uploads/social_icon/'.$image[0]->image).'" title="icon'.$row->id.'" alt="icon'.$row->id.'" width="24" height="24">';
                            } else {
                                $btn = '';
                            }
                            return $btn;
                    })
                    ->addColumn('action', function($row){
                           $btn = '<a href="'.route('social-link.edit',$row->id).'" title="Edit" class="edit btn btn-info btn-sm">Edit</a> <a href="'.route('social-link.destroy',$row->id).'" class="edit btn btn-danger btn-sm" onclick="return confirm_delete('.$row->id.')" title="Delete">Delete</a><form id="delete_form_'.$row->id.'" action="'.route('social-link.destroy',$row->id).'" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                </form>';
                            return $btn;
                    })
                    ->rawColumns(['image','action'])
                    ->make(true);
        }
        $title = 'Social Links';
        $menu = "Company Settings";
        return view('backend.social_link.index',compact('title','menu'));
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
            'url' => 'required|max:255'
        ]);
        if ($request->file('image')) {
            $image = $this->uploadImage($request->file('image'), 'uploads/social_icon', 16,16);
        } else {
            $image = null;
        }
        $social_link = new SocialLink();
        $social_link->url = $request->url;
        $social_link->image = $image;
        $social_link->save();
        return back()->with('success','Socila link saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SocialLink  $socialLink
     * @return \Illuminate\Http\Response
     */
    public function show(SocialLink $socialLink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SocialLink  $socialLink
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $social_link = SocialLink::findOrFail($id);
        $title = 'Edit Social Link';
        $menu = 'Company Settings';
        return view('backend.social_link.edit',compact('title','menu','social_link'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SocialLink  $socialLink
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'image' => 'required|image|mimes:png,jpg,jpeg',
            'url' => 'required|max:255',
        ]);
        if ($request->file('image')) {
            $oldImage = json_decode(SocialLink::where('id',$id)->value('image'));
            @unlink('uploads/social_icon/'.$oldImage[0]->image);
            @unlink('uploads/social_icon/'.$oldImage[0]->thumb);

            $image = $this->uploadImage($request->file('image'), 'uploads/social_icon', 16,16);
        
            $updateInfo = array(
                'image' => $image,
                'url' => $request->url,
            );
        } else {
            $updateInfo = array(
                'url' => $request->url,
            );
        }
        
        SocialLink::where('id',$id)->update($updateInfo);
        return back()->with('success','Socila link updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SocialLink  $socialLink
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $oldImage = json_decode(SocialLink::where('id',$id)->value('image'));
        @unlink('uploads/social_icon/'.$oldImage[0]->image);
        @unlink('uploads/social_icon/'.$oldImage[0]->thumb);

        SocialLink::where('id',$id)->delete();
        return back()->with('success','Social link deleted successfully!');
    }
}
