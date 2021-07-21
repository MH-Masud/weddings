<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use DataTables;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Plan::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('image', function($row){
                            $images = json_decode($row->image);
                            if (file_exists('uploads/plan_image/'.$images[0]->thumb)) {
                                $btn = '<img alt="'.$row->first_name.'" title="'.$row->first_name.'" src="'.asset('uploads/plan_image').'/'.$images[0]->thumb.'" width="100" height="100">';
                            } else {
                                $btn = '<img alt="'.$row->first_name.'" title="'.$row->first_name.'" src="'.asset('uploads/plan_image/default_thumb.jpg').'" width="100" height="100">';
                            }
                            return $btn;
                    })
                    ->addColumn('action', function($row){
                           $btn = '<a href="'.route('plan.show',$row->id).'" class="edit btn btn-primary btn-sm" title="View"><i class="fal fa-eye"></i></a> <a href="'.route('plan.edit',$row->id).'" title="Edit" class="edit btn btn-info btn-sm"><i class="fal fa-edit"></i></a> <a href="'.route('plan.destroy',$row->id).'" class="edit btn btn-danger btn-sm" onclick="return confirm_delete('.$row->id.')" title="Delete"><i class="fal fa-trash"></i></a><form id="delete_form_'.$row->id.'" action="'.route('plan.destroy',$row->id).'" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                </form>';
                            return $btn;
                    })
                    ->rawColumns(['image','action'])
                    ->make(true);
        }
        $title = 'Plan List';
        $plans = Plan::get();
        $menu = 'Premium Package';
        return view('backend.plan.index',compact('title','plans','menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Add Plan';
        $menu = 'Premium Package';
        return view('backend.plan.create',compact('title','menu'));
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
            'name' => 'required|max:255',
            'amount' => 'required',
            'express_interest' => 'required',
            'direct_messages' => 'required',
            'photo_gallery' => 'required',
            'image' => 'required',
        ]);
        if ($request->file('image')) {
            $images = $this->uploadImage($request->file('image'), 'uploads/plan_image', 50, 50, 100, 100);
        } else {
            $images = null;
        }

        $plan = new Plan();
        $plan->name = $request->name;
        $plan->amount = $request->amount;
        $plan->package_duration = $request->package_duration;
        $plan->photo_gallery = $request->photo_gallery;
        $plan->express_interest = $request->express_interest;
        $plan->direct_messages = $request->direct_messages;
        $plan->image = $images;
        $plan->save();

        return redirect()->route('plan.index')->with('success','Plan added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $plan = Plan::findOrFail($id);
        $title = 'Plan Details';
        $menu = 'Premium Package';
        return view('backend.plan.show',compact('title','menu','plan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $plan = Plan::findOrFail($id);
        $title = 'Edit Plan';
        $menu = 'Premium Package';
        return view('backend.plan.edit',compact('title','menu','plan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required|max:255',
            'amount' => 'required',
            'express_interest' => 'required',
            'direct_messages' => 'required',
            'photo_gallery' => 'required',
        ]);

        if ($request->file('image')) {
            $new_images = $this->uploadImage($request->file('image'), 'uploads/plan_image', 50, 50, 100, 100);
            $images = json_decode(Plan::find($id)->value('image'));

            @unlink('uploads/plan_image/'.$images[0]->image);
            @unlink('uploads/plan_image/'.$images[0]->thumb);

            $updatePlan = array(
                'name' => $request->name,
                'package_duration' => $request->package_duration,
                'amount' => $request->amount,
                'express_interest' => $request->express_interest,
                'direct_messages' => $request->direct_messages,
                'photo_gallery' => $request->photo_gallery,
                'image' => $new_images,
            );
        } else {
            $updatePlan = array(
                'name' => $request->name,
                'package_duration' => $request->package_duration,
                'amount' => $request->amount,
                'express_interest' => $request->express_interest,
                'direct_messages' => $request->direct_messages,
                'photo_gallery' => $request->photo_gallery,
            );
        }

        Plan::where('id',$id)->update($updatePlan);
        return back()->with('success','Plan is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan $plan)
    {
        //
    }
}
