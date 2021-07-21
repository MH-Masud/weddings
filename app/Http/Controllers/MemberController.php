<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Member;
use App\Models\Payment;
use App\Models\PaymentOption;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $type = $_GET['type'];

        if ($request->ajax()) {
            $data = Member::where('membership',$type)->orderByDesc('members.id')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('image', function($row){
                           $images = json_decode($row->profile_image);
                           if (file_exists('uploads/profile_image/'.$images[0]->thumb)) {
                                $btn = '<img alt="'.$row->first_name.'" title="'.$row->first_name.'" src="'.asset('uploads/profile_image').'/'.$images[0]->thumb.'" style="width:100px;height:100px;">';
                            } else {
                                $btn = '<img alt="'.$row->first_name.'" title="'.$row->first_name.'" src="'.asset('uploads/profile_image/default_thumb.jpg').'" width="100" height="100">';
                            }
                            return $btn;
                    })
                    ->addColumn('action', function($row){
                            $btn = '';
                            $btn .= '<a href="'.route('member.show',$row->id).'" title="View" class="edit btn btn-info btn-sm"><i class="fal fa-eye"></i></a>&nbsp;';
                            $btn .= '<a href="'.route('member.edit',$row->id).'" title="Edit" class="edit btn btn-secondary btn-sm"><i class="fal fa-edit"></i></a>&nbsp;';
                            $btn .= '<a href="javascript:void(0)" title="Packages" class="edit btn btn-success btn-sm" onclick="view_package('.$row->id.')"><i class="fal fa-object-ungroup"></i></a>&nbsp;';
                            if ($row->is_blocked == 'yes') {
                                $btn .= '<a href="javascript:void(0)" title="Unblock" onclick="return unblock_member('.$row->id.')" class="edit btn btn-dark btn-sm"><i class="fal fa-check"></i></a>&nbsp;';
                            } else {
                                $btn .= '<a href="javascript:void(0)" title="Block" onclick="return block_member('.$row->id.')" class="edit btn btn-dark btn-sm"><i class="fal fa-ban"></i></a>&nbsp;';
                            }
                            if ($row->member_group == '') {
                                $memberGroup = '0';
                            }
                            if ($row->member_group == 'A') {
                                $memberGroup = '1';
                            }
                            if ($row->member_group == 'B') {
                                $memberGroup = '2';
                            }
                            if ($row->member_group == 'C') {
                                $memberGroup = '3';
                            }
                            if ($row->member_group == 'D') {
                                $memberGroup = '4';
                            }

                            $btn .= '<a href="javascript:void(0)" title="Group" onclick="return update_group('.$row->id.','.$memberGroup.')" class="edit btn btn-primary btn-sm"><i class="fal fa-users"></i></a>&nbsp;';
                            if ($row->featured == 'no') {
                                $btn .= '<a href="javascript:void(0)" title="Featured" onclick="return featured_member('.$row->id.')" class="edit btn btn-warning btn-sm"><i class="fal fa-tags"></i></a>&nbsp;';
                            } else {
                                $btn .= '<a href="javascript:void(0)" title="Unfeatured" onclick="return unfeatured_member('.$row->id.')" class="edit btn btn-warning btn-sm"><i class="fal fa-tags"></i></a>&nbsp;';
                            }

                            $btn .= '<a href="'.route('member.destroy',$row->id).'" class="edit btn btn-danger btn-sm" onclick="return confirm_delete('.$row->id.')" title="Delete"><i class="fal fa-trash"></i></a>&nbsp;';
                            $btn .= '<form id="delete_form_'.$row->id.'" action="'.route('member.destroy',$row->id).'" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                </form>';
                            return $btn;
                    })
                    ->addColumn('is_closed',function($row){
                        if ($row->is_closed == 'no') {
                            $is_closed = '<span class="badge badge-info">Active</span>';
                        } else {
                            $is_closed = '<span class="badge badge-danger">Closed</span>';
                        }
                        return $is_closed;
                    })
                    ->addColumn('package_info',function($row){
                        $packageInfo = json_decode($row->package_info);
                        $package_info = '<span class="badge badge-success">'.$packageInfo[0]->current_package.'</span>';
                        return $package_info;
                    })
                    ->addColumn('first_name',function($row){
                        $first_name = '<span>'.$row->first_name.' '.$row->last_name.'</span>';
                        return $first_name;
                    })
                    ->addColumn('featured',function($row){
                        $featured = '<span class="badge badge-info">'.$row->featured.'</span>';
                        return $featured;
                    })
                    ->addColumn('member_group',function($row){
                        $member_group = '<span class="badge badge-primary">'.$row->member_group.'</span>';
                        return $member_group;
                    })
                    ->addColumn('member_since',function($row){
                        if ($row->member_since) {
                            $member_since = '<span>'.date('jS \\of F Y h:i:s A', strtotime($row->member_since)).'</span>';
                        } else {
                            $member_since = '<span>'.$row->member_since.'</span>';
                        }
                        return $member_since;
                    })

                    ->rawColumns(['featured','first_name','package_info','action','image','is_closed','member_group','member_since'])
                    ->make(true);
        }
        $title = "Member List";
        $menu = "Members";
        $paymentOption = PaymentOption::get();
        return view('backend.member.index',compact('title','menu','paymentOption'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Add Member';
        $menu = 'Members';
        $paymentOption = PaymentOption::get();
        return view('backend.member.create',compact('title','menu','paymentOption'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'fname' => 'required|max:20',
            'lname' => 'required|max:20',
            'phone' => 'required|unique:members,mobile',
            'email' => 'required|email|unique:members,email',
            'gender' => 'required|integer',
            'plan' => 'required|integer',
            'on_behalf' => 'required|integer',
            'date_of_birth' => 'required|date',
            'password' => 'required|confirmed|min:4',
            'image' => 'image|mimes:jpg,jpeg,png',
            'cv' => 'mimes:pdf',
        ]);
        date_default_timezone_set($request->timezone);
        if ($request->file('image')) {
            $images = $this->uploadImage($request->file('image'), 'uploads/profile_image', 400, 400);
        } else {
            $defaultImage[] = array(
                'image' => 'default_thumb.jpg',
                'thumb' => 'default_thumb.jpg',
            );
            $images = json_encode($defaultImage);
        }

        if ($request->file('cv')) {
            $file = $request->file('cv');
            $cv_file_name = 'cv_'.$request->phone.'_'.$file->getClientOriginalName();
            $destinationPath = 'uploads/member_cv';
            $file->move($destinationPath,$cv_file_name);
        } else {
            $cv_file_name = null;
        }

        $basic_info[] = array(
            'age'                => ((date('Y')) - date('Y',strtotime($request->date_of_birth))),
            'marital_status'     => '',
            'number_of_children' => '',
            'area'               => '',
            'on_behalf'          => $request->on_behalf
        );

        $plan = Plan::findOrFail($request->plan);
        if($plan->id == '1'){
            $package_info[] = array(
                "current_package" => $plan->name,
                "package_price" => $plan->amount,
                "payment_type" => 'By '.Auth::user()->name
            );
            $membership = '1';
            $expire_date = '';
        }else{
            $expire_date = date("Y-m-d H:i:s", strtotime("+".$plan->package_duration." day"));
            $package_info[] = array(
                "current_package" => $plan->name,
                "package_price" => $plan->amount,
                'expire_date' => $expire_date,
                "payment_type" => 'By '.Auth::user()->name
            );
            $membership = '2';
        }

        $present_address[] = array(
            'country'     => $request->country,
            'city'        => '',
            'state'       => '',
            'postal_code' => ''
        );

        $education_and_career[] = array(
            'highest_education' => '',
            'occupation' => '',
            'annual_income' => '',
            'university' => '',
            'post' => '',
            'company_name' => '',
        );
        $physical_attributes[] = array(
            'weight' => '',
            'eye_color' => '',
            'hair_color' => '',
            'complexion' => '',
            'blood_group' => '',
            'body_type' => '',
            'body_art' => '',
            'any_disability' => '',
        );
        $language[] = array(
            'mother_tongue' => '',
            'language' => '',
            'speak' => '',
            'read' => '',
        );
        $hobbies_and_interest[] = array(
            'hobby' => '',
            'interest' => '',
            'music' => '',
            'books' => '',
            'movie' => '',
            'tv_show' => '',
            'sports_show' => '',
            'fitness_activity' => '',
            'cuisine' => '',
            'dress_style' => '',
        );
        $personal_attitude_and_behavior[] = array(
            'affection' => '',
            'humor' => '',
            'political_view' => '',
            'religious_service' => '',
        );
        $residency_information[] = array(
            'birth_country' => '',
            'residency_country' => '',
            'citizenship_country' => '',
            'grow_up_country' => '',
            'immigration_status' => '',
        );
        $spiritual_and_social_background[] = array(
            'religion' => '',
            'caste' => '',
            'sub_caste' => '',
            'ethnicity' => '',
            'personal_value' => '',
            'family_value' => '',
            'u_manglik' => '',
            'community_value' => '',
            'family_status' => '',
        );
        $life_style[] = array(
            'diet' => '',
            'drink' => '',
            'smoke' => '',
            'living_with' => '',
        );
        $astronomic_information[] = array(
            'sun_sign' => '',
            'moon_sign' => '',
            'time_of_birth' => '',
            'city_of_birth' => '',
        );
        $permanent_address[] = array(
            'permanent_country' => '',
            'permanent_city' => '',
            'permanent_state' => '',
            'permanent_postal_code' => '',
        );
        $family_info[] = array(
            'father' => '',
            'mother' => '',
            'brother_sister' => '',
        );
        $additional_personal_details[] = array(
            'home_district' => '',
            'family_residence' => '',
            'fathers_occupation' => '',
            'special_circumstances' => '',
        );
        $partner_expectation[] = array(
            'general_requirement' => '',
            'partner_age' => '',
            'partner_height' => '',
            'partner_weight' => '',
            'partner_marital_status' => '',
            'with_children_acceptables' => '',
            'partner_country_of_residence' => '',
            'partner_religion' => '',
            'partner_caste' => '',
            'partner_complexion' => '',
            'partner_education' => '',
            'partner_profession' => '',
            'partner_drinking_habits' => '',
            'partner_smoking_habits' => '',
            'partner_diet' => '',
            'partner_body_type' => '',
            'partner_personal_value' => '',
            'manglik' => '',
            'partner_any_disability' => '',
            'partner_mother_tongue' => '',
            'partner_family_value' => '',
            'prefered_country' => '',
            'prefered_state' => '',
            'prefered_status' => '',
            'partner_sub_caste' => '',
        );
        $pic_privacy[] = array(
            'profile_pic_show' => 'all',
            'gallery_show' => 'premium',
        );
        $settings[] = array(
            'new_arrival_notification' => 'on',
            'new_arrival_email' => 'on',
        );
        $countryCode = Country::where('id',$request->country)->value('phonecode');
        date_default_timezone_set($request->timezone);
        $member = new Member();
        $member->first_name = $request->fname;
        $member->last_name = $request->lname;
        $member->gender = $request->gender;
        $member->email = $request->email;
        $member->status = 'approved';
        $member->is_closed = 'no';
        $member->membership = $membership;
        $member->mobile = '+'.$countryCode.$request->phone;
        $member->date_of_birth = strtotime($request->date_of_birth);
        $member->password = Hash::make($request->password);
        $member->profile_image = $images;
        $member->basic_info = json_encode($basic_info);
        $member->present_address = json_encode($present_address);
        $member->package_info = json_encode($package_info);
        $member->express_interest = $plan->express_interest;
        $member->direct_messages = $plan->direct_messages;
        $member->photo_gallery = $plan->photo_gallery;
        $membership = $membership;
        $member->education_and_career = json_encode($education_and_career);
        $member->physical_attributes = json_encode($physical_attributes);
        $member->language = json_encode($language);
        $member->hobbies_and_interest = json_encode($hobbies_and_interest);
        $member->personal_attitude_and_behavior = json_encode($personal_attitude_and_behavior);
        $member->residency_information = json_encode($residency_information);
        $member->spiritual_and_social_background = json_encode($spiritual_and_social_background);
        $member->life_style = json_encode($life_style);
        $member->astronomic_information = json_encode($astronomic_information);
        $member->permanent_address = json_encode($permanent_address);
        $member->family_info = json_encode($family_info);
        $member->additional_personal_details = json_encode($additional_personal_details);
        $member->partner_expectation = json_encode($partner_expectation);
        $member->life_style = json_encode($life_style);
        $member->pic_privacy = json_encode($pic_privacy);
        $member->settings = json_encode($settings);
        $member->added_by = Auth::user()->id;
        $member->member_since = date('Y-m-d H:i:s');
        $member->cv_file_name = $cv_file_name;

        $member->save();
        $insert_id = $member->id;
        $member->where('id',$insert_id)->update(array('member_profile_id' => 'HM-'.strtoupper(substr(hash('sha512', rand()), 0, 8)).$insert_id));
        
        $payment = new Payment();
        $payment->member_id = $insert_id;
        $payment->plan_id = $request->plan;
        $payment->total = $plan->amount;
        if($request->paid >= $plan->amount){
            $status = 'paid';
        }else{
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
        return back()->with('success','Member is stored successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $title = 'Member Profile';
        $menu = 'Members';
        $member = Member::findOrFail($id);
        $paymentOption = PaymentOption::get();
        return view('backend.member.show',compact('title','menu','member','paymentOption'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $title = 'Edit Member';
        $menu = 'Members';
        $member = Member::findOrFail($id);
        $paymentOption = PaymentOption::get();
        return view('backend.member.edit',compact('title','menu','member','paymentOption'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $profileImg = json_decode(Member::where('id',$id)->value('profile_image'));
        dd($profileImg);
        exit();
        if ($request->profile_image) {
            $this->validate($request,[
                'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:200048'
            ]);
            if ($request->file('profile_image')) {
                $profileImage = $this->uploadImage($request->file('profile_image'), 'uploads/profile_image', 400, 400, 400, 400);

                $updateData = array(
                    'profile_image' => $profileImage,
                );
            }

        } else {

            $this->validate($request,[
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'email' => 'email',
                'mobile' => 'required',
                'date_of_birth' => 'required',
                'gender' => 'required',
                'on_behalf' => 'required',
                'marital_status' => 'required',
                'country' => 'required',
                'state' => 'required',
                'highest_education' => 'required',
                'universities' => 'required',
                'occupation' => 'required',
                'religions' => 'required',
                'caste' => 'required',
                'incomes' => 'required',
            ]);
            $basic_info[] = array(
                'marital_status' => $request->marital_status,
                'number_of_children' =>$request->number_of_children ,
                'area' =>$request->area ,
                'on_behalf' =>$request->on_behalf ,
            );
            $present_address[] = array(
                'country' => $request->country,
                'state' => $request->state,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
            );
            $education_and_career[] = array(
                'highest_education' => $request->highest_education,
                'occupation' => $request->occupation,
                'annual_income' => $request->incomes,
                'university' => $request->universities,
                'post' => $request->job_post,
                'company_name' => $request->job_company_name,
            );
            $physical_attributes[] = array(
                'weight' => $request->weight,
                'eye_color' => $request->eye_color,
                'hair_color' => $request->hair_color,
                'complexion' => $request->complexion,
                'blood_group' => $request->blood_group,
                'body_type' => $request->body_type,
                'body_art' => $request->body_art,
                'any_disability' => $request->any_disability,
            );
            $language[] = array(
                'mother_tongue' => $request->mother_tongue,
                'language' => $request->language,
                'speak' => $request->speak,
                'read' => $request->read,
            );
            $hobbies_and_interest[] = array(
                'hobby' => $request->hobby,
                'interest' => $request->interest,
                'music' => $request->music,
                'books' => $request->books,
                'movie' => $request->movie,
                'tv_show' => $request->tv_show,
                'sports_show' => $request->sports_show,
                'fitness_activity' => $request->fitness_activity,
                'cuisine' => $request->cuisine,
                'dress_style' => $request->dress_style,
            );
            $personal_attitude_and_behavior[] = array(
                'affection' => $request->affection,
                'humor' => $request->humor,
                'political_view' => $request->political_view,
                'religious_service' => $request->religious_service,
            );
            $residency_information[] = array(
                'birth_country' => $request->birth_country,
                'residency_country' => $request->residency_country,
                'citizenship_country' => $request->citizenship_country,
                'grow_up_country' => $request->grow_up_country,
                'immigration_status' => $request->immigration_status,
            );
            $spiritual_and_social_background[] = array(
                'religion' => $request->religions,
                'caste' => $request->caste,
                'sub_caste' => $request->sub_caste,
                'ethnicity' => $request->ethnicity,
                'personal_value' => $request->personal_value,
                'family_value' => $request->family_value,
                'u_manglik' => $request->u_manglik,
                'community_value' => $request->community_value,
                'family_status' => $request->family_status,
            );
            $life_style[] = array(
                'diet' => $request->diet,
                'drink' => $request->drink,
                'smoke' => $request->smoke,
                'living_with' => $request->living_with,
            );
            $astronomic_information[] = array(
                'sun_sign' => $request->sun_sign,
                'moon_sign' => $request->moon_sign,
                'time_of_birth' => $request->time_of_birth,
                'city_of_birth' => $request->city_of_birth,
            );
            $permanent_address[] = array(
                'permanent_country' => $request->permanent_country,
                'permanent_city' => $request->permanent_city,
                'permanent_state' => $request->permanent_state,
                'permanent_postal_code' => $request->permanent_postal_code,
            );
            $family_info[] = array(
                'father' => $request->father,
                'mother' => $request->mother,
                'brother_sister' => $request->brother_sister,
            );
            $additional_personal_details[] = array(
                'home_district' => $request->home_district,
                'family_residence' => $request->family_residence,
                'fathers_occupation' => $request->fathers_occupation,
                'special_circumstances' => $request->special_circumstances,
            );
            $partner_expectation[] = array(
                'general_requirement' => $request->general_requirement,
                'partner_age' => $request->partner_age,
                'partner_height' => $request->partner_height,
                'partner_weight' => $request->partner_weight,
                'partner_marital_status' => $request->partner_marital_status,
                'with_children_acceptables' => $request->with_children_acceptables,
                'partner_country_of_residence' => $request->partner_country_of_residence,
                'partner_religion' => $request->partner_religion,
                'partner_caste' => $request->partner_caste,
                'partner_complexion' => $request->partner_complexion,
                'partner_education' => implode(',',$request->partner_education),
                'partner_profession' => implode(',',$request->partner_profession),
                'partner_drinking_habits' => $request->partner_drinking_habits,
                'partner_smoking_habits' => $request->partner_smoking_habits,
                'partner_diet' => $request->partner_diet,
                'partner_body_type' => $request->partner_body_type,
                'partner_personal_value' => $request->partner_personal_value,
                'manglik' => $request->manglik,
                'partner_any_disability' => $request->partner_any_disability,
                'partner_mother_tongue' => $request->partner_mother_tongue,
                'partner_family_value' => $request->partner_family_value,
                'prefered_country' => $request->prefered_country,
                'prefered_state' => $request->prefered_state,
                'prefered_status' => $request->prefered_status,
                'partner_sub_caste' => $request->partner_sub_caste,
            );

            $updateData = array(
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'date_of_birth' => strtotime($request->date_of_birth),
                'gender' => $request->gender,
                'height' => $request->height,
                'introduction' => $request->introduction,
                'basic_info' => json_encode($basic_info),
                'present_address' => json_encode($present_address),
                'education_and_career' => json_encode($education_and_career),
                'physical_attributes' => json_encode($physical_attributes),
                'language' => json_encode($language),
                'hobbies_and_interest' => json_encode($hobbies_and_interest),
                'personal_attitude_and_behavior' => json_encode($personal_attitude_and_behavior),
                'residency_information' => json_encode($residency_information),
                'spiritual_and_social_background' => json_encode($spiritual_and_social_background),
                'life_style' => json_encode($life_style),
                'astronomic_information' => json_encode($astronomic_information),
                'permanent_address' => json_encode($permanent_address),
                'family_info' => json_encode($family_info),
                'additional_personal_details' => json_encode($additional_personal_details),
                'partner_expectation' => json_encode($partner_expectation),
            );
        }
        Member::where('id',$id)->update($updateData);
        return back()->with('success','Member is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        date_default_timezone_set('Asia/Dhaka');
        $member = Member::FindOrFail($id);
        $newRecord = $member->replicate();
        $newRecord->setTable('deleted_members');
        $newRecord->save();
        $deletedId = $newRecord->id;
        DB::table('deleted_members')->where('id',$deletedId)->update(array('deleted_by' => Auth::user()->id));
        Member::where('id',$id)->delete();
        return back()->with('success','Member is deleted successfully!');
    }
}
