<?php

namespace App\Http\Controllers;

use App\Models\PaymentOption;
use Illuminate\Http\Request;
use DataTables;

class PaymentOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = PaymentOption::orderByDesc('id')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('desktop_image', function($row){
                           $desktop_image = json_decode($row->desktop_image);
                           if ($desktop_image) {
                               $btn = '<img src="'.asset('uploads/payment_option_image/'.$desktop_image[0]->thumb).'" title="'.$row->title.'" alt="'.$row->title.'" width="300" height="50">';
                           } else {
                               $btn = '';
                           }
                            return $btn;
                    })
                    ->addColumn('action', function($row){
                           $btn = '<a href="'.route('payment-option.edit',$row->id).'" title="Edit" class="btn btn-info btn-sm"><i class="fal fa-edit"></i></a> <a href="'.route('payment-option.destroy',$row->id).'" class="edit btn btn-danger btn-sm" onclick="return confirm_delete('.$row->id.')" title="Delete"><i class="fal fa-trash"></i></a><form id="delete_form_'.$row->id.'" action="'.route('payment-option.destroy',$row->id).'" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                </form>';
                            return $btn;
                    })
                    ->rawColumns(['desktop_image','action'])
                    ->make(true);
        }
        $title = 'Payment Option List';
        $menu = 'Extra Settings';
        return view('backend.payment-option.index',compact('title','menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Payment Option Add';
        $menu = 'Extra Settings';
        return view('backend.payment-option.create',compact('title','menu'));
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
            'desktop_image' => 'required|image|mimes:png,jpg,jpeg',
            'mobile_image' => 'required|image|mimes:png,jpg,jpeg',
        ]);
        if ($request->file('desktop_image')) {
            $desktopImage = $this->uploadImage($request->file('desktop_image'), 'uploads/payment_option_image', 50, 50);
        }else{
            $desktopImage = null;
        }
        if ($request->file('mobile_image')) {
            $mobileImage = $this->uploadImage($request->file('mobile_image'), 'uploads/payment_option_image', 50, 50);
        }else{
            $mobileImage = null;
        }
        $paymentOption = new PaymentOption();
        $paymentOption->title = $request->title;
        $paymentOption->desktop_image = $desktopImage;
        $paymentOption->mobile_image = $mobileImage;
        $paymentOption->save();
        return redirect()->route('payment-option.index')->with('success','Payment option is saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentOption  $paymentOption
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentOption $paymentOption)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentOption  $paymentOption
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Payment Option Edit';
        $menu = 'Extra Settings';
        $paymentOption = PaymentOption::findOrFail($id);
        return view('backend.payment-option.edit',compact('title','menu','paymentOption'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentOption  $paymentOption
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $this->validate($request,[
            'title' => 'required|max:255',
            'desktop_image' => 'image|mimes:png,jpg,jpeg',
            'mobile_image' => 'image|mimes:png,jpg,jpeg',
        ]);
        
        if ($request->file('desktop_image')) {
            $oldDesktopImage = json_decode(PaymentOption::where('id',$id)->value('desktop_image'));
            $newDesktopImage = $this->uploadImage($request->file('desktop_image'), 'uploads/payment_option_image', 50, 50);
            @unlink('uploads/payment_option_image/'.$oldDesktopImage[0]->image);
            @unlink('uploads/payment_option_image/'.$oldDesktopImage[0]->thumb);

            $desktopImage = array(
                'desktop_image' => $newDesktopImage,
            );
        }else{
            $desktopImage = array();
        }

        if ($request->file('mobile_image')) {
            $oldMobileImage = json_decode(PaymentOption::where('id',$id)->value('mobile_image'));
            $newMobileImage = $this->uploadImage($request->file('mobile_image'), 'uploads/payment_option_image', 50, 50);
            @unlink('uploads/payment_option_image/'.$oldMobileImage[0]->image);
            @unlink('uploads/payment_option_image/'.$oldMobileImage[0]->thumb);

            $mobileImage = array(
                'mobile_image' => $newMobileImage,
            );
        }else{
            $mobileImage = array();
        }

        $updateData = array(
            'title' => $request->title,
        );
        $updateInfo = array_merge($desktopImage,$mobileImage,$updateData);
        PaymentOption::where('id',$id)->update($updateInfo);
        return back()->with('success','Payment Option is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentOption  $paymentOption
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $oldDesktopImage = json_decode(PaymentOption::where('id',$id)->value('desktop_image'));
        @unlink('uploads/payment_option_image/'.$oldDesktopImage[0]->image);
        @unlink('uploads/payment_option_image/'.$oldDesktopImage[0]->thumb);

        $oldMobileImage = json_decode(PaymentOption::where('id',$id)->value('mobile_image'));
        @unlink('uploads/payment_option_image/'.$oldMobileImage[0]->image);
        @unlink('uploads/payment_option_image/'.$oldMobileImage[0]->thumb);

        PaymentOption::findOrFail($id)->delete();
        return back()->with('success','Payment Options is deleted successfully!');
    }
}
