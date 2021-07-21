<?php

namespace App\Http\Controllers;

use App\Models\FooterLink;
use Illuminate\Http\Request;
use DataTables;

class FooterLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = FooterLink::orderByDesc('id')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('image', function($row){
                           $image = json_decode($row->image);
                           if ($image) {
                               $btn = '<img src="'.asset('uploads/footer_link_image/'.$image[0]->thumb).'" title="'.$row->slug.'" alt="'.$row->slug.'" width="100" height="100">';
                           } else {
                               $btn = '';
                           }
                            return $btn;
                    })
                    ->addColumn('parent', function($row){
                           $parentName = FooterLink::where('id',$row->parent)->value('name');
                           if ($parentName) {
                               $parent = '<span>'.$parentName.'</span>';
                           } else {
                               $parent = '';
                           }
                            return $parent;
                    })
                    ->addColumn('action', function($row){
                           $btn = '<a href="'.route('footer-link.edit',$row->id).'" title="Edit" class="btn btn-info btn-sm"><i class="fal fa-edit"></i></a> <a href="'.route('footer-link.destroy',$row->id).'" class="edit btn btn-danger btn-sm" onclick="return confirm_delete('.$row->id.')" title="Delete"><i class="fal fa-trash"></i></a><form id="delete_form_'.$row->id.'" action="'.route('footer-link.destroy',$row->id).'" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                </form>';
                            return $btn;
                    })
                    ->rawColumns(['image','action','parent'])
                    ->make(true);
        }
        $title = 'Footer Link List';
        $menu = 'Extra Settings';
        return view('backend.footer-link.index',compact('title','menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Add Footer Link Page';
        $menu = 'Extra Settings';
        $parents = FooterLink::whereNull('parent')->get();
        return view('backend.footer-link.create',compact('title','menu','parents'));
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
            'name' => 'required|max:255|unique:footer_links,name',
            'slug' => 'required|max:255|unique:footer_links,slug',
            'image' => 'image|mimes:png,jpg,jpeg',
        ]);
        if ($request->file('image')) {
            $image = $this->uploadImage($request->file('image'), 'uploads/footer_link_image', 1364, 650, 1364, 650);
        } else {
            $image = null;
        }
        $footerLink = new FooterLink();
        $footerLink->name = $request->name;
        $footerLink->slug = $request->slug;
        $footerLink->parent = $request->parent;
        $footerLink->image = $image;
        $footerLink->short_description = $request->short_description;
        $footerLink->long_description = $request->long_description;
        $footerLink->save();
        return redirect()->route('footer-link.index')->with('success','Footer link is saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FooterLink  $footerLink
     * @return \Illuminate\Http\Response
     */
    public function show(FooterLink $footerLink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FooterLink  $footerLink
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Edit Footer Link Page';
        $menu = 'Extra Settings';
        $parents = FooterLink::whereNull('parent')->get();
        $footerLink = FooterLink::findOrFail($id);
        return view('backend.footer-link.edit',compact('title','menu','parents','footerLink'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FooterLink  $footerLink
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required|max:255|unique:footer_links,name,'.$id,
            'slug' => 'required|max:255|unique:footer_links,slug,'.$id,
            'image' => 'image|mimes:png,jpg,jpeg',
        ]);
        $oldImage = json_decode(FooterLink::where('id',$id)->value('image'));
        if ($request->file('image')) {
            $image = $this->uploadImage($request->file('image'), 'uploads/footer_link_image', 1364, 650, 1364, 650);
            @unlink('uploads/footer_link_image/'.$oldImage[0]->image);
            @unlink('uploads/footer_link_image/'.$oldImage[0]->thumb);

            $updateData = array(
                'name' => $request->name,
                'slug' => $request->slug,
                'parent' => $request->parent,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'image' => $image,
            );
        } else {
            $updateData = array(
                'name' => $request->name,
                'slug' => $request->slug,
                'parent' => $request->parent,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
            );
        }
        FooterLink::where('id',$id)->update($updateData);
        return back()->with('success','Footer link is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FooterLink  $footerLink
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $oldImage = json_decode(FooterLink::where('id',$id)->value('image'));
        @unlink('uploads/footer_link_image/'.$oldImage[0]->image);
        @unlink('uploads/footer_link_image/'.$oldImage[0]->thumb);
        FooterLink::findOrFail($id)->delete();
        return back()->with('success','Footer link is deleted successfully!');
    }
}
