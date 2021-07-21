<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use DataTables;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Blog::orderByDesc('id')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('image', function($row){
                           $blogImage = json_decode($row->image);
                           if ($blogImage) {
                                $image = '<img src="'.asset('uploads/blog_image/'.$blogImage[0]->thumb).'" width="100" height="100">';
                           } else {
                               $image = '';
                           }
                            return $image;
                    })
                    ->addColumn('action', function($row){
                           $btn = '<a href="'.route('blog.edit',$row->id).'" title="Edit" class="btn btn-info btn-sm"><i class="fal fa-edit"></i></a> <a href="'.route('blog.destroy',$row->id).'" class="edit btn btn-danger btn-sm" onclick="return confirm_delete('.$row->id.')" title="Delete"><i class="fal fa-trash"></i></a><form id="delete_form_'.$row->id.'" action="'.route('blog.destroy',$row->id).'" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                </form>';
                            return $btn;
                    })
                    ->rawColumns(['action','image'])
                    ->make(true);
        }
        $title = 'Blog Post List';
        $menu = 'Blog';
        return view('backend.blog.index',compact('title','menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Blog Post Add';
        $menu = 'Blog';
        $blogCategory = BlogCategory::get();
        return view('backend.blog.create',compact('title','menu','blogCategory'));
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
            'title' => 'required|max:255|unique:blogs,title',
            'slug' => 'required|max:255|unique:blogs,slug',
            'category_id' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg',
            'description' => 'required'
        ]);
        if ($request->file('image')) {
            $image = $this->uploadImage($request->file('image'), 'uploads/blog_image', 400, 400, 400, 400);
        } else {
            $image = null;
        }
        $blog = new Blog();
        $blog->title = $request->title;
        $blog->slug = $request->slug;
        $blog->category_id = $request->category_id;
        $blog->image = $image;
        $blog->description = $request->description;
        $blog->save();
        return redirect()->route('blog.index')->with('success',"Blog is saved successfully!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $title = 'Blog Post Edit';
        $menu = 'Blog';
        $blog = Blog::findOrFail($id);
        $blogCategory = BlogCategory::get();
        return view('backend.blog.edit',compact('title','menu','blog','blogCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' => 'required|max:255|unique:blogs,title,'.$id,
            'slug' => 'required|max:255|unique:blogs,slug,'.$id,
            'category_id' => 'required',
            'image' => 'image|mimes:png,jpg,jpeg',
            'description' => 'required'
        ]);
        $oldImage = json_decode(Blog::where('id',$id)->value('image'));
        if ($request->file('image')) {
            $image = $this->uploadImage($request->file('image'), 'uploads/blog_image', 400, 400, 400, 400);
            @unlink('uploads/blog_image/'.$oldImage[0]->image);
            @unlink('uploads/blog_image/'.$oldImage[0]->thumb);

            $updateData = array(
                'title' => $request->title,
                'slug' => $request->slug,
                'category_id' => $request->category_id,
                'image' => $image,
                'description' => $request->description,
            );
        } else {
            $updateData = array(
                'title' => $request->title,
                'slug' => $request->slug,
                'category_id' => $request->category_id,
                'description' => $request->description,
            );
        }
        Blog::where('id',$id)->update($updateData);
        return back()->with('success','Blog is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $oldImage = json_decode(Blog::where('id',$id)->value('image'));
        @unlink('uploads/blog_image/'.$oldImage[0]->image);
        @unlink('uploads/blog_image/'.$oldImage[0]->thumb);

        Blog::findOrFail($id)->delete();
        return back()->with('success','Blog is deleted successfully!');
    }
}
