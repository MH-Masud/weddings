<?php

namespace App\Http\Controllers;

use App\Models\PaymentDetail;
use Illuminate\Http\Request;
use DataTables;

class PaymentDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = PaymentDetail::orderByDesc('id')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<a href="'.route('payment-detail.destroy',$row->id).'" class="edit btn btn-danger btn-sm" onclick="return confirm_delete('.$row->id.')" title="Delete"><i class="fal fa-trash"></i></a><form id="delete_form_'.$row->id.'" action="'.route('payment-detail.destroy',$row->id).'" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                </form>';
                            return $btn;
                    })
                    ->addColumn('created_at',function($row){
                        if ($row->created_at) {
                            $created_at = '<span>'.date('jS \\of F Y h:i:s A', strtotime($row->created_at)).'</span>';
                        } else {
                            $created_at = '<span>'.$row->created_at.'</span>';
                        }
                        return $created_at;
                    })
                    ->rawColumns(['action','created_at'])
                    ->make(true);
        }
        $title = 'Payment Detail List';
        $menu = 'Earnings';
        return view('backend.payment-detail.index',compact('title','menu'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentDetail  $paymentDetail
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = PaymentDetail::where('payment_id',$id)->orderByDesc('id')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<a href="'.route('payment-detail.destroy',$row->id).'" class="edit btn btn-danger btn-sm" onclick="return confirm_delete('.$row->id.')" title="Delete"><i class="fal fa-trash"></i></a><form id="delete_form_'.$row->id.'" action="'.route('payment-detail.destroy',$row->id).'" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                </form>';
                            return $btn;
                    })
                    ->addColumn('created_at',function($row){
                        if ($row->created_at) {
                            $created_at = '<span>'.date('jS \\of F Y h:i:s A', strtotime($row->created_at)).'</span>';
                        } else {
                            $created_at = '<span>'.$row->created_at.'</span>';
                        }
                        return $created_at;
                    })
                    ->rawColumns(['action','created_at'])
                    ->make(true);
        }
        $title = 'Payment Detail List';
        $menu = 'Earnings';
        return view('backend.payment-detail.show',compact('title','menu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentDetail  $paymentDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentDetail $paymentDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentDetail  $paymentDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentDetail $paymentDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentDetail  $paymentDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        PaymentDetail::findOrFail($id)->delete();
        return back()->with('success','Payment deleted successfully!');
    }
}
