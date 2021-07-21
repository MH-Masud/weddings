<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use DataTables;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Slider::orderByDesc('id')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('desktop_image', function($row){
                        $images = json_decode($row->desktop_image);
                           $btn = '<img width="100" height="50" src="'.asset('uploads/slider_image/'.$images[0]->image).'" title="slider '.$row->id.'" alt="slider image">';
                            return $btn;
                    })
                    ->addColumn('action', function($row){
                           $btn = '<a href="'.route('slider.edit',$row->id).'" title="Edit" class="btn btn-info btn-sm"><i class="fal fa-edit"></i></a> <a href="'.route('slider.destroy',$row->id).'" class="edit btn btn-danger btn-sm" onclick="return confirm_delete('.$row->id.')" title="Delete"><i class="fal fa-trash"></i></a><form id="delete_form_'.$row->id.'" action="'.route('slider.destroy',$row->id).'" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                </form>';
                            return $btn;
                    })
                    ->rawColumns(['action','desktop_image'])
                    ->make(true);
        }
        $title = 'Slider List';
        $menu = 'Frontend Settings';
        return view('backend.slider.index',compact('title','menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Slider Add';
        $menu = 'Frontend Settings';
        return view('backend.slider.create',compact('title','menu'));
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
            'desktop_image' => 'required|image|mimes:png,jpg,jpeg',
            'mobile_image' => 'required|image|mimes:png,jpg,jpeg',
        ]);
        if ($request->file('desktop_image')) {
            $desktopImage = $this->uploadImage($request->file('desktop_image'), 'uploads/slider_image', 1300, 600);
        }
        if ($request->file('mobile_image')) {
            $mobileImage = $this->uploadImage($request->file('mobile_image'), 'uploads/slider_image', 450, 600);
        }
        $slider = new Slider();
        $slider->text = $request->text;
        $slider->desktop_image = $desktopImage;
        $slider->mobile_image = $mobileImage;
        $slider->save();
        return redirect()->route('slider.index')->with('success','Slider is saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $title = 'Slider Edit';
        $menu = 'Frontend Settings';
        $slider = Slider::findOrFail($id);
        return view('backend.slider.edit',compact('title','menu','slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'desktop_image' => 'image|mimes:png,jpg,jpeg',
            'mobile_image' => 'image|mimes:png,jpg,jpeg',
        ]);
        
        if ($request->file('desktop_image')) {
            $oldDesktopImage = json_decode(Slider::where('id',$id)->value('desktop_image'));
            $newDesktopImage = $this->uploadImage($request->file('desktop_image'), 'uploads/slider_image', 450, 600);
            @unlink('uploads/slider_image/'.$oldDesktopImage[0]->image);
            @unlink('uploads/slider_image/'.$oldDesktopImage[0]->thumb);

            $desktopImage = array(
                'desktop_image' => $newDesktopImage,
            );
        }else{
            $desktopImage = array();
        }

        if ($request->file('mobile_image')) {
            $oldMobileImage = json_decode(Slider::where('id',$id)->value('mobile_image'));
            $newMobileImage = $this->uploadImage($request->file('mobile_image'), 'uploads/slider_image', 450, 600);
            @unlink('uploads/slider_image/'.$oldMobileImage[0]->image);
            @unlink('uploads/slider_image/'.$oldMobileImage[0]->thumb);

            $mobileImage = array(
                'mobile_image' => $newMobileImage,
            );
        }else{
            $mobileImage = array();
        }
        $updateData = array(
            'text' => $request->text,
        );
        $updateInfo = array_merge($updateData,$desktopImage,$mobileImage);
        Slider::where('id',$id)->update($updateInfo);
        return back()->with('success','Slider is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $oldDesktopImage = json_decode(Slider::where('id',$id)->value('desktop_image'));
        @unlink('uploads/slider_image/'.$oldDesktopImage[0]->image);
        @unlink('uploads/slider_image/'.$oldDesktopImage[0]->thumb);

        $oldMobileImage = json_decode(Slider::where('id',$id)->value('mobile_image'));
        @unlink('uploads/slider_image/'.$oldMobileImage[0]->image);
        @unlink('uploads/slider_image/'.$oldMobileImage[0]->thumb);
        Slider::find($id)->delete();
        return back()->with('success','Slider is deleted successfully!');
    }
}
