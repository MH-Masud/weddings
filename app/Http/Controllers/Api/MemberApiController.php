<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Caste;
use App\Models\City;
use App\Models\CompanySettings;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\OnBehalf;
use App\Models\Country;
use App\Models\Education;
use App\Models\FamilyStatus;
use App\Models\FamilyValue;
use App\Models\Follow;
use App\Models\FooterLink;
use App\Models\HappyStory;
use App\Models\HowWeWork;
use App\Models\Income;
use App\Models\Language;
use App\Models\MaritalStatus;
use App\Models\Occupation;
use App\Models\PaymentOption;
use App\Models\Plan;
use App\Models\Religion;
use App\Models\SideMenu;
use App\Models\State;
use App\Models\SubCaste;
use App\Models\EmailSetup;
use Hash;
use DB;
use DateTime;
use Mail;
use File;
use Image;

class MemberApiController extends Controller
{
    public function appLogin(Request $request)
    {
        $member = Member::select('shortlisted','view_contact','recent_visitor','membership','package_info','height','email','country_code','mobile','profile_image','id','member_profile_id','first_name','last_name','gender','date_of_birth','introduction','basic_information','religion_information','language_information','diet_information','family_information','education_and_career_information','location_information','contact_details','partner_profile')->where('password',sha1($request->password))->where('email',$request->email)->orWhere('mobile',$request->email)->first();
        if ($member) {

            $pendingInvitations = DB::table('invitations')->where('to',$member->member_profile_id)->where('status','pending')->get();
            $sentInvitations = DB::table('invitations')->where('from',$member->member_profile_id)->get();
            $acceptedInvitations = DB::table('invitations')->where('invitations.status','accepted')->where('invitations.to',$member->member_profile_id)->orWhere('invitations.from',$member->member_profile_id)->where('invitations.status','accepted')->get();

            $basic_information = json_decode($member->basic_information);
            $religion_information = json_decode($member->religion_information);
            $language_information = json_decode($member->language_information);
            $diet_information = json_decode($member->diet_information);
            $family_information = json_decode($member->family_information);
            $education_and_career_information = json_decode($member->education_and_career_information);
            $location_information = json_decode($member->location_information);
            $contact_details = json_decode($member->contact_details);
            $partner_profile = json_decode($member->partner_profile);
            $package_info = json_decode($member->package_info);

            $result = array(
                'phone_number' => $member->country_code.' '.$member->mobile,
                'introduction' => $member->introduction,
                'email' => $member->email,
                'image' => '/uploads/profile_image/'.json_decode($member->profile_image)[0]->image,
                'member_profile_id' => $member->member_profile_id,
                'name' => $member->first_name.' '.$member->last_name,
                'age' => ((date('Y')) - date('Y',$member->date_of_birth)),
                'date_of_birth' => $member->date_of_birth,
                'height' => $member->height,
                'membership' => $member->membership,
                'package_info' => $package_info[0],
                'marital_status' => $basic_information->marital_status,
                'have_child' => $basic_information->have_child,
                'on_behalf' => $basic_information->on_behalf,
                'blood_group' => $basic_information->blood_group,
                'health_information' => $basic_information->health_information,
                'disability' => $basic_information->disability,
                'diet' => $diet_information->diet,
                'religion' => Religion::where('id',$religion_information->religion)->value('name'),
                'caste' => Caste::where('id',$religion_information->caste)->value('name'),
                'sub_caste' => $religion_information->sub_caste,
                'mother_language' => $language_information->mother_language,
                'father_status' => $family_information->father_status,
                'mother_status' => $family_information->mother_status,
                'family_location' => $family_information->family_location,
                'family_type' => $family_information->family_type,
                'family_value' => $family_information->family_value,
                'family_status' => $family_information->family_status,
                'brother' => ($family_information->married_brother + $family_information->unmarried_brother).' of which married '.$family_information->married_brother,
                'sister' => ($family_information->married_sister + $family_information->unmarried_sister).' of which married '.$family_information->married_sister,
                'height_education' => $education_and_career_information->height_education,
                'height_education_college_name' => $education_and_career_information->height_education_college_name,
                'profession_type' => $education_and_career_information->profession_type,
                'profession_name' => $education_and_career_information->profession_name,
                'employer_name' => $education_and_career_information->employer_name,
                'annual_income' => $education_and_career_information->annual_income,
                'country_living_in' => Country::where('id',$location_information->country_living_in)->value('name'),
                'state_living_in' => State::where('id',$location_information->state_living_in)->value('name'),
                'grew_up_in' => $location_information->grew_up_in,
                'city_living_in' => $location_information->city_living_in,
                'residency_status' => $location_information->residency_status,
                'ethnic_origin' => $location_information->ethnic_origin,
                'zip_code' => $location_information->zip_code,
                'shortlisted' => count(json_decode($member->shortlisted)),
                'view_contact' => count(json_decode($member->view_contact)),
                'recent_visitor' => count(json_decode($member->recent_visitor)),
                'pending_invitation' => count($pendingInvitations),
                'accepted_invitation' => count($acceptedInvitations),
                'sent_invitation' => count($sentInvitations),

                'partner_from_age' => $partner_profile->from_age,
                'partner_to_age' => $partner_profile->to_age,
                'partner_from_height' => $partner_profile->from_height,
                'partner_to_height' => $partner_profile->to_height,
                'partner_marital_status' => $partner_profile->marital_status ? array_column($partner_profile->marital_status,'name') : '',
                'partner_having_child' => $partner_profile->having_child,
                'partner_mother_tongue' => $partner_profile->mother_tongue ? array_column($partner_profile->mother_tongue,'name') : '',
                'partner_partner_religion' => $partner_profile->religion ? array_column($partner_profile->religion,'name') : '',
                'partner_partner_caste' => $partner_profile->caste ? array_column($partner_profile->caste,'name') : '',
                'partner_country_living_in' => $partner_profile->country_living_in ? array_column($partner_profile->country_living_in,'name') : '',
                'partner_state_living_in' => $partner_profile->state_living_in ? array_column($partner_profile->state_living_in,'name') : '',
                'partner_city_living_in' => $partner_profile->city_living_in ? array_column($partner_profile->city_living_in,'name') : '',
                'partner_height_education' => $partner_profile->height_education ? array_column($partner_profile->height_education,'name') : '',
                'partner_profession_type' => $partner_profile->profession_type ? array_column($partner_profile->profession_type,'name') : '',
                'partner_profession_name' => $partner_profile->profession_name ? array_column($partner_profile->profession_name,'name') : '',
                'partner_annual_income' => $partner_profile->annual_income ? array_column($partner_profile->annual_income,'name') : '',
                'partner_on_behalf' => $partner_profile->on_behalf ? array_column($partner_profile->on_behalf,'name') : '',
                'partner_diet' => $partner_profile->diet ? array_column($partner_profile->diet,'name') : '',

                'contact_name' => $contact_details->contact_name,
                'relation' => $contact_details->relation,
                'time_from' => $contact_details->time_from,
                'from_hour' => $contact_details->from_hour,
                'time_to' => $contact_details->time_to,
                'to_hour' => $contact_details->to_hour,
                'display_setting' => $contact_details->display_setting,
            );

        } else {
            $result = false;
        }
        return $result;
    }

    public function myAccountData($id){
        $myAccount = Member::where('member_profile_id',$id)->select('shortlisted','viewed')->first();
        $shortlist = json_decode($myAccount->shortlisted);
        $viewed = json_decode($myAccount->viewed);

        $shortlistedMember = Member::whereIn('member_profile_id',$shortlist)->select('profile_image','member_profile_id','first_name','last_name','date_of_birth','height','religion_information','location_information')->limit(4)->get();
        if(count($shortlistedMember) > 0){
            foreach($shortlistedMember as $member){
                $religion_information = json_decode($member->religion_information);
                $location_information = json_decode($member->location_information);
                $invitation = DB::table('invitations')->where('from',$id)->where('to',$member->member_profile_id)->first();
                $sMemberList [] = array(
                    'image' => '/uploads/profile_image/'.json_decode($member->profile_image)[0]->image,
                    'member_profile_id' => $member->member_profile_id,
                    'name' => $member->first_name.' '.$member->last_name,
                    'age' => ((date('Y')) - date('Y',$member->date_of_birth)),
                    'date_of_birth' => $member->date_of_birth,
                    'height' => $member->height,
                    'religion' => Religion::where('id',$religion_information->religion)->value('name'),
                    'caste' => Caste::where('id',$religion_information->caste)->value('name'),
                    'country_living_in' => Country::where('id',$location_information->country_living_in)->value('name'),
                    'state_living_in' => State::where('id',$location_information->state_living_in)->value('name'),
                    'invitationSend' => $invitation ? true : false,
                );
            }
        }else{
            $sMemberList = array();
        }
        
        $viewedMember = Member::whereIn('member_profile_id',$viewed)->select('profile_image','member_profile_id','first_name','last_name','date_of_birth','height','religion_information','location_information')->limit(4)->get();
        if(count($viewedMember) > 0){
            foreach($viewedMember as $member){
                $religion_information = json_decode($member->religion_information);
                $location_information = json_decode($member->location_information);
                $invitation = DB::table('invitations')->where('from',$id)->where('to',$member->member_profile_id)->first();
                $vMemberList [] = array(
                    'image' => '/uploads/profile_image/'.json_decode($member->profile_image)[0]->image,
                    'member_profile_id' => $member->member_profile_id,
                    'name' => $member->first_name.' '.$member->last_name,
                    'age' => ((date('Y')) - date('Y',$member->date_of_birth)),
                    'date_of_birth' => $member->date_of_birth,
                    'height' => $member->height,
                    'religion' => Religion::where('id',$religion_information->religion)->value('name'),
                    'caste' => Caste::where('id',$religion_information->caste)->value('name'),
                    'country_living_in' => Country::where('id',$location_information->country_living_in)->value('name'),
                    'state_living_in' => State::where('id',$location_information->state_living_in)->value('name'),
                    'invitationSend' => $invitation ? true : false,
                );
            }
        }else{
            $vMemberList = array();
        }
        
        $notifications = DB::table('notifications')->join('members','notifications.from','=','members.member_profile_id')->where('to',$id)->select('text','profile_image','member_profile_id','first_name','last_name','date_of_birth','height','religion_information','location_information')->limit(4)->get();
        if(count($notifications) > 0){
            foreach($notifications as $member){
                $religion_information = json_decode($member->religion_information);
                $location_information = json_decode($member->location_information);
                $nMemberList [] = array(
                    'text' => $member->text,
                    'image' => '/uploads/profile_image/'.json_decode($member->profile_image)[0]->image,
                    'member_profile_id' => $member->member_profile_id,
                    'name' => $member->first_name.' '.$member->last_name,
                    'age' => ((date('Y')) - date('Y',$member->date_of_birth)),
                    'date_of_birth' => $member->date_of_birth,
                    'height' => $member->height,
                    'religion' => Religion::where('id',$religion_information->religion)->value('name'),
                    'caste' => Caste::where('id',$religion_information->caste)->value('name'),
                    'country_living_in' => Country::where('id',$location_information->country_living_in)->value('name'),
                    'state_living_in' => State::where('id',$location_information->state_living_in)->value('name'),
                    'invitationSend' => false,
                );
            }
        }else{
            $nMemberList = array();
        }
        
        $allData = array(
            $sMemberList,
            $vMemberList,
            $nMemberList,
        );
        return response()->json($allData);
    }

    public function memberInfo($id)
    {
        $member = Member::select('id','member_profile_id','first_name','last_name','email','mobile','membership','package_info','profile_image')->where('member_profile_id',$id)->first();
        return response()->json($member);
    }

    public function onBehalf()
    {
        $onBehalf = OnBehalf::select('id','name')->get();
        return response()->json($onBehalf);
    }

    public function countryList()
    {
        $countries = Country::select('id','name','phonecode')->get();
        return response()->json($countries);
    }
    
    public function appRegistration(Request $request)
    {
        $emilExist = Member::select('id')->where('email',$request->email)->first();
        $phoneExist = Member::select('id')->where('country_code',$request->countryCode)->where('mobile',$request->phoneNumber)->first();
        if ($emilExist) {
            $result = 'email'; 
        }else if($phoneExist){
            $result = 'phone'; 
        }else {
            date_default_timezone_set($request->timezone);
            $defaultImage[] = array(
                'image' => 'default.jpg',
                'thumb' => 'default_thumb.jpg',
            );
            $images = json_encode($defaultImage);
            $basic_information = array(
                'on_behalf' => $request->onBehalf,
                'marital_status' => '',
                'have_child' => '',
                'child_number' => '',
                'health_information' => '',
                'disability' => '',
                'blood_group' => '',
            );
            $religion_information = array(
                'religion' => '',
                'caste' => '',
                'sub_caste' => '',
            );
            $language_information = array(
                'mother_language' => '',
            );
            $diet_information = array(
                'diet' => '',
            );
            $family_information = array(
                'father_status' => '',
                'mother_status' => '',
                'family_location' => '',
                'family_type' => '',
                'family_value' => '',
                'family_status' => '',
                'married_brother' => 0,
                'married_sister' => 0,
                'unmarried_brother' => 0,
                'unmarried_sister' => 0,
            );
            $education_and_career_information = array(
                'height_education' => '',
                'height_education_college_name' => '',
                'profession_type' => '',
                'profession_name' => '',
                'employer_name' => '',
                'annual_income' => '',
            );
            $location_information = array(
                'country_living_in' => '',
                'state_living_in' => '',
                'city_living_in' => '',
                'residency_status' => '',
                'grew_up_in' => '',
                'ethnic_origin' => '',
                'zip_code' => '',
            );

            $contact_details = array(
                'contact_name' => '',
                'relation' => '',
                'time_from' => '',
                'from_hour' => '',
                'time_to' => '',
                'to_hour' => '',
                'display_setting' => 'Visible to all Premium Members'
            );
            $package_info[] = array(
                'current_package' => 'Default',
                'package_price' => '',
                'payment_type' => '',
                'expire_date' => '',
            );
            $member = new Member();
            $member->first_name = $request->fName;
            $member->last_name = $request->lName;
            $member->gender = $request->gender;
            $member->email = $request->email;
            $member->height = '4.0';
            $member->status = 'approved';
            $member->is_closed = 'no';
            $member->membership = '1';
            $member->country_code = $request->countryCode;
            $member->mobile = $request->phoneNumber;
            $member->date_of_birth = strtotime($request->dateOfBirth);
            $member->password = sha1($request->password);
            $member->profile_image = $images;
            $member->added_by = null;
            $member->member_since = date('Y-m-d H:i:s');
            $member->package_info = json_encode($package_info);
            
            $member->basic_information = json_encode($basic_information);
            $member->religion_information = json_encode($religion_information);
            $member->language_information = json_encode($language_information);
            $member->diet_information =  json_encode($diet_information);
            $member->family_information = json_encode($family_information);
            $member->education_and_career_information = json_encode($education_and_career_information);
            $member->location_information = json_encode($location_information);
            $member->contact_details = json_encode($contact_details);

            $member->save();
            $insert_id = $member->id;
            $memberId = 'HM-'.strtoupper(substr(hash('sha512', rand()), 0, 8)).$insert_id;
            $member->where('id',$insert_id)->update(array('member_profile_id' => $memberId));
            
            $result = $insert_id;
        }
        return response()->json($result);
    }

    public function parentFooterLink()
    {
        $parentFooterLinks = FooterLink::whereNull('parent')->get();
        return response()->json($parentFooterLinks);
    }

    public function childFooterLink($id)
    {
        $childFooterLinks = FooterLink::where('parent',$id)->get();
        return response()->json($childFooterLinks);
    }

    public function footerLink()
    {
        $parents = FooterLink::whereNull('parent')->get();
        foreach ($parents as $parent) {
            $child = FooterLink::select('id','name','slug')->where('parent',$parent->id)->get();
            $result[] = array(
                'id' => $parent->id,
                'name' => $parent->name,
                'slug' => $parent->slug,
                'child' => $child,
            );
        }
        return response()->json($result);
    }

    public function followUs()
    {
        $followUs = Follow::select('id','title','image','link')->get();
        return response()->json($followUs);
    }

    public function payWith()
    {
        $payWith = PaymentOption::select('id','title','desktop_image','mobile_image')->first();
        return response()->json($payWith);
    }

    public function sideMenu()
    {
        $sideMenu = SideMenu::select('id','name','url')->get();
        return response()->json($sideMenu);
    }

    public function companyInfo()
    {
        $companyInfo = CompanySettings::select('address','logo','name','email','phone')->first();
        return response()->json($companyInfo);
    }

    public function howWork()
    {
        $howWork = HowWeWork::select('id','title','image','description')->get();
        return response()->json($howWork);
    }

    public function registrationNext(Request $request,$id)
    {
        $memberInfo = $request->formdata;
        $basic_information = array(
            'on_behalf' => $memberInfo['onBehalf'],
            'marital_status' => $memberInfo['marital_status'],
            'have_child' => $memberInfo['have_child'],
            'child_number' => $memberInfo['child_number'],
            'health_information' => $memberInfo['health_information'],
            'disability' => $memberInfo['disability'],
            'blood_group' => $memberInfo['blood_group'],
        );
        $religion_information = array(
            'religion' => $memberInfo['religion'],
            'caste' => $memberInfo['caste'],
            'sub_caste' => $memberInfo['sub_caste'],
        );
        $language_information = array(
            'mother_language' => $memberInfo['mother_language'],
        );
        $diet_information = array(
            'diet' => $memberInfo['diet'],
        );
        $family_information = array(
            'father_status' => $memberInfo['father_status'],
            'mother_status' => $memberInfo['mother_status'],
            'family_location' => $memberInfo['family_location'],
            'family_type' => $memberInfo['family_type'],
            'family_value' => $memberInfo['family_value'],
            'family_status' => $memberInfo['family_status'],
            'married_brother' => $memberInfo['married_brother'],
            'married_sister' => $memberInfo['married_sister'],
            'unmarried_brother' => $memberInfo['unmarried_brother'],
            'unmarried_sister' => $memberInfo['unmarried_sister'],
        );
        $education_and_career_information = array(
            'height_education' => $memberInfo['height_education'],
            'height_education_college_name' => $memberInfo['height_education_college_name'],
            'profession_type' => $memberInfo['profession_type'],
            'profession_name' => $memberInfo['profession_name'],
            'employer_name' => $memberInfo['employer_name'],
            'annual_income' => $memberInfo['annual_income'],
        );
        $location_information = array(
            'country_living_in' => $memberInfo['country_living_in'],
            'state_living_in' => $memberInfo['state_living_in'],
            'city_living_in' => $memberInfo['city_living_in'],
            'residency_status' => $memberInfo['residency_status'],
            'grew_up_in' => $memberInfo['grew_up_in'],
            'ethnic_origin' => $memberInfo['ethnic_origin'],
            'zip_code' => $memberInfo['zip_code'],
        );
        $updateInformation = array(
            'height' => $memberInfo['height'],
            'introduction' => $memberInfo['introduction'],
            'basic_information' => json_encode($basic_information),
            'religion_information' => json_encode($religion_information),
            'language_information' => json_encode($language_information),
            'diet_information' =>  json_encode($diet_information),
            'family_information' => json_encode($family_information),
            'education_and_career_information' => json_encode($education_and_career_information),
            'location_information' => json_encode($location_information),
        );

        $update = Member::where('id',$id)->update($updateInformation);
        
        if ($update) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    public function premiumPlan()
    {
        $plan = Plan::get();
        return response()->json($plan);
    }

    public function searchResult(Request $request)
    {
        $query = $request->searchQuery;
        $members = Member::select('member_profile_id','first_name','last_name','profile_image','date_of_birth','basic_information','religion_information','education_and_career_information','location_information','language_information')->limit(10)->get(); 
        foreach ($members as $member) {
            $result[] = array(
                'memberId' => $member->member_profile_id, 
                'name' => $member->first_name.' '.$member->last_name,
                'images' => ['/uploads/profile_image/'.json_decode($member->profile_image)[0]->image],
                'age' => ((date('Y')) - date('Y',strtotime($member->date_of_birth))),
                'height' => json_decode($member->basic_information)->height,
                'marital_status' => json_decode($member->basic_information)->marital_status,
                'religion' => json_decode($member->religion_information)->religion,
                'caste' => json_decode($member->religion_information)->caste,
                'height_education' => json_decode($member->education_and_career_information)->height_education,
                'profession_name' => json_decode($member->education_and_career_information)->profession_name,
                'country_living_in' => json_decode($member->location_information)->country_living_in,
                'state_living_in' => json_decode($member->location_information)->state_living_in,
                'mother_language' => json_decode($member->language_information)->mother_language,
                'introduction' => $member->introduction,
            );
        }
        return response()->json($result);
    }

    public function happyStoryList()
    {
        $happyStory = HappyStory::select('title','description','id','image1')->get();
        return response()->json($happyStory);
    }

    public function happyStoryDetail($id)
    {
        $happyStoryDetail = HappyStory::select('title','description','id','image1')->findOrFail($id);
        return response()->json($happyStoryDetail);
    }

    public function Behalf()
    {
        $onBehalf = OnBehalf::get();
        return response()->json($onBehalf);
    }

    public function maritalStatus()
    {
        $marital = MaritalStatus::get();
        return response()->json($marital);
    }

    public function Religion()
    {
        $religion = Religion::get();
        return response()->json($religion);
    }

    public function Caste($id)
    {
        $caste = Caste::where('religion_id',$id)->get();
        return response()->json($caste);
    }

    public function subCaste($id)
    {
        $subCastes = SubCaste::where('caste_id',$id)->get();
        return response()->json($subCastes);
    }

    public function familyValue()
    {
        $familyValues = FamilyValue::get();
        return response()->json($familyValues);
    }

    public function familyStatus()
    {
        $familyStatuses = FamilyStatus::get();
        return response()->json($familyStatuses);
    }

    public function Education()
    {
        $education = Education::get();
        return response()->json($education);
    }

    public function Occupation()
    {
        $Occupations = Occupation::get();
        return response()->json($Occupations);
    }

    public function Income()
    {
        $income = Income::get();
        return response()->json($income);
    }

    public function stateList($id)
    {
        $states = State::select('id','name')->where('country_id',$id)->get();
        return response()->json($states);
    }

    public function cityList($id)
    {
        $cities = City::select('id','name')->where('state_id',$id)->get();
        return response()->json($cities);
    }

    public function Language()
    {
        $languages = Language::get();
        return response()->json($languages);
    }

    public function updateInfo(Request $request, $id)
    {
        $memberInfo = $request->updateData;
        $basic_information = array(
            'on_behalf' => $memberInfo['on_behalf'],
            'marital_status' => $memberInfo['marital_status'],
            'have_child' => $memberInfo['have_child'],
            'child_number' => $memberInfo['child_number'],
            'health_information' => $memberInfo['health_information'],
            'disability' => $memberInfo['disability'],
            'blood_group' => $memberInfo['blood_group'],
        );
        $religion_information = array(
            'religion' => $memberInfo['religion'],
            'caste' => $memberInfo['caste'],
            'sub_caste' => $memberInfo['sub_caste'],
        );
        $language_information = array(
            'mother_language' => $memberInfo['mother_language'],
        );
        $diet_information = array(
            'diet' => $memberInfo['diet'],
        );
        $family_information = array(
            'father_status' => $memberInfo['father_status'],
            'mother_status' => $memberInfo['mother_status'],
            'family_location' => $memberInfo['family_location'],
            'family_type' => $memberInfo['family_type'],
            'family_value' => $memberInfo['family_value'],
            'family_status' => $memberInfo['family_status'],
            'married_brother' => $memberInfo['married_brother'],
            'married_sister' => $memberInfo['married_sister'],
            'unmarried_brother' => $memberInfo['unmarried_brother'],
            'unmarried_sister' => $memberInfo['unmarried_sister'],
        );
        $education_and_career_information = array(
            'height_education' => $memberInfo['height_education'],
            'height_education_college_name' => $memberInfo['height_education_college_name'],
            'profession_type' => $memberInfo['profession_type'],
            'profession_name' => $memberInfo['profession_name'],
            'employer_name' => $memberInfo['employer_name'],
            'annual_income' => $memberInfo['annual_income'],
        );
        $location_information = array(
            'country_living_in' => $memberInfo['country_living_in'],
            'state_living_in' => $memberInfo['state_living_in'],
            'city_living_in' => $memberInfo['city_living_in'],
            'residency_status' => $memberInfo['residency_status'],
            'grew_up_in' => $memberInfo['grew_up_in'],
            'ethnic_origin' => $memberInfo['ethnic_origin'],
            'zip_code' => $memberInfo['zip_code'],
        );
        $dateOfBirth = $memberInfo['year'].'-'.$memberInfo['month'].'-'.$memberInfo['day'];

        $updateInformation = array(
            'height' => $memberInfo['height'],
            'date_of_birth' => strtotime($dateOfBirth),
            'introduction' => $memberInfo['introduction'],
            'basic_information' => json_encode($basic_information),
            'religion_information' => json_encode($religion_information),
            'language_information' => json_encode($language_information),
            'diet_information' =>  json_encode($diet_information),
            'family_information' => json_encode($family_information),
            'education_and_career_information' => json_encode($education_and_career_information),
            'location_information' => json_encode($location_information),
        );
        $update = Member::where('member_profile_id',$id)->update($updateInformation);
        
        if ($update) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    public function memberDetail($id)
    {
        $member = Member::select('height','id','gender','date_of_birth','introduction','basic_information','religion_information','language_information','diet_information','family_information','education_and_career_information','location_information')->where('member_profile_id',$id)->first();
        $memberDetail = array(
            'introduction' => $member->introduction,
            'gender' => $member->gender,
            'height' => $member->height,
            'date_of_birth' => explode("-",date('Y-m-d',  $member->date_of_birth)),
            'basic_information' => json_decode($member->basic_information),
            'diet_information' => json_decode($member->diet_information),
            'education_and_career_information' => json_decode($member->education_and_career_information),
            'family_information' => json_decode($member->family_information),
            'language_information' => json_decode($member->language_information),
            'location_information' => json_decode($member->location_information),
            'religion_information' => json_decode($member->religion_information),
        );
        return response()->json($memberDetail);
    }

    public function allState(Request $request)
    {
        $states = State::select('id','name')->whereIn('country_id',$request->ids)->get();
        return response()->json($states);
    }

    public function allCity(Request $request)
    {
        $cities = City::select('id','name')->whereIn('state_id',$request->ids)->get();
        return response()->json($cities);
    }

    public function updatePartnerProfile(Request $request, $id)
    {
        $partnerData = $request->data;

        $caste = $partnerData['caste'];
        $religion = $partnerData['religion'];
        $to_age = $partnerData['to_age'];
        $from_age = $partnerData['from_age'];
        $from_height = $partnerData['from_height'];
        $to_height = $partnerData['to_height'];
        $having_child = $partnerData['having_child'];
        $annual_income = $partnerData['annual_income'];

        $country_living_in = $partnerData['country_living_in'];
        $state_living_in = $partnerData['state_living_in'];
        $city_living_in = $partnerData['city_living_in'];

        $height_education = $partnerData['height_education'];
        $marital_status = $partnerData['marital_status'];
        $mother_tongue = $partnerData['mother_tongue'];
        $on_behalf = $partnerData['on_behalf'];
        $profession_name = $partnerData['profession_name'];
        $profession_type = $partnerData['profession_type'];
        $diet = $partnerData['diet'];

        $updateData = array(
            'from_age' => $from_age,
            'to_age' => $to_age,
            'from_height' => $from_height,
            'to_height' => $to_height,
            'marital_status' => $marital_status,
            'having_child' => $having_child,
            'mother_tongue' => $mother_tongue,
            'religion' => $religion,
            'caste' => $caste,

            'country_living_in' => $country_living_in,
            'state_living_in' => $state_living_in,
            'city_living_in' => $city_living_in,

            'height_education' => $height_education,
            'profession_type' => $profession_type,
            'profession_name' => $profession_name,
            'annual_income' => $annual_income,

            'on_behalf' => $on_behalf,
            'diet' => $diet,
        );
        $update = Member::where('member_profile_id',$id)->update(array('partner_profile'=>$updateData));
        $result = ($update) ? true : false;
        return $result;
    }

    public function partnerProfile($id)
    {
        $partnerProfile = Member::where('member_profile_id',$id)->value('partner_profile');
        return response()->json(json_decode($partnerProfile));
    }

    public function contactDetails($id)
    {
        $contactInfo = Member::select('country_code','mobile','contact_details')->where('member_profile_id',$id)->first();
        $contactData = array(
            'country_code' => $contactInfo->country_code,
            'mobile' => $contactInfo->mobile,
            'contact_details' => json_decode($contactInfo->contact_details),
        );
        return response()->json($contactData);
    }

    public function updateContactNumber(Request $request, $id)
    {
        $updateData = array(
            'country_code' => $request->country_code,
            'mobile' => $request->mobile_number,
        );
        $update = Member::where('member_profile_id',$id)->update($updateData);
        if ($update) {
            return true;
        } else {
            return false;
        }
    }

    public function updateContactDetails(Request $request, $id)
    {
        $updateData = array(
            'contact_details' => $request->contact_detail,
        );
        $update = Member::where('member_profile_id',$id)->update($updateData);
        if ($update) {
            return true;
        } else {
            return false;
        }
    }

    public function memberProfile($id)
    {
        $member = Member::select('package_info','height','email','country_code','mobile','profile_image','id','member_profile_id','first_name','last_name','gender','date_of_birth','introduction','basic_information','religion_information','language_information','diet_information','family_information','education_and_career_information','location_information','contact_details','partner_profile')->where('member_profile_id',$id)->first();
        $basic_information = json_decode($member->basic_information);
        $religion_information = json_decode($member->religion_information);
        $language_information = json_decode($member->language_information);
        $diet_information = json_decode($member->diet_information);
        $family_information = json_decode($member->family_information);
        $education_and_career_information = json_decode($member->education_and_career_information);
        $location_information = json_decode($member->location_information);
        $contact_details = json_decode($member->contact_details);
        $partner_profile = json_decode($member->partner_profile);
        $package_info = json_decode($member->package_info);

        $memberInfo = array(
            'phone_number' => $member->country_code.' '.$member->mobile,
            'introduction' => $member->introduction,
            'email' => $member->email,
            'image' => '/uploads/profile_image/'.json_decode($member->profile_image)[0]->image,
            'member_profile_id' => $member->member_profile_id,
            'name' => $member->first_name.' '.$member->last_name,
            'age' => ((date('Y')) - date('Y',$member->date_of_birth)),
            'date_of_birth' => $member->date_of_birth,
            'height' => $member->height,
            'package_info' => $package_info,
            'marital_status' => $basic_information->marital_status,
            'have_child' => $basic_information->have_child,
            'on_behalf' => $basic_information->on_behalf,
            'blood_group' => $basic_information->blood_group,
            'health_information' => $basic_information->health_information,
            'disability' => $basic_information->disability,
            'diet' => $diet_information->diet,
            'religion' => Religion::where('id',$religion_information->religion)->value('name'),
            'caste' => Caste::where('id',$religion_information->caste)->value('name'),
            'sub_caste' => $religion_information->sub_caste,
            'mother_language' => $language_information->mother_language,
            'father_status' => $family_information->father_status,
            'mother_status' => $family_information->mother_status,
            'family_location' => $family_information->family_location,
            'family_type' => $family_information->family_type,
            'family_value' => $family_information->family_value,
            'family_status' => $family_information->family_status,
            'brother' => ($family_information->married_brother + $family_information->unmarried_brother).' of which married '.$family_information->married_brother,
            'sister' => ($family_information->married_sister + $family_information->unmarried_sister).' of which married '.$family_information->married_sister,
            'height_education' => $education_and_career_information->height_education,
            'height_education_college_name' => $education_and_career_information->height_education_college_name,
            'profession_type' => $education_and_career_information->profession_type,
            'profession_name' => $education_and_career_information->profession_name,
            'employer_name' => $education_and_career_information->employer_name,
            'annual_income' => $education_and_career_information->annual_income,
            'country_living_in' => Country::where('id',$location_information->country_living_in)->value('name'),
            'state_living_in' => State::where('id',$location_information->state_living_in)->value('name'),
            'grew_up_in' => $location_information->grew_up_in,
            'city_living_in' => $location_information->city_living_in,
            'residency_status' => $location_information->residency_status,
            'ethnic_origin' => $location_information->ethnic_origin,
            'zip_code' => $location_information->zip_code,

            'partner_from_age' => $partner_profile->from_age,
            'partner_to_age' => $partner_profile->to_age,
            'partner_from_height' => $partner_profile->from_height,
            'partner_to_height' => $partner_profile->to_height,
            'partner_marital_status' => $partner_profile->marital_status ? array_column($partner_profile->marital_status,'name') : '',
            'partner_having_child' => $partner_profile->having_child,
            'partner_mother_tongue' => $partner_profile->mother_tongue ? array_column($partner_profile->mother_tongue,'name') : '',
            'partner_partner_religion' => $partner_profile->religion ? array_column($partner_profile->religion,'name') : '',
            'partner_partner_caste' => $partner_profile->caste ? array_column($partner_profile->caste,'name') : '',
            'partner_country_living_in' => $partner_profile->country_living_in ? array_column($partner_profile->country_living_in,'name') : '',
            'partner_state_living_in' => $partner_profile->state_living_in ? array_column($partner_profile->state_living_in,'name') : '',
            'partner_city_living_in' => $partner_profile->city_living_in ? array_column($partner_profile->city_living_in,'name') : '',
            'partner_height_education' => $partner_profile->height_education ? array_column($partner_profile->height_education,'name') : '',
            'partner_profession_type' => $partner_profile->profession_type ? array_column($partner_profile->profession_type,'name') : '',
            'partner_profession_name' => $partner_profile->profession_name ? array_column($partner_profile->profession_name,'name') : '',
            'partner_annual_income' => $partner_profile->annual_income ? array_column($partner_profile->annual_income,'name') : '',
            'partner_on_behalf' => $partner_profile->on_behalf ? array_column($partner_profile->on_behalf,'name') : '',
            'partner_diet' => $partner_profile->diet ? array_column($partner_profile->diet,'name') : '',

            'contact_name' => $contact_details->contact_name,
            'relation' => $contact_details->relation,
            'time_from' => $contact_details->time_from,
            'from_hour' => $contact_details->from_hour,
            'time_to' => $contact_details->time_to,
            'to_hour' => $contact_details->to_hour,
            'display_setting' => $contact_details->display_setting,
        );
        return response()->json($memberInfo);
    }
    
    public function changePassword(Request $request, $id)
    {
        $passwordUpdate = array(
            'password' => sha1($request->password)
        );
        $update = Member::where('member_profile_id',$id)->update($passwordUpdate);
        if ($update) {
            return true;
        } else {
            return false;
        }
        
    }
    public function changeEmail(Request $request, $id)
    {
        $passwordEmail = array(
            'email' => $request->email
        );
        $update = Member::where('member_profile_id',$id)->update($passwordEmail);
        if ($update) {
            return true;
        } else {
            return false;
        }
        
    }

    public function myAccountRegularSearch(Request $request, $start, $end)
    {
        $query = $request->search_query;
        $from_age = strtotime(date('Y') - $query['from_age']."-01-01");
        $to_age = strtotime(date('Y') - $query['to_age']."-01-01");
        $from_height = $query['from_height'];
        $to_height = $query['to_height'];
        $marital_status = array_column($query['marital_status'],'id');
        $religions = array_column($query['religion'],'id');
        $mother_tongues = array_column($query['mother_tongue'],'id');
        $countries_living_in = array_column($query['country_living_in'],'id');
        $states_living_in = array_column($query['state_living_in'],'id');
        $cities_living_in = array_column($query['city_living_in'],'id');
        $height_educations = array_column($query['height_education'],'id');
        $photo_settings = $query['photo_settings'];
        
        $byAge = Member::select('id')->where('date_of_birth', '<=', $from_age)->where('date_of_birth', '>=', $to_age)->pluck('id')->toArray();
        
        $byHeight = Member::select('id')->where('height', '>=', $from_height)->where('height', '<=', $to_height)->pluck('id')->toArray();

        $maritalStatus = Member::select('id');
                            foreach ($marital_status as $marital) {
                                $maritalStatus->where('basic_information', 'like', '%"marital_status":'.$marital.'%');
                            }
        $byMaritalStatus = $maritalStatus->pluck('id')->toArray();

        $religionSearch = Member::select('id');
                            foreach ($religions as $religion) {
                                $religionSearch->where('religion_information', 'like', '%"religion":'.$religion.'%');
                            }
        $byReligion = $religionSearch->pluck('id')->toArray();

        $languageSearch = Member::select('id');
                            foreach ($mother_tongues as $tongue) {
                                $languageSearch->where('language_information', 'like', '%"mother_language":'.$tongue.'%');
                            }
        $byLanguage = $languageSearch->pluck('id')->toArray();

        $countrySearch = Member::select('id');
                            foreach ($countries_living_in as $country) {
                                $countrySearch->where('location_information', 'like', '%"country_living_in":'.$country.'%');
                            }
        $byCountry = $countrySearch->pluck('id')->toArray();

        $stateSearch = Member::select('id');
                            foreach ($states_living_in as $state) {
                                $stateSearch->where('location_information', 'like', '%"state_living_in":'.$state.'%');
                            }
        $byState = $stateSearch->pluck('id')->toArray();

        $citySearch = Member::select('id');
                            foreach ($cities_living_in as $city) {
                                $citySearch->where('location_information', 'like', '%"city_living_in":'.$city.'%');
                            }
        $byCity = $citySearch->pluck('id')->toArray();

        $educationSearch = Member::select('id');
                            foreach ($height_educations as $education) {
                                $educationSearch->where('education_and_career_information', 'like', '%"height_education":'.$education.'%');
                            }
        $byEducation = $educationSearch->pluck('id')->toArray();
        
        $all_ids = array_intersect(
            $byAge,$byHeight,$byMaritalStatus,$byReligion,$byLanguage,$byCountry,$byState,$byCity,$byEducation
        );
        $result = [];
        $search_result = Member::select('introduction','member_profile_id','first_name','last_name','profile_image','date_of_birth','basic_information','religion_information','education_and_career_information','location_information','language_information')->offset($start)->limit($end)->whereIn('id',$all_ids)->get(); 
        foreach ($search_result as $member) {
            $memberInfo = array(
                'memberId' => $member->member_profile_id, 
                'name' => $member->first_name.' '.$member->last_name,
                'images' => ['/uploads/profile_image/'.json_decode($member->profile_image)[0]->image],
                'age' => ((date('Y')) - date('Y',strtotime($member->date_of_birth))),
                'height' => json_decode($member->basic_information)->height,
                'marital_status' => json_decode($member->basic_information)->marital_status,
                'religion' => Religion::where('id',json_decode($member->religion_information)->religion)->value('name'),
                'caste' => Caste::where('id',json_decode($member->religion_information)->caste)->value('name'),
                'height_education' => json_decode($member->education_and_career_information)->height_education,
                'profession_name' => json_decode($member->education_and_career_information)->profession_name,
                'country_living_in' => Country::where('id',json_decode($member->location_information)->country_living_in)->value('name'),
                'state_living_in' => State::where('id',json_decode($member->location_information)->state_living_in)->value('name'),
                'mother_language' => json_decode($member->language_information)->mother_language,
                'introduction' => $member->introduction,
            );
            array_push($result,$memberInfo);
        }
        return response()->json($result);
    }

    public function myAccountAdvancedSearch(Request $request, $start, $end)
    {
        $query = $request->search_query;
        $from_age = strtotime(date('Y') - $query['from_age']."-01-01");
        $to_age = strtotime(date('Y') - $query['to_age']."-01-01");
        $from_height = $query['from_height'];
        $to_height = $query['to_height'];
        $marital_status = array_column($query['marital_status'],'id');
        $on_behalf = array_column($query['on_behalf'],'id');
        $religions = array_column($query['religion'],'id');
        $castes = array_column($query['caste'],'id');
        $mother_tongues = array_column($query['mother_tongue'],'id');
        $have_child = array_column($query['have_child'],'id');

        $countries_living_in = array_column($query['country_living_in'],'id');
        $states_living_in = array_column($query['state_living_in'],'id');
        $cities_living_in = array_column($query['city_living_in'],'id');
        $resident_statuses = array_column($query['resident_status'],'id');
        $grew_up_ins = array_column($query['grew_up_in'],'id');

        $height_educations = array_column($query['height_education'],'id');
        $profession_types = array_column($query['profession_type'],'id');
        $profession_names = array_column($query['profession_name'],'id');
        $annual_incomes = array_column($query['annual_income'],'id');
        $diets = array_column($query['diet'],'id');

        $photo_settings = $query['photo_settings'];

        $byAge = Member::select('id')->where('date_of_birth', '<=',$from_age)->where('date_of_birth', '>=',$to_age)->pluck('id')->toArray();
        
        $byHeight = Member::select('id')->where('height', '>=', $from_height)->where('height', '<=', $to_height)->pluck('id')->toArray();

        $maritalStatus = Member::select('id');
                            foreach ($marital_status as $marital) {
                                $maritalStatus->where('basic_information', 'like', '%"marital_status":'.$marital.'%');
                            }
        $byMaritalStatus = $maritalStatus->pluck('id')->toArray();
        
        $onBehalf = Member::select('id');
                            foreach ($on_behalf as $behalf) {
                                $onBehalf->where('basic_information', 'like', '%"on_behalf":'.$behalf.'%');
                            }
        $byOnBehalf = $onBehalf->pluck('id')->toArray();
        
        $haveChild = Member::select('id');
                            foreach ($have_child as $child) {
                                $haveChild->where('basic_information', 'like', '%"have_child":'.$child.'%');
                            }
        $byHaveChild = $haveChild->pluck('id')->toArray();

        $religionSearch = Member::select('id');
                            foreach ($religions as $religion) {
                                $religionSearch->where('religion_information', 'like', '%"religion":'.$religion.'%');
                            }
        $byReligion = $religionSearch->pluck('id')->toArray();
        
        $casteSearch = Member::select('id');
                            foreach ($castes as $caste) {
                                $casteSearch->where('religion_information', 'like', '%"caste":'.$caste.'%');
                            }
        $byCaste = $casteSearch->pluck('id')->toArray();

        $languageSearch = Member::select('id');
                            foreach ($mother_tongues as $tongue) {
                                $languageSearch->where('language_information', 'like', '%"mother_language":'.$tongue.'%');
                            }
        $byLanguage = $languageSearch->pluck('id')->toArray();

        $countrySearch = Member::select('id');
                            foreach ($countries_living_in as $country) {
                                $countrySearch->where('location_information', 'like', '%"country_living_in":'.$country.'%');
                            }
        $byCountry = $countrySearch->pluck('id')->toArray();

        $stateSearch = Member::select('id');
                            foreach ($states_living_in as $state) {
                                $stateSearch->where('location_information', 'like', '%"state_living_in":'.$state.'%');
                            }
        $byState = $stateSearch->pluck('id')->toArray();

        $citySearch = Member::select('id');
                            foreach ($cities_living_in as $city) {
                                $citySearch->where('location_information', 'like', '%"city_living_in":'.$city.'%');
                            }
        $byCity = $citySearch->pluck('id')->toArray();

        $residentStatus = Member::select('id');
                            foreach ($resident_statuses as $resident_status) {
                                $residentStatus->where('location_information', 'like', '%"residency_status":'.$resident_status.'%');
                            }
        $byResidentStatus = $residentStatus->pluck('id')->toArray();
        
        $grewUpIn = Member::select('id');
                            foreach ($grew_up_ins as $grew_up_in) {
                                $grewUpIn->where('location_information', 'like', '%"grew_up_in":'.$grew_up_in.'%');
                            }
        $byGrewUpIn = $grewUpIn->pluck('id')->toArray();

        $educationSearch = Member::select('id');
                            foreach ($height_educations as $education) {
                                $educationSearch->where('education_and_career_information', 'like', '%"height_education":'.$education.'%');
                            }
        $byEducation = $educationSearch->pluck('id')->toArray();
        
        $professionType = Member::select('id');
                            foreach ($profession_types as $profession_type) {
                                $professionType->where('education_and_career_information', 'like', '%"profession_type":'.$profession_type.'%');
                            }
        $byProfessionType = $professionType->pluck('id')->toArray();
        
        $professionName = Member::select('id');
                            foreach ($profession_names as $profession_name) {
                                $professionName->where('education_and_career_information', 'like', '%"profession_name":'.$profession_name.'%');
                            }
        $byProfessionName = $professionName->pluck('id')->toArray();
        
        $annualIncome = Member::select('id');
                            foreach ($annual_incomes as $annual_income) {
                                $annualIncome->where('education_and_career_information', 'like', '%"annual_income":'.$annual_income.'%');
                            }
        $byAnnualIncome = $annualIncome->pluck('id')->toArray();
        
        $dietSearch = Member::select('id');
                            foreach ($diets as $diet) {
                                $dietSearch->where('diet_information', 'like', '%"diet":'.$diet.'%');
                            }
        $byDiet = $dietSearch->pluck('id')->toArray();
        
        $all_ids = array_intersect(
            $byAge,$byHeight,$byOnBehalf,$byMaritalStatus,$byHaveChild,$byReligion,$byCaste,$byLanguage,$byCountry,$byState,$byCity,$byResidentStatus,$byGrewUpIn,$byEducation,$byProfessionType,$byProfessionName,$byAnnualIncome,$byDiet
        );
        $search_result = Member::select('email','country_code','mobile','introduction','member_profile_id','first_name','last_name','profile_image','date_of_birth','basic_information','religion_information','education_and_career_information','location_information','language_information')->offset($start)->limit($end)->whereIn('id',$all_ids)->get(); 
        $result = [];
        foreach ($search_result as $member) {
            $memberData = array(
                'email' => $member->email,
                'phone' => $member->country_code.''.$member->mobile,
                'memberId' => $member->member_profile_id, 
                'name' => $member->first_name.' '.$member->last_name,
                'images' => ['/uploads/profile_image/'.json_decode($member->profile_image)[0]->image],
                'age' => ((date('Y')) - date('Y',strtotime($member->date_of_birth))),
                'height' => json_decode($member->basic_information)->height,
                'on_behalf' => json_decode($member->basic_information)->on_behalf,
                'marital_status' => json_decode($member->basic_information)->marital_status,
                'religion' => Religion::where('id',json_decode($member->religion_information)->religion)->value('name'),
                'caste' => Caste::where('id',json_decode($member->religion_information)->caste)->value('name'),
                'height_education' => json_decode($member->education_and_career_information)->height_education,
                'profession_name' => json_decode($member->education_and_career_information)->profession_name,
                'country_living_in' => Country::where('id',json_decode($member->location_information)->country_living_in)->value('name'),
                'state_living_in' => State::where('id',json_decode($member->location_information)->state_living_in)->value('name'),
                'mother_language' => json_decode($member->language_information)->mother_language,
                'introduction' => $member->introduction,
            );
            array_push($result,$memberData);
        }
        return response()->json($result);
    }

    public function allCaste(Request $request)
    {
        $castes = Caste::whereIn('religion_id',$request->religion_ids)->get();
        return response()->json($castes);
    }

    public function connectInvitation($to, $from)
    {
        $checkInvitation = DB::table('invitations')->where('to',$to)->where('from',$from)->first();
        if(!$checkInvitation){
            $insertData = array(
                'from' => $from,
                'to' => $to,
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s'),
            );
            DB::table('invitations')->insert($insertData);
            $notify = array(
                'from' => $from,
                'to' => $to,
                'text' => 'has sent an invitation',
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s'),
            );
            $sent = DB::table('notifications')->insert($notify);

            $fromMember = Member::where('member_profile_id',$from)->select('first_name','last_name','email')->first();
            $toMember = Member::where('member_profile_id',$to)->select('first_name','last_name','email')->first();
            
            $emailSetup = EmailSetup::findOrFail(1);
            $emailSubject = str_replace('[[from]]',$fromMember->first_name.' '.$fromMember->last_name,$emailSetup->subject);
            $emailBody = str_replace('[[from]]',$fromMember->first_name.' '.$fromMember->last_name,$emailSetup->body);
            $emailBody = str_replace('[[to]]',$toMember->first_name.' '.$toMember->last_name,$emailBody);
            
            Mail::send('emails.connect-invitation', ['emailBody' => $emailBody], function($message) use($toMember,$emailSubject){
                $message->to($toMember->email);
                $message->subject($emailSubject);
            });
            if ($sent) {
                return response()->json(true);
            } else {
                return response()->json(false);
            }
        }else{
            return response()->json(true);
        }
        
    }

    public function uploadProfileImage(Request $request,$id)
    {
        $destinationPath = public_path('uploads/profile_image');
        $thumb_img = $id.'_'.rand().'_thumb'.'.jpeg' ;
        Image::make(($request->image))->encode('jpeg', 90)->resize(400, 400, function ($constraint) {
            // $constraint->aspectRatio();
        })->save($destinationPath.'/'.$thumb_img);

        $main_img = $id.'_'.rand().'_main'.'.jpeg' ;
        Image::make(($request->image))->encode('jpeg', 90)->save($destinationPath.'/'.$main_img);

        $profile_image[] = array(
            'image' => $main_img,
            'thumb' => $thumb_img,
        );

        $galleryImage = Member::where('member_profile_id',$id)->select('gallery')->first();
        $oldGallery = json_decode($galleryImage->gallery);
        $allImages = array();
        foreach($oldGallery as $old){
            $oldImage = array(
                'image' => $old->image,
                'thumb' => $old->thumb,
                'avatar' => false,
            );
            array_push($allImages,$oldImage);
        }
        $new_profile_image = array(
            'image' => $main_img,
            'thumb' => $thumb_img,
            'avatar' => true,
        );
        array_push($allImages,$new_profile_image);
        
        $updateData = array(
            'profile_image' => json_encode($profile_image),
            'gallery' => json_encode($allImages),
        );
        $update = Member::where('member_profile_id',$id)->update($updateData);
        if($update){
            return response()->json('/uploads/profile_image/'.$thumb_img);
        }else{
            return response()->json(false);
        }
    }
    public function uploadGalleryImage(Request $request,$id)
    {
        $destinationPath = public_path('uploads/profile_image');
        $thumb_img = $id.'_'.rand().'_thumb'.'.jpeg' ;
        Image::make(($request->image))->encode('jpeg', 90)->resize(400, 400, function ($constraint) {
            // $constraint->aspectRatio();
        })->save($destinationPath.'/'.$thumb_img);

        $main_img = $id.'_'.rand().'_main'.'.jpeg' ;
        Image::make(($request->image))->encode('jpeg', 90)->save($destinationPath.'/'.$main_img);

        $new_image = array(
            'image' => $main_img,
            'thumb' => $thumb_img,
            'avatar' => false,
        );

        $galleryImage = Member::where('member_profile_id',$id)->select('gallery')->first();
        $oldGallery = json_decode($galleryImage->gallery);

        array_push($oldGallery,$new_image);
        
        $updateData = array(
            'gallery' => json_encode($oldGallery),
        );
        $update = Member::where('member_profile_id',$id)->update($updateData);
        if($update){
            return response()->json($oldGallery);
        }else{
            return response()->json(false);
        }
    }
    public function makeProfilePhoto($id,$index){
        $galleries = Member::where('member_profile_id',$id)->select('gallery')->first();
        $images = json_decode($galleries->gallery);
        $updateGallery = array();
        foreach($images as $k=> $img){
            if($k == $index){
                $newImage = array(
                    'image' => $img->image,
                    'thumb' => $img->thumb,
                    'avatar' => true,
                );
                $profilePic [] = $newImage;
                Member::where('member_profile_id',$id)->update(array('profile_image' => json_encode($profilePic)));
            }else{
                $newImage = array(
                    'image' => $img->image,
                    'thumb' => $img->thumb,
                    'avatar' => false,
                );
            }
            array_push($updateGallery,$newImage);
        }
        $updated = Member::where('member_profile_id',$id)->update(array('gallery' => json_encode($updateGallery)));
        if($updated){
            return response()->json($updateGallery);
        }else{
            return response()->json(false);
        }
    }
    public function removePhoto($id,$index){
        $gallery = Member::where('member_profile_id',$id)->select('gallery')->first();
        $images = json_decode($gallery->gallery);
        @unlink('uploads/profile_image/'.$images[$index]->image);
        @unlink('uploads/profile_image/'.$images[$index]->thumb);
        unset($images[$index]);
        
        $updated = Member::where('member_profile_id',$id)->update(array('gallery' => json_encode($images)));
        if($updated){
            return response()->json($images);
        }else{
            return response()->json(false);
        }
    }
    public function getGalleryImage($id){
        $gallery = Member::where('member_profile_id',$id)->select('gallery','photo_settings')->first();
        $images[] = json_decode($gallery->gallery);
        $images[] = $gallery->photo_settings;
        return response()->json($images);
    }
    public function contactInvitation($to, $from)
    {
        $insertData = array(
            'from' => $from,
            'to' => $to,
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s'),
        );
        $inserted = DB::table('invitations')->insert($insertData);
        if ($inserted) {
            return true;
        } else {
            return false;
        }
        
    }

    public function photoSettings($id,$type){
        $update = Member::where('member_profile_id',$id)->update(array('photo_settings' => $type));
        if($update){
            return response()->json(true);
        }else{
            return response()->json(false);
        }
    }

    public function checkInvitation($from, $to)
    {
        $invitation = DB::table('invitations')->where('from',$from)->where('to',$to)->first();
        if($invitation){
            return true;
        }else{
            return false;
        }
    }
    

    public function Ignored($memberId, $ignoreId)
    {
        $ignoredIds = json_decode(Member::where('member_profile_id',$memberId)->value('ignored'));
        if(in_array($memberId,$ignoredIds)){
            return true;
        }else{
            array_push($ignoredIds,$ignoreId);
            $updateData = array(
                'ignored' => json_encode($ignoredIds)
            );
            $updated = Member::where('member_profile_id',$memberId)->update($updateData);
            if($updated){
                return true;
            }else{
                return false;
            }
        }
    }

    public function Blocked($memberId, $blockedId)
    {
        $blockedIds = json_decode(Member::where('member_profile_id',$memberId)->value('blocked'));
        if(in_array($memberId,$blockedIds)){
            return true;
        }else{
            array_push($blockedIds,$blockedId);
            $updateData = array(
                'blocked' => json_encode($blockedIds)
            );
            $updated = Member::where('member_profile_id',$memberId)->update($updateData);
            if($updated){
                return true;
            }else{
                return false;
            }
        }
    }

    public function Shortlisted($memberId, $shortlistedId)
    {
        $shortlistedIds = json_decode(Member::where('member_profile_id',$memberId)->value('shortlisted'));
        if(in_array($memberId,$shortlistedIds)){
            return true;
        }else{
            array_push($shortlistedIds,$shortlistedId);
            $updateData = array(
                'shortlisted' => json_encode($shortlistedIds)
            );
            $updated = Member::where('member_profile_id',$memberId)->update($updateData);
            if($updated){
                return true;
            }else{
                return false;
            }
        }
    }

    public function Reported(Request $request,$memberId, $reportedId)
    {
        $reportedIds = json_decode(Member::where('member_profile_id',$memberId)->value('reported'));
        if(in_array($memberId,$reportedIds)){
            return true;
        }else{
            array_push($reportedIds,$reportedId);
            $updateData = array(
                'reported' => json_encode($reportedIds)
            );
            Member::where('member_profile_id',$memberId)->update($updateData);
            $insertData = array(
                'reported_by' => $memberId,
                'reported_to' => $reportedId,
                'reasons' => json_encode($request->reasons),
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s'),
            );
            $inserted = DB::table('profile_reports')->insert($insertData);
            if($inserted){
                return true;
            }else{
                return false;
            }
        }
    }

    public function Invitation($memberId)
    {
        $invitations = DB::table('invitations')->join('members','invitations.from','=','members.member_profile_id')->select('members.email','members.country_code','members.mobile','members.introduction','members.member_profile_id','members.first_name','members.last_name','members.profile_image','members.date_of_birth','members.basic_information','members.religion_information','members.education_and_career_information','members.location_information','members.language_information','invitations.created_at')->where('invitations.to',$memberId)->where('invitations.status','pending')->paginate(10);
        $result = [];
        foreach ($invitations as $member) {
            $memberData = array(
                'email' => $member->email,
                'phone' => $member->country_code.''.$member->mobile,
                'memberId' => $member->member_profile_id, 
                'name' => $member->first_name.' '.$member->last_name,
                'images' => ['/uploads/profile_image/'.json_decode($member->profile_image)[0]->image],
                'age' => ((date('Y')) - date('Y',strtotime($member->date_of_birth))),
                'height' => json_decode($member->basic_information)->height,
                'on_behalf' => json_decode($member->basic_information)->on_behalf,
                'marital_status' => json_decode($member->basic_information)->marital_status,
                'religion' => Religion::where('id',json_decode($member->religion_information)->religion)->value('name'),
                'caste' => Caste::where('id',json_decode($member->religion_information)->caste)->value('name'),
                'height_education' => json_decode($member->education_and_career_information)->height_education,
                'profession_name' => json_decode($member->education_and_career_information)->profession_name,
                'country_living_in' => Country::where('id',json_decode($member->location_information)->country_living_in)->value('name'),
                'state_living_in' => State::where('id',json_decode($member->location_information)->state_living_in)->value('name'),
                'mother_language' => json_decode($member->language_information)->mother_language,
                'introduction' => $member->introduction,
                'created_at' => $this->time_elapsed_string($member->created_at),
            );
            array_push($result,$memberData);
        }
        $response = [
            'current_page' => $invitations->currentPage(),
            'data' => $result,
            'total' => $invitations->total(),
            'per_page' => $invitations->perPage(),
            'last_page' => $invitations->lastPage(),
            'from' => $invitations->firstItem(),
            'to' => $invitations->lastItem(),
        ];
        return response()->json($response);
    }

    public function acceptedInvitation($memberId)
    {
        $invitations = DB::table('invitations')->where('invitations.status','accepted')->where('invitations.to',$memberId)->orWhere('invitations.from',$memberId)->where('invitations.status','accepted')->paginate(10);
        $result = [];
        foreach ($invitations as $invite) {
            if($invite->from == $memberId){
                $member = Member::select('members.email','members.country_code','members.mobile','members.introduction','members.member_profile_id','members.first_name','members.last_name','members.profile_image','members.date_of_birth','members.basic_information','members.religion_information','members.education_and_career_information','members.location_information','members.language_information')->where('member_profile_id',$invite->to)->first();
            }else{
                $member = Member::select('members.email','members.country_code','members.mobile','members.introduction','members.member_profile_id','members.first_name','members.last_name','members.profile_image','members.date_of_birth','members.basic_information','members.religion_information','members.education_and_career_information','members.location_information','members.language_information')->where('member_profile_id',$invite->from)->first();
            }
            
            $memberData = array(
                'email' => $member->email,
                'phone' => $member->country_code.''.$member->mobile,
                'memberId' => $member->member_profile_id, 
                'name' => $member->first_name.' '.$member->last_name,
                'images' => ['/uploads/profile_image/'.json_decode($member->profile_image)[0]->image],
                'age' => ((date('Y')) - date('Y',strtotime($member->date_of_birth))),
                'height' => json_decode($member->basic_information)->height,
                'on_behalf' => json_decode($member->basic_information)->on_behalf,
                'marital_status' => json_decode($member->basic_information)->marital_status,
                'religion' => Religion::where('id',json_decode($member->religion_information)->religion)->value('name'),
                'caste' => Caste::where('id',json_decode($member->religion_information)->caste)->value('name'),
                'height_education' => json_decode($member->education_and_career_information)->height_education,
                'profession_name' => json_decode($member->education_and_career_information)->profession_name,
                'country_living_in' => Country::where('id',json_decode($member->location_information)->country_living_in)->value('name'),
                'state_living_in' => State::where('id',json_decode($member->location_information)->state_living_in)->value('name'),
                'mother_language' => json_decode($member->language_information)->mother_language,
                'introduction' => $member->introduction,
                'created_at' => $this->time_elapsed_string($invite->created_at),
            );
            array_push($result,$memberData);
        }
        $response = [
            'current_page' => $invitations->currentPage(),
            'data' => $result,
            'total' => $invitations->total(),
            'per_page' => $invitations->perPage(),
            'last_page' => $invitations->lastPage(),
            'from' => $invitations->firstItem(),
            'to' => $invitations->lastItem(),
        ];
        return response()->json($response);
    }
    public function declinedInvitation($memberId)
    {
        $invitations = DB::table('invitations')->join('members','invitations.from','=','members.member_profile_id')->select('members.email','members.country_code','members.mobile','members.introduction','members.member_profile_id','members.first_name','members.last_name','members.profile_image','members.date_of_birth','members.basic_information','members.religion_information','members.education_and_career_information','members.location_information','members.language_information','invitations.created_at')->where('invitations.to',$memberId)->where('invitations.status','declined')->paginate(10);
        $result = [];
        foreach ($invitations as $member) {
            $memberData = array(
                'email' => $member->email,
                'phone' => $member->country_code.''.$member->mobile,
                'memberId' => $member->member_profile_id, 
                'name' => $member->first_name.' '.$member->last_name,
                'images' => ['/uploads/profile_image/'.json_decode($member->profile_image)[0]->image],
                'age' => ((date('Y')) - date('Y',strtotime($member->date_of_birth))),
                'height' => json_decode($member->basic_information)->height,
                'on_behalf' => json_decode($member->basic_information)->on_behalf,
                'marital_status' => json_decode($member->basic_information)->marital_status,
                'religion' => Religion::where('id',json_decode($member->religion_information)->religion)->value('name'),
                'caste' => Caste::where('id',json_decode($member->religion_information)->caste)->value('name'),
                'height_education' => json_decode($member->education_and_career_information)->height_education,
                'profession_name' => json_decode($member->education_and_career_information)->profession_name,
                'country_living_in' => Country::where('id',json_decode($member->location_information)->country_living_in)->value('name'),
                'state_living_in' => State::where('id',json_decode($member->location_information)->state_living_in)->value('name'),
                'mother_language' => json_decode($member->language_information)->mother_language,
                'introduction' => $member->introduction,
                'created_at' => $this->time_elapsed_string($member->created_at),
            );
            array_push($result,$memberData);
        }
        $response = [
            'current_page' => $invitations->currentPage(),
            'data' => $result,
            'total' => $invitations->total(),
            'per_page' => $invitations->perPage(),
            'last_page' => $invitations->lastPage(),
            'from' => $invitations->firstItem(),
            'to' => $invitations->lastItem(),
        ];
        return response()->json($response);
    }
    public function sentInvitation($memberId)
    {
        $invitations = DB::table('invitations')->join('members','invitations.to','=','members.member_profile_id')->select('members.email','members.country_code','members.mobile','members.introduction','members.member_profile_id','members.first_name','members.last_name','members.profile_image','members.date_of_birth','members.basic_information','members.religion_information','members.education_and_career_information','members.location_information','members.language_information','invitations.status','invitations.created_at')->where('invitations.from',$memberId)->where('invitations.status','pending')->paginate(1);
        $result = [];
        foreach ($invitations as $member) {
            $memberData = array(
                'email' => $member->email,
                'phone' => $member->country_code.''.$member->mobile,
                'memberId' => $member->member_profile_id, 
                'name' => $member->first_name.' '.$member->last_name,
                'images' => ['/uploads/profile_image/'.json_decode($member->profile_image)[0]->image],
                'age' => ((date('Y')) - date('Y',strtotime($member->date_of_birth))),
                'height' => json_decode($member->basic_information)->height,
                'on_behalf' => json_decode($member->basic_information)->on_behalf,
                'marital_status' => json_decode($member->basic_information)->marital_status,
                'religion' => Religion::where('id',json_decode($member->religion_information)->religion)->value('name'),
                'caste' => Caste::where('id',json_decode($member->religion_information)->caste)->value('name'),
                'height_education' => json_decode($member->education_and_career_information)->height_education,
                'profession_name' => json_decode($member->education_and_career_information)->profession_name,
                'country_living_in' => Country::where('id',json_decode($member->location_information)->country_living_in)->value('name'),
                'state_living_in' => State::where('id',json_decode($member->location_information)->state_living_in)->value('name'),
                'mother_language' => json_decode($member->language_information)->mother_language,
                'introduction' => $member->introduction,
                'created_at' => $this->time_elapsed_string($member->created_at),
            );
            array_push($result,$memberData);
        }
        $response = [
            'current_page' => $invitations->currentPage(),
            'data' => $result,
            'total' => $invitations->total(),
            'per_page' => $invitations->perPage(),
            'last_page' => $invitations->lastPage(),
            'from' => $invitations->firstItem(),
            'to' => $invitations->lastItem(),
        ];
        return response()->json($response);
    }

    public function updateInvitationStatus(Request $request,$from,$to)
    {
        $updateData = array(
            'status' => $request->status
        );
        $update = DB::table('invitations')->where('from',$from)->where('to',$to)->update($updateData);
        if($update){
            return true;
        }else{
            return false;
        }
    }

    function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);
    
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
    
        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }
    
        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

    public function pendingRequestList($memberId){
        
        $pendingRequest = DB::table('requests')->join('members','requests.request_from','=','members.member_profile_id')->select('members.email','members.country_code','members.mobile','members.introduction','members.member_profile_id','members.first_name','members.last_name','members.profile_image','members.date_of_birth','members.basic_information','members.religion_information','members.education_and_career_information','members.location_information','members.language_information','requests.status','requests.request_type','requests.created_at')->where('requests.request_to',$memberId)->where('requests.status','pending')->paginate(1);
        $result = [];
        foreach ($pendingRequest as $member) {
            $memberData = array(
                'email' => $member->email,
                'phone' => $member->country_code.''.$member->mobile,
                'memberId' => $member->member_profile_id, 
                'name' => $member->first_name.' '.$member->last_name,
                'images' => ['/uploads/profile_image/'.json_decode($member->profile_image)[0]->image],
                'age' => ((date('Y')) - date('Y',strtotime($member->date_of_birth))),
                'height' => json_decode($member->basic_information)->height,
                'on_behalf' => json_decode($member->basic_information)->on_behalf,
                'marital_status' => json_decode($member->basic_information)->marital_status,
                'religion' => Religion::where('id',json_decode($member->religion_information)->religion)->value('name'),
                'caste' => Caste::where('id',json_decode($member->religion_information)->caste)->value('name'),
                'height_education' => json_decode($member->education_and_career_information)->height_education,
                'profession_name' => json_decode($member->education_and_career_information)->profession_name,
                'country_living_in' => Country::where('id',json_decode($member->location_information)->country_living_in)->value('name'),
                'state_living_in' => State::where('id',json_decode($member->location_information)->state_living_in)->value('name'),
                'mother_language' => json_decode($member->language_information)->mother_language,
                'introduction' => $member->introduction,
                'created_at' => $this->time_elapsed_string($member->created_at),
                'request_type' => $member->request_type,
            );
            array_push($result,$memberData);
        }
        $response = [
            'current_page' => $pendingRequest->currentPage(),
            'data' => $result,
            'total' => $pendingRequest->total(),
            'per_page' => $pendingRequest->perPage(),
            'last_page' => $pendingRequest->lastPage(),
            'from' => $pendingRequest->firstItem(),
            'to' => $pendingRequest->lastItem(),
        ];
        return response()->json($response);
    }
    public function acceptedRequestList($memberId){
        
        $pendingRequest = DB::table('requests')->join('members','requests.request_from','=','members.member_profile_id')->select('members.email','members.country_code','members.mobile','members.introduction','members.member_profile_id','members.first_name','members.last_name','members.profile_image','members.date_of_birth','members.basic_information','members.religion_information','members.education_and_career_information','members.location_information','members.language_information','requests.status','requests.request_type','requests.created_at')->where('requests.request_to',$memberId)->where('requests.status','accepted')->paginate(1);
        $result = [];
        foreach ($pendingRequest as $member) {
            $memberData = array(
                'email' => $member->email,
                'phone' => $member->country_code.''.$member->mobile,
                'memberId' => $member->member_profile_id, 
                'name' => $member->first_name.' '.$member->last_name,
                'images' => ['/uploads/profile_image/'.json_decode($member->profile_image)[0]->image],
                'age' => ((date('Y')) - date('Y',strtotime($member->date_of_birth))),
                'height' => json_decode($member->basic_information)->height,
                'on_behalf' => json_decode($member->basic_information)->on_behalf,
                'marital_status' => json_decode($member->basic_information)->marital_status,
                'religion' => Religion::where('id',json_decode($member->religion_information)->religion)->value('name'),
                'caste' => Caste::where('id',json_decode($member->religion_information)->caste)->value('name'),
                'height_education' => json_decode($member->education_and_career_information)->height_education,
                'profession_name' => json_decode($member->education_and_career_information)->profession_name,
                'country_living_in' => Country::where('id',json_decode($member->location_information)->country_living_in)->value('name'),
                'state_living_in' => State::where('id',json_decode($member->location_information)->state_living_in)->value('name'),
                'mother_language' => json_decode($member->language_information)->mother_language,
                'introduction' => $member->introduction,
                'created_at' => $this->time_elapsed_string($member->created_at),
                'request_type' => $member->request_type,
            );
            array_push($result,$memberData);
        }
        $response = [
            'current_page' => $pendingRequest->currentPage(),
            'data' => $result,
            'total' => $pendingRequest->total(),
            'per_page' => $pendingRequest->perPage(),
            'last_page' => $pendingRequest->lastPage(),
            'from' => $pendingRequest->firstItem(),
            'to' => $pendingRequest->lastItem(),
        ];
        return response()->json($response);
    }

    public function sentRequestList($memberId){
        
        $pendingRequest = DB::table('requests')->join('members','requests.request_to','=','members.member_profile_id')->select('members.email','members.country_code','members.mobile','members.introduction','members.member_profile_id','members.first_name','members.last_name','members.profile_image','members.date_of_birth','members.basic_information','members.religion_information','members.education_and_career_information','members.location_information','members.language_information','requests.status','requests.request_type','requests.created_at')->where('requests.request_from',$memberId)->paginate(1);
        $result = [];
        foreach ($pendingRequest as $member) {
            $memberData = array(
                'email' => $member->email,
                'phone' => $member->country_code.''.$member->mobile,
                'memberId' => $member->member_profile_id, 
                'name' => $member->first_name.' '.$member->last_name,
                'images' => ['/uploads/profile_image/'.json_decode($member->profile_image)[0]->image],
                'age' => ((date('Y')) - date('Y',strtotime($member->date_of_birth))),
                'height' => json_decode($member->basic_information)->height,
                'on_behalf' => json_decode($member->basic_information)->on_behalf,
                'marital_status' => json_decode($member->basic_information)->marital_status,
                'religion' => Religion::where('id',json_decode($member->religion_information)->religion)->value('name'),
                'caste' => Caste::where('id',json_decode($member->religion_information)->caste)->value('name'),
                'height_education' => json_decode($member->education_and_career_information)->height_education,
                'profession_name' => json_decode($member->education_and_career_information)->profession_name,
                'country_living_in' => Country::where('id',json_decode($member->location_information)->country_living_in)->value('name'),
                'state_living_in' => State::where('id',json_decode($member->location_information)->state_living_in)->value('name'),
                'mother_language' => json_decode($member->language_information)->mother_language,
                'introduction' => $member->introduction,
                'created_at' => $this->time_elapsed_string($member->created_at),
                'request_type' => $member->request_type,
            );
            array_push($result,$memberData);
        }
        $response = [
            'current_page' => $pendingRequest->currentPage(),
            'data' => $result,
            'total' => $pendingRequest->total(),
            'per_page' => $pendingRequest->perPage(),
            'last_page' => $pendingRequest->lastPage(),
            'from' => $pendingRequest->firstItem(),
            'to' => $pendingRequest->lastItem(),
        ];
        return response()->json($response);
    }

    public function newMatch(Request $request){
        $memberID = $request->memberID;
        $memberInfo = Member::select('gender','shortlisted','ignored','blocked','reported','partner_profile','basic_information','religion_information','language_information','diet_information','family_information','education_and_career_information','location_information')->where('member_profile_id',$memberID)->first();
        $partnerInfo = json_decode($memberInfo->partner_profile);

        if ($memberInfo->gender == '1') {
            $gender = '2';
        } else {
            $gender = '1';
        }
        $shortlisted = json_decode($memberInfo->shortlisted);
        $ignored = json_decode($memberInfo->ignored);
        $blocked = json_decode($memberInfo->blocked);
        $reported = json_decode($memberInfo->reported);
        
        $from_age = strtotime(date('Y') - $partnerInfo->from_age."-01-01");
        $to_age = strtotime(date('Y') - $partnerInfo->to_age."-01-01");
        
        

        $newMatchMembers = array();


        $newMatchMembers[] = Member::select('id')->where('date_of_birth', '<=',$from_age)->where('date_of_birth', '>=',$to_age)->pluck('id')->toArray();
        $newMatchMembers[] = Member::select('id')->where('height', '>=', $partnerInfo->from_height)->where('height', '<=', $partnerInfo->to_height)->pluck('id')->toArray();

        

        if($partnerInfo->marital_status[0]->name != "Doesn't matter"){
            $byMaritalStatus = array_column($partnerInfo->marital_status,'name');
            $newMatchMembers[] = Member::select('id')->whereIn('basic_information->marital_status',$byMaritalStatus)->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }else{
            $newMatchMembers[] = Member::select('id')->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }

        if($partnerInfo->having_child[0]->name != "Doesn't matter"){
            $byHaveChild = array_column($partnerInfo->having_child,'name');
            $newMatchMembers[] = Member::select('id')->whereIn('basic_information->have_child',$byHaveChild)->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }else{
            $newMatchMembers[] = Member::select('id')->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }

        if($partnerInfo->mother_tongue[0]->name != "Doesn't matter"){
            $byMotherTongue = array_column($partnerInfo->mother_tongue,'name');
            $newMatchMembers[] = Member::select('id')->whereIn('language_information->mother_language',$byMotherTongue)->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }else{
            $newMatchMembers[] = Member::select('id')->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }
        
        if($partnerInfo->religion[0]->name != "Doesn't matter"){
            $byReligion = array_column($partnerInfo->religion,'id');
            $newMatchMembers[] = Member::select('id')->whereIn('religion_information->religion',$byReligion)->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }else{
            $newMatchMembers[] = Member::select('id')->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }

        if($partnerInfo->caste[0]->name != "Doesn't matter"){
            $byCaste = array_column($partnerInfo->caste,'id');
            $newMatchMembers[] = Member::select('id')->whereIn('religion_information->caste',$byCaste)->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }else{
            $newMatchMembers[] = Member::select('id')->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }
        
        if($partnerInfo->country_living_in[0]->name != "Doesn't matter"){
            $byCountry = array_column($partnerInfo->country_living_in,'id');
            $newMatchMembers[] = Member::select('id')->whereIn('location_information->country_living_in',$byCountry)->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }else{
            $newMatchMembers[] = Member::select('id')->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }

        if($partnerInfo->state_living_in[0]->name != "Doesn't matter"){
            $byState = array_column($partnerInfo->state_living_in,'id');
            $newMatchMembers[] = Member::select('id')->whereIn('location_information->state_living_in',$byState)->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }else{
            $newMatchMembers[] = Member::select('id')->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }

        if($partnerInfo->city_living_in[0]->name != "Doesn't matter"){
            $byCity = array_column($partnerInfo->city_living_in,'name');
            $newMatchMembers[] = Member::select('id')->whereIn('location_information->city_living_in',$byCity)->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }else{
            $newMatchMembers[] = Member::select('id')->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }

        if($partnerInfo->height_education[0]->name != "Doesn't matter"){
            $education = array_column($partnerInfo->height_education,'name');
            $newMatchMembers[] = Member::select('id')->whereIn('education_and_career_information->height_education',$education)->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }else{
            $newMatchMembers[] = Member::select('id')->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }

        if($partnerInfo->profession_type[0]->name != "Doesn't matter"){
            $byProfession = array_column($partnerInfo->profession_type,'name');
            $newMatchMembers[] = Member::select('id')->whereIn('education_and_career_information->profession_type',$byProfession)->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }else{
            $newMatchMembers[] = Member::select('id')->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }

        if($partnerInfo->profession_name[0]->name != "Doesn't matter"){
            $byProfessionName = array_column($partnerInfo->profession_name,'name');
            $newMatchMembers[] = Member::select('id')->whereIn('education_and_career_information->profession_name',$byProfessionName)->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }else{
            $newMatchMembers[] = Member::select('id')->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }

        if($partnerInfo->annual_income[0]->name != "Doesn't matter"){
            $byIncome = array_column($partnerInfo->annual_income,'name');
            $newMatchMembers[] = Member::select('id')->whereIn('education_and_career_information->annual_income',$byIncome)->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }else{
            $newMatchMembers[] = Member::select('id')->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }

        if($partnerInfo->on_behalf[0]->name != "Doesn't matter"){
            $byOnBehalf = array_column($partnerInfo->on_behalf,'name');
            $newMatchMembers[] = Member::select('id')->whereIn('basic_information->on_behalf',$byOnBehalf)->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }else{
            $newMatchMembers[] = Member::select('id')->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }

        if($partnerInfo->diet[0]->name != "Doesn't matter"){
            $byDiet = array_column($partnerInfo->diet,'name');
            $newMatchMembers[] = Member::select('id')->whereIn('diet_information->diet',$byDiet)->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }else{
            $newMatchMembers[] = Member::select('id')->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }
        
        $FilterId = array_filter($newMatchMembers);
        foreach ($newMatchMembers as $item) {
            if (count($item) == 0) {
                $response = [
                    'current_page' => 1,
                    'data' => array(),
                    'total' => 0,
                    'per_page' => 10,
                    'last_page' => 1,
                    'from' => null,
                    'to' => null,
                ];
                return response()->json($response);
            }
        }
        $allId = array_intersect(...$FilterId);

        $matches = DB::table('members')
                        ->select('members.height','members.email','members.country_code','members.mobile','members.introduction','members.member_profile_id','members.first_name','members.last_name','members.profile_image','members.date_of_birth','members.basic_information','members.religion_information','members.education_and_career_information','members.location_information','members.language_information','members.diet_information')
                        ->whereIn('id', $allId)
                        ->paginate(10);
        $result = [];
        foreach ($matches as $member) {
            $youAndHer = array();
            if(json_decode($memberInfo->religion_information)->caste == json_decode($member->religion_information)->caste){
                $youAndHer[] = 'Both from '.Caste::where('id',json_decode($memberInfo->religion_information)->caste)->value('name').' community';
            }
            if(json_decode($memberInfo->language_information)->mother_language == json_decode($member->language_information)->mother_language){
                $youAndHer[] = 'Both mother tongue is '.json_decode($memberInfo->language_information)->mother_language;
            }
            if(json_decode($memberInfo->diet_information)->diet == json_decode($member->diet_information)->diet){
                $youAndHer[] = 'Both like '.json_decode($memberInfo->diet_information)->diet." food";
            }
            if(json_decode($memberInfo->education_and_career_information)->height_education == json_decode($member->education_and_career_information)->height_education){
                $youAndHer[] = 'Both have '.json_decode($memberInfo->education_and_career_information)->height_education." degree";
            }
            if(json_decode($memberInfo->education_and_career_information)->profession_name == json_decode($member->education_and_career_information)->profession_name){
                $youAndHer[] = 'Both profession is '.json_decode($memberInfo->education_and_career_information)->profession_name;
            }
            if(json_decode($memberInfo->location_information)->state_living_in == json_decode($member->location_information)->state_living_in){
                $youAndHer[] = 'Both living in '.State::where('id',json_decode($memberInfo->location_information)->state_living_in)->value('name');
            }
            $memberData = array(
                'email' => $member->email,
                'phone' => $member->country_code.''.$member->mobile,
                'memberId' => $member->member_profile_id, 
                'name' => $member->first_name.' '.$member->last_name,
                'images' => ['/uploads/profile_image/'.json_decode($member->profile_image)[0]->image],
                'age' => ((date('Y')) - date('Y',$member->date_of_birth)),
                'height' => $member->height,
                'on_behalf' => json_decode($member->basic_information)->on_behalf,
                'marital_status' => json_decode($member->basic_information)->marital_status,
                'religion' => Religion::where('id',json_decode($member->religion_information)->religion)->value('name'),
                'caste' => Caste::where('id',json_decode($member->religion_information)->caste)->value('name'),
                'height_education' => json_decode($member->education_and_career_information)->height_education,
                'profession_name' => json_decode($member->education_and_career_information)->profession_name,
                'country_living_in' => Country::where('id',json_decode($member->location_information)->country_living_in)->value('name'),
                'state_living_in' => State::where('id',json_decode($member->location_information)->state_living_in)->value('name'),
                'mother_language' => json_decode($member->language_information)->mother_language,
                'introduction' => $member->introduction,
                'you_and_her' => $youAndHer,
                'invitationSend' => false,
                'partnerInfo' => $partnerInfo,
            );
            array_push($result,$memberData);
        }
        $response = [
            'current_page' => $matches->currentPage(),
            'data' => $result,
            'total' => $matches->total(),
            'per_page' => $matches->perPage(),
            'last_page' => $matches->lastPage(),
            'from' => $matches->firstItem(),
            'to' => $matches->lastItem(),
        ];
        return response()->json($response);
    }

    public function filterResult(Request $request){
        $memberID = $request->memberID;
        $filterData = $request->filterData;
        $memberInfo = Member::select('gender','shortlisted','ignored','blocked','reported','partner_profile','basic_information','religion_information','language_information','diet_information','family_information','education_and_career_information','location_information')->where('member_profile_id',$memberID)->first();
 
        if ($memberInfo->gender == '1') {
            $gender = '2';
        } else {
            $gender = '1';
        }
        $shortlisted = json_decode($memberInfo->shortlisted);
        $ignored = json_decode($memberInfo->ignored);
        $blocked = json_decode($memberInfo->blocked);
        $reported = json_decode($memberInfo->reported);

        $from_age = strtotime(date('Y') - $filterData['from_age']."-01-01");
        $to_age = strtotime(date('Y') - $filterData['to_age']."-01-01");
        
        $filterArray = array();
        $filterArray[] = Member::select('id')->where('date_of_birth', '<=',$from_age)->where('date_of_birth', '>=',$to_age)->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        $filterArray[] = Member::select('id')->where('height', '>=', $filterData['from_height'])->where('height', '<=', $filterData['to_height'])->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        
        if($filterData['marital_status'][0]['name'] != "Doesn't matter"){
            $married = array_column($filterData['marital_status'],'name');
            $filterArray[] = Member::select('id')->whereIn('basic_information->marital_status',$married)->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }else{
            $filterArray[] = Member::select('id')->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }

        if($filterData['have_child'][0]['name'] != "Doesn't matter"){
            $child = array_column($filterData['have_child'],'name');
            $filterArray[] = Member::select('id')->whereIn('basic_information->have_child',$child)->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }else{
            $filterArray[] = Member::select('id')->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }

        if($filterData['mother_tongue'][0]['name'] != "Doesn't matter"){
            $tongue = array_column($filterData['mother_tongue'],'name');
            $filterArray[] = Member::select('id')->whereIn('language_information->mother_language',$tongue)->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }else{
            $filterArray[] = Member::select('id')->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }

        if($filterData['religion'][0]['name'] != "Doesn't matter"){
            $religion = array_column($filterData['religion'],'id');
            $filterArray[] = Member::select('id')->whereIn('religion_information->religion',$religion)->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }else{
            $filterArray[] = Member::select('id')->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }

        if($filterData['caste'][0]['name'] != "Doesn't matter"){
            $caste = array_column($filterData['caste'],'id');
            $filterArray[] = Member::select('id')->whereIn('religion_information->caste',$caste)->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }else{
            $filterArray[] = Member::select('id')->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }

        if($filterData['country_living_in'][0]['name'] != "Doesn't matter"){
            $country = array_column($filterData['country_living_in'],'id');
            $filterArray[] = Member::select('id')->whereIn('location_information->country_living_in',$country)->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }else{
            $filterArray[] = Member::select('id')->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }

        if($filterData['state_living_in'][0]['name'] != "Doesn't matter"){
            $state = array_column($filterData['state_living_in'],'id');
            $filterArray[] = Member::select('id')->whereIn('location_information->state_living_in',$state)->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }else{
            $filterArray[] = Member::select('id')->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }

        if($filterData['city_living_in'][0]['name'] != "Doesn't matter"){
            $city = array_column($filterData['city_living_in'],'name');
            $filterArray[] = Member::select('id')->whereIn('location_information->city_living_in',$city)->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }else{
            $filterArray[] = Member::select('id')->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }
        
        if($filterData['resident_status'][0]['name'] != "Doesn't matter"){
            $resident = array_column($filterData['resident_status'],'name');
            $filterArray[] = Member::select('id')->whereIn('location_information->residency_status',$resident)->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }else{
            $filterArray[] = Member::select('id')->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }
        
        if($filterData['grew_up_in'][0]['name'] != "Doesn't matter"){
            $grewUp = array_column($filterData['grew_up_in'],'name');
            $filterArray[] = Member::select('id')->whereIn('location_information->grew_up_in',$grewUp)->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }else{
            $filterArray[] = Member::select('id')->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }

        if($filterData['height_education'][0]['name'] != "Doesn't matter"){
            $education = array_column($filterData['height_education'],'name');
            $filterArray[] = Member::select('id')->whereIn('education_and_career_information->height_education',$education)->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }else{
            $filterArray[] = Member::select('id')->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }

        if($filterData['profession_type'][0]['name'] != "Doesn't matter"){
            $profession = array_column($filterData['profession_type'],'name');
            $filterArray[] = Member::select('id')->whereIn('education_and_career_information->profession_type',$profession)->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }else{
            $filterArray[] = Member::select('id')->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }

        if($filterData['profession_name'][0]['name'] != "Doesn't matter"){
            $professionName = array_column($filterData['profession_name'],'name');
            $filterArray[] = Member::select('id')->whereIn('education_and_career_information->profession_name',$professionName)->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }else{
            $filterArray[] = Member::select('id')->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }

        if($filterData['annual_income'][0]['name'] != "Doesn't matter"){
            $income = array_column($filterData['annual_income'],'name');
            $filterArray[] = Member::select('id')->whereIn('education_and_career_information->annual_income',$income)->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }else{
            $filterArray[] = Member::select('id')->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }

        if($filterData['on_behalf'][0]['name'] != "Doesn't matter"){
            $onBehalf = array_column($filterData['on_behalf'],'name');
            $filterArray[] = Member::select('id')->whereIn('basic_information->on_behalf',$onBehalf)->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }else{
            $filterArray[] = Member::select('id')->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }

        if($filterData['diet'][0]['name'] != "Doesn't matter"){
            $diet = array_column($filterData['diet'],'name');
            $filterArray[] = Member::select('id')->whereIn('diet_information->diet',$diet)->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }else{
            $filterArray[] = Member::select('id')->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }
        
        
        if($filterData['photo_settings'][0]['name'] != "Doesn't matter"){
            $photoSettings = array_column($filterData['photo_settings'],'name');
            $allPhoto = array();
            if (in_array('Without Photo',$photoSettings)) {
                $allPhoto = Member::select('id')->where('profile_image','like','%"image":"default.jpg"%')->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
            }
            if (in_array('Protected Photo',$photoSettings)) {
                $allPhoto = Member::select('id')->where('profile_image','not like','%"image":"default.jpg"%')->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
            }
            if (in_array('With Photo',$photoSettings)) {
                $allPhoto = Member::select('id')->where('profile_image','not like','%"image":"default.jpg"%')->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
            }
            $filterArray[] = $allPhoto;
        }else{
            $filterArray[] = Member::select('id')->where('gender',$gender)->whereNotIn('member_profile_id',$shortlisted)->whereNotIn('member_profile_id',$ignored)->whereNotIn('member_profile_id',$blocked)->whereNotIn('member_profile_id',$reported)->pluck('id')->toArray();
        }
        $FilterId = array_filter($filterArray);
        foreach ($filterArray as $item) {
            if (count($item) == 0) {
                $response = [
                    'current_page' => 1,
                    'data' => array(),
                    'total' => 0,
                    'per_page' => 10,
                    'last_page' => 1,
                    'from' => null,
                    'to' => null,
                ];
                return response()->json($response);
            }
        }
        $allId = array_intersect(...$FilterId);
        
        $matches = DB::table('members')
                        ->select('height','members.email','members.country_code','members.mobile','members.introduction','members.member_profile_id','members.first_name','members.last_name','members.profile_image','members.date_of_birth','members.basic_information','members.religion_information','members.education_and_career_information','members.location_information','members.language_information','members.diet_information')
                        ->whereIn('id', $allId)
                        ->paginate(10);
        $result = [];
        foreach ($matches as $member) {
            $youAndHer = array();
            if(json_decode($memberInfo->religion_information)->caste == json_decode($member->religion_information)->caste){
                $youAndHer[] = 'Both from '.Caste::where('id',json_decode($memberInfo->religion_information)->caste)->value('name').' community';
            }
            if(json_decode($memberInfo->language_information)->mother_language == json_decode($member->language_information)->mother_language){
                $youAndHer[] = 'Both mother tongue is '.json_decode($memberInfo->language_information)->mother_language;
            }
            if(json_decode($memberInfo->diet_information)->diet == json_decode($member->diet_information)->diet){
                $youAndHer[] = 'Both like '.json_decode($memberInfo->diet_information)->diet." food";
            }
            if(json_decode($memberInfo->education_and_career_information)->height_education == json_decode($member->education_and_career_information)->height_education){
                $youAndHer[] = 'Both have '.json_decode($memberInfo->education_and_career_information)->height_education." degree";
            }
            if(json_decode($memberInfo->education_and_career_information)->profession_name == json_decode($member->education_and_career_information)->profession_name){
                $youAndHer[] = 'Both profession is '.json_decode($memberInfo->education_and_career_information)->profession_name;
            }
            if(json_decode($memberInfo->location_information)->state_living_in == json_decode($member->location_information)->state_living_in){
                $youAndHer[] = 'Both living in '.State::where('id',json_decode($memberInfo->location_information)->state_living_in)->value('name');
            }
            $memberData = array(
                'email' => $member->email,
                'phone' => $member->country_code.''.$member->mobile,
                'memberId' => $member->member_profile_id, 
                'name' => $member->first_name.' '.$member->last_name,
                'images' => ['/uploads/profile_image/'.json_decode($member->profile_image)[0]->image],
                'age' => ((date('Y')) - date('Y',$member->date_of_birth)),
                'height' => $member->height,
                'on_behalf' => json_decode($member->basic_information)->on_behalf,
                'marital_status' => json_decode($member->basic_information)->marital_status,
                'religion' => Religion::where('id',json_decode($member->religion_information)->religion)->value('name'),
                'caste' => Caste::where('id',json_decode($member->religion_information)->caste)->value('name'),
                'height_education' => json_decode($member->education_and_career_information)->height_education,
                'profession_name' => json_decode($member->education_and_career_information)->profession_name,
                'country_living_in' => Country::where('id',json_decode($member->location_information)->country_living_in)->value('name'),
                'state_living_in' => State::where('id',json_decode($member->location_information)->state_living_in)->value('name'),
                'mother_language' => json_decode($member->language_information)->mother_language,
                'introduction' => $member->introduction,
                'you_and_her' => $youAndHer,
                'invitationSend' => false,
            );
            array_push($result,$memberData);
        }
        $response = [
            'current_page' => $matches->currentPage(),
            'data' => $result,
            'total' => $matches->total(),
            'per_page' => $matches->perPage(),
            'last_page' => $matches->lastPage(),
            'from' => $matches->firstItem(),
            'to' => $matches->lastItem(),
        ];
        return response()->json($response);
    }
    public function cancelInvitationStatus($fromId, $toId)
    {
        $deleted = DB::table('invitations')->where('from',$fromId)->where('to',$toId)->delete();
        if($deleted){
            return response()->json(true);
        }else{
            return response()->json(false);
        }
    }

    public function dynamicPage($id){
        $page = FooterLink::where('slug','like','%'.$id.'%')->first();
        return response()->json($page);
    }
}
