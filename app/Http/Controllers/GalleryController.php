<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use DataTables;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Gallery::orderByDesc('id')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<a href="'.route('gallery.edit',$row->id).'" title="Edit" class="btn btn-info btn-sm"><i class="fal fa-edit"></i></a> <a href="'.route('gallery.destroy',$row->id).'" class="edit btn btn-danger btn-sm" onclick="return confirm_delete('.$row->id.')" title="Delete"><i class="fal fa-trash"></i></a><form id="delete_form_'.$row->id.'" action="'.route('gallery.destroy',$row->id).'" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                </form>';
                            return $btn;
                    })
                    ->addColumn('image', function($row){
                            $image = json_decode($row->image);
                            if ($image) {
                                $btn = '<img src="'.asset('uploads/company_gallery_image/'.$image[0]->thumb).'" alt="Gallery Image" width="100" height="100">';
                            } else {
                                $btn = '';
                            }
                            return $btn;
                    })
                    ->rawColumns(['action','image'])
                    ->make(true);
        }
        $title = 'Gallery List';
        $menu = 'Frontend Settings';
        return view('backend.gallery.index',compact('title','menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Gallery Image Add';
        $menu = 'Frontend Settings';
        return view('backend.gallery.create',compact('title','menu'));
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
        ]);
        if ($request->file('image')) {
            $image = $this->uploadImage($request->file('image'), 'uploads/company_gallery_image', 400, 400, 400, 400);
        }
        $gallery = new Gallery();
        $gallery->image = $image;
        $gallery->save();
        return redirect()->route('gallery.index')->with('success','Gallery image is saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $title = 'Gallery Image Edit';
        $menu = 'Frontend Settings';
        $gallery = Gallery::findOrFail($id);
        return view('backend.gallery.edit',compact('title','menu','gallery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'image' => 'image|mimes:png,jpg,jpeg',
        ]);
        $galleryImage = Gallery::where('id',$id)->value('image');
        $imageOld = json_decode($galleryImage);
        if ($request->file('image')) {
            $image = $this->uploadImage($request->file('image'), 'uploads/company_gallery_image', 400, 400, 400, 400);
            @unlink('uploads/company_gallery_image/'.$imageOld[0]->image);
            @unlink('uploads/company_gallery_image/'.$imageOld[0]->thumb);

            $updateData = array(
                'image' => $image,
            );
            Gallery::where('id',$id)->update($updateData);
        }
        return back()->with('success','Gallery image is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $galleryImage = json_decode(Gallery::where('id',$id)->value('image'));
        @unlink('uploads/company_gallery_image/'.$galleryImage[0]->image);
        @unlink('uploads/company_gallery_image/'.$galleryImage[0]->thumb);
        Gallery::findOrFail($id)->delete();
        return back()->with('success','Gallery Image is deleted successfully!');
    }
}
