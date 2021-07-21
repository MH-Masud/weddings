<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use Illuminate\Http\Request;
use DataTables;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = BlogCategory::orderByDesc('id')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('image', function($row){
                           $blogCategoryImage = json_decode($row->image);
                           if ($blogCategoryImage) {
                                $image = '<img src="'.asset('uploads/blog_category_image/'.$blogCategoryImage[0]->thumb).'" width="100" height="100">';
                           } else {
                               $image = '';
                           }
                            return $image;
                    })
                    ->addColumn('action', function($row){
                           $btn = '<a href="'.route('blog-category.edit',$row->id).'" title="Edit" class="btn btn-info btn-sm"><i class="fal fa-edit"></i></a> <a href="'.route('blog-category.destroy',$row->id).'" class="edit btn btn-danger btn-sm" onclick="return confirm_delete('.$row->id.')" title="Delete"><i class="fal fa-trash"></i></a><form id="delete_form_'.$row->id.'" action="'.route('blog-category.destroy',$row->id).'" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                </form>';
                            return $btn;
                    })
                    ->rawColumns(['action','image'])
                    ->make(true);
        }
        $title = 'Blog Category List';
        $menu = 'Blog';
        return view('backend.blog-category.index',compact('title','menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Blog Category Add';
        $menu = 'Blog';
        return view('backend.blog-category.create',compact('title','menu'));
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
            'name' => 'required|max:255|unique:blog_categories,name',
            'slug' => 'required|max:255|unique:blog_categories,slug',
            'image' => 'required|image|mimes:png,jpg,jpeg'
        ]);
        if ($request->file('image')) {
            $image = $this->uploadImage($request->file('image'), 'uploads/blog_category_image', 400, 400, 400, 400);
        } else {
            $image = null;
        }
        $blogCategory = new BlogCategory();
        $blogCategory->name = $request->name;
        $blogCategory->slug = $request->slug;
        $blogCategory->image = $image;
        $blogCategory->save();
        return redirect()->route('blog-category.index')->with('success','Blog category is saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function show(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Blog Category Edit';
        $menu = 'Blog';
        $blogCategory = BlogCategory::findOrFail($id);
        return view('backend.blog-category.edit',compact('title','menu','blogCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required|max:255|unique:blog_categories,name',
            'slug' => 'required|max:255|unique:blog_categories,slug',
            'image' => 'image|mimes:png,jpg,jpeg'
        ]);
        $oldImage = json_decode(BlogCategory::where('id',$id)->value('image'));
        if ($request->file('image')) {
            $image = $this->uploadImage($request->file('image'), 'uploads/blog_category_image', 400, 400, 400, 400);
            @unlink('uploads/blog_category_image/'.$oldImage[0]->image);
            @unlink('uploads/blog_category_image/'.$oldImage[0]->thumb);
            
            $updateData = array(
                'name' => $request->name,
                'slug' => $request->slug,
                'image' => $image,
            );
        } else {
            $updateData = array(
                'name' => $request->name,
                'slug' => $request->slug,
            );
        }
        BlogCategory::where('id',$id)->update($updateData);
        return back()->with('success','Blog category is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $oldImage = json_decode(BlogCategory::where('id',$id)->value('image'));
        @unlink('uploads/blog_category_image/'.$oldImage[0]->image);
        @unlink('uploads/blog_category_image/'.$oldImage[0]->thumb);

        BlogCategory::findOrFail($id)->delete();
        return back()->with('success','Blog category is deleted successfully!');
    }
}
