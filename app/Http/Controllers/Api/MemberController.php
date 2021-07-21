<?php

namespace App\Http\Controllers\Api;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\HappyStory;
use App\Models\Member;
use App\Models\Payment;
use App\Models\Plan;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    public function member($id){
        $member = Member::select('package_info','express_interest','direct_messages','photo_gallery')->where('id',$id)->first();
        return json_encode($member);
    }
    public function memberBlock($id){
        Member::where('id',$id)->update(array('is_blocked'=>'yes'));
        return true;
    }
    public function memberUnblock($id){
        Member::where('id',$id)->update(array('is_blocked'=>'no'));
        return true;
    }

    public function memberFeatured($id)
    {
        Member::where('id',$id)->update(array('featured'=>'yes'));
        return true;
    }

    public function memberUnfeatured($id)
    {
        Member::where('id',$id)->update(array('featured'=>'no'));
        return true;
    }

    public function memberPackage($id){
        $memberInfo = Member::where('id',$id)->select('package_info','express_interest','direct_messages','photo_gallery')->first();
        $package_info = json_decode($memberInfo->package_info);
        $packageId = Plan::where('name',$package_info[0]->current_package)->value('id');
        $expDate = (isset($package_info[0]->expire_date)) ? date('l jS \\of F Y h:i:s A', strtotime($package_info[0]->expire_date)) : 'Unlimited' ;
        $output = '';
        $output .= '<div class="row">
                        <div class="col-md-5">
                            <div class="block">
                                <h5>Current Package</h5>
                                <div class="text-left">
                                    <div class="px-2 py-2">
                                        <input type="hidden" name="memberId" id="memberId" value="'.$id.'">
                                        <input type="hidden" name="packageId" id="packageId" value="'.$packageId.'">
                                        <table class="table table-bordered table-hover m-0">
                                            <tbody class="thead-themed">
                                                <tr>
                                                    <th>Name</th>
                                                    <td>'.$package_info[0]->current_package.'</td>
                                                </tr>
                                                <tr>
                                                    <th>Price</th>
                                                    <td>৳ '.$package_info[0]->package_price.'</td>
                                                </tr>
                                                <tr>
                                                    <th>Payment</th>
                                                    <td>'.$package_info[0]->payment_type.'</td>
                                                </tr>
                                                <tr>
                                                    <th>Expire Date</th>
                                                    <td>'. $expDate .'</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="block">
                                <h5>Remaining Package</h5>
                                <div class="text-left">
                                    <div class="px-2 py-2">
                                        <table class="table table-bordered table-hover m-0">
                                            <thead class="thead-themed">
                                                <tr>
                                                    <th>Features</th>
                                                    <th>Unit Left</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Express Interest</td>
                                                    <td>'.$memberInfo->express_interest.'</td>
                                                </tr>
                                                <tr>
                                                    <td>Messages</td>
                                                    <td>'.$memberInfo->direct_messages.'</td>
                                                </tr>
                                                <tr>
                                                    <td>Photo Gallery</td>
                                                    <td>'.$memberInfo->photo_gallery.'</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
        return json_encode($output);
    }
    public function memberGroup(Request $request ,$id)
    {
        $group = $request->group;
        Member::where('id',$id)->update(array('member_group' => $group));
        return true;
    }

    public function updatePackage(Request $request)
    {
        $m_id = $request->memberId;
        $p_id = $request->packageId;
        $plan = Plan::findOrFail($p_id);
        date_default_timezone_set($request->timezone);
        if ($plan->package_duration != '') {
            $expire_date = date("Y-m-d H:i:s", strtotime("+".$plan->package_duration." day"));

            $packageInfo[] = array(
                'current_package' => $plan->name,
                'package_price' => $plan->amount,
                'payment_type' => 'By '. Auth::user()->name,
                'expire_date' => $expire_date,
            );
            $membership = '2';
        } else {
            $expire_date = null;
            $packageInfo[] = array(
                'current_package' => $plan->name,
                'package_price' => $plan->amount,
                'payment_type' => 'By '. Auth::user()->name,
                'expire_date' => $expire_date,
            );
            $membership = '1';
        }

        $packageInfo = array(
            'package_info' => json_encode($packageInfo),
            'express_interest' => $plan->express_interest,
            'direct_messages' => $plan->direct_messages,
            'photo_gallery' => $plan->photo_gallery,
            'membership' => $membership,
        );
        Member::where('id',$m_id)->update($packageInfo);
        
        if ($request->paid >= $request->total) {
            $status = 'paid';
        } else {
            $status = 'due';
        }

        $payment = new Payment();
        $payment->member_id = $m_id;
        $payment->plan_id = $p_id;
        $payment->total = $request->total;
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

        return true;
    }

    public function statesInCountry($id){
        $states = DB::table('states')->where('country_id',$id)->get();
        return $states;
    }
    public function citiesInState($id){
        $cities = DB::table('cities')->where('state_id',$id)->get();
        return $cities;
    }
    public function postCode($id){
        $postalCode = DB::table('cities')->where('id',$id)->value('postal_code');
        $postalCode = ($postalCode) ? $postalCode : 'false' ;
        return $postalCode;
    }

    public function allCastes($id){
        $caste = DB::table('castes')->where('religion_id',$id)->get();
        return $caste;
    }

    public function allSubCastes($id){
        $sub_castes = DB::table('sub_castes')->where('caste_id',$id)->get();
        return $sub_castes;
    }

    public function memberInfo(Request $request)
    {
        $keyword = $request->search;
        $members = Member::where('first_name','like', '%'. $keyword .'%')->orWhere('last_name','like', '%'. $keyword .'%')->get();
        $response = [];
        foreach ($members as $member) {
            $response[] = array("value"=>$member->id,"label"=> $member->first_name.' '.$member->last_name);
        }
        return json_encode($response);
    }

    public function publishStory($id)
    {
        HappyStory::where('id',$id)->update(array('approval_status' => 'yes'));
        return true;
    }

    public function unpublishStory($id)
    {
        HappyStory::where('id',$id)->update(array('approval_status' => 'no'));
        return true;
    }

    public function planDetail($id)
    {
        $plan = Plan::findOrFail($id);
        return $plan;
    }
}
