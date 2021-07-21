<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\PaymentOption;
use App\Models\Plan;
use App\Models\Member;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Payment::orderByDesc('id')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('member_id', function($row){
                           $memberName = Member::where('id',$row->member_id)->select('first_name','last_name')->first();
                           $member_id = '<span>'.$memberName->first_name.' '.$memberName->last_name.'</span>';
                            return $member_id;
                    })
                    ->addColumn('plan_id', function($row){
                           $planName = Plan::where('id',$row->plan_id)->value('name');
                           $plan_id = '<span>'.$planName.'</span>';
                            return $plan_id;
                    })
                    ->addColumn('expiry_date',function($row){
                        if ($row->expiry_date) {
                            $expiry_date = '<span>'.date('jS \\of F Y h:i:s A', strtotime($row->expiry_date)).'</span>';
                        } else {
                            $expiry_date = '<span>'.$row->expiry_date.'</span>';
                        }
                        return $expiry_date;
                    })
                    ->addColumn('created_at',function($row){
                        if ($row->created_at) {
                            $created_at = '<span>'.date('jS \\of F Y h:i:s A', strtotime($row->created_at)).'</span>';
                        } else {
                            $created_at = '<span>'.$row->created_at.'</span>';
                        }
                        return $created_at;
                    })
                    ->addColumn('status',function($row){
                        $paidAmount = DB::table('payment_details')->where('payment_id',$row->id)->get()->sum('amount');
                        if ($paidAmount >= $row->total) {
                            $status = '<span class="badge badge-info">Paid</span>';
                        } else {
                            $status = '<span class="badge badge-danger">Due</span>';
                        }
                        return $status;
                    })
                    ->addColumn('action', function($row){
                           $paidAmount = DB::table('payment_details')->where('payment_id',$row->id)->get()->sum('amount');
                           if ($paidAmount >= $row->total) {
                                $btn = '';
                           } else {
                                $btn = '<a href="'.route('payment.edit',$row->id).'" title="Add Payment" class="btn btn-info btn-sm"><i class="fal fa-credit-card"></i></a> ';
                           }
                           
                           $btn .= '<a href="'.route('payment-detail.show',$row->id).'" title="Detail" class="btn btn-info btn-sm"><i class="fal fa-eye"></i></a> <a href="'.route('payment.destroy',$row->id).'" class="edit btn btn-danger btn-sm" onclick="return confirm_delete('.$row->id.')" title="Delete"><i class="fal fa-trash"></i></a><form id="delete_form_'.$row->id.'" action="'.route('payment.destroy',$row->id).'" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                </form>';
                            return $btn;
                    })
                    ->rawColumns(['action','plan_id','member_id','created_at','expiry_date','status'])
                    ->make(true);
        }
        $title = 'Sells List';
        $menu = 'Earnings';
        return view('backend.payment.index',compact('title','menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Payment Add';
        $menu = 'Earnings';
        $plan = Plan::get();
        $paymentOption = PaymentOption::get();
        return view('backend.payment.create',compact('title','menu','plan','paymentOption'));
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
            'member_name' => 'required',
            'member_id' => 'required',
            'plan_id' => 'required',
            'total' => 'required',
            'paid' => 'required',
            'due' => 'required',
            'payment_type' => 'required',
        ]);
        date_default_timezone_set($request->timezone);
        
        $plan = Plan::findOrFail($request->plan_id);
        if ($request->plan_id == '1') {
            $expire_date = null;
            $package_info[] = array(
                "current_package" => $plan->name,
                "package_price" => $plan->amount,
                'expire_date' => $expire_date,
                "payment_type" => 'By '.Auth::user()->name
            );
            $membership = '1';
        } else {
            $expire_date = date("Y-m-d H:i:s", strtotime("+".$plan->package_duration." day"));
            $package_info[] = array(
                "current_package" => $plan->name,
                "package_price" => $plan->amount,
                'expire_date' => $expire_date,
                "payment_type" => 'By '.Auth::user()->name
            );
            $membership = '2';
        }

        $payment = new Payment();
        $payment->member_id = $request->member_id;
        $payment->plan_id = $request->plan_id;
        $payment->total = $request->total;

        if ($request->paid >= $request->total) {
            $status = 'paid';
        } else {
            $status = 'due';
        }
        $payment->status = $status;
        $payment->expiry_date = $expire_date;
        $payment->payment_by = Auth::user()->name;
        $payment->save();
        $paymentId = $payment->id;

        $paymentDetails = array(
            'payment_id' => $paymentId,
            'payment_type' => $request->payment_type,
            'amount' => $request->paid,
            'received_by' => Auth::user()->name,
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s'),
        );
        DB::table('payment_details')->insert($paymentDetails);

        $memberUpdate = array(
            'membership' => $membership,
            'package_info' => $package_info,
            'express_interest' => $plan->express_interest,
            'direct_messages' => $plan->direct_messages,
            'photo_gallery' => $plan->photo_gallery,
        );
        Member::where('id',$request->member_id)->update($memberUpdate);
        
        return redirect()->route('payment.index')->with('success','Payment is saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request ,$id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Add Payment';
        $menu = 'Earnings';
        $payment = Payment::findOrFail($id);
        $plan = Plan::get();
        $paymentOption = PaymentOption::get();
        return view('backend.payment.edit',compact('payment','title','menu','plan','paymentOption'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'payment_type' => 'required',
            'amount' => 'required',
        ]);
        date_default_timezone_set($request->timezone);
        $insertData = array(
            'payment_id' => $id,
            'payment_type' => $request->payment_type,
            'amount' => $request->amount,
            'received_by' => Auth::user()->name,
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s'),
        );
        DB::table('payment_details')->insert($insertData);
        return redirect()->route('payment.index')->with('success','Payment is added successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Payment::findOrFail($id)->delete();
        return back()->with('success','Payment is deleted successfully!');
    }
}
