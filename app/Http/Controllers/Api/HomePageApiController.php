<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CompanySettings;
use App\Models\Country;
use App\Models\Follow;
use App\Models\FooterLink;
use App\Models\Gallery;
use App\Models\HappyStory;
use App\Models\Member;
use App\Models\Payment;
use App\Models\PaymentOption;
use App\Models\Religion;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomePageApiController extends Controller
{
    public function slider()
    {
        $Slider = Slider::select('desktop_image','mobile_image','text','id')->get();
        return response()->json($Slider);
    }

    public function premiumMember()
    {
        $premiumMembers = Member::where('membership','2')->select('member_profile_id', 'profile_image')->inRandomOrder()->limit(10)->get();
        foreach ($premiumMembers as $pMember) {
            $image = json_decode($pMember->profile_image);
            $premiumMember [] = array(
                'id' => $pMember->id,
                'member_profile_id' => $pMember->member_profile_id,
                'image' => 'uploads/profile_image/'.$image[0]->thumb,
            );
        }
        return response()->json($premiumMember);
    }

    public function happyStory()
    {
        $happyStories = HappyStory::with('happyStoryMember')->get();
        foreach ($happyStories as $hStory) {
            $image = json_decode($hStory->image1);
            $happyStory[] = array(
                'id' => $hStory->id,
                'title' => $hStory->title,
                'name' => $hStory->happyStoryMember->first_name.' '.$hStory->happyStoryMember->last_name.' & '.$hStory->partner_name,
                'image' => 'uploads/happy_story_image/'.$image[0]->thumb,
            );
        }
        return response()->json($happyStory);
    }

    public function homeGallery()
    {
        $homeGalleries = Gallery::get();
        foreach ($homeGalleries as $hGallery) {
            $image = json_decode($hGallery->image);
            $homeGallery[] = array(
                'id' => $hGallery->id,
                'image' => 'uploads/company_gallery_image/'.$image[0]->thumb,
            );
        }
        $galleryImages = array_chunk($homeGallery,4);
        return response()->json($galleryImages);
    }

    public function socialLink()
    {
        $socialLinks = Follow::select('title','image','link')->get();
        foreach ($socialLinks as $slLink) {
            $image = json_decode($slLink->image);
            $socialLink[] = array(
                'title' => $slLink->title,
                'link' => $slLink->link,
                'image' => 'uploads/follow_image/'.$image[0]->image,
            );
        }
        return response()->json($socialLink);
    }

    public function companyInfo()
    {
        $companyInfo = CompanySettings::first();
        $email = explode(",",$companyInfo->email);
        $phone = explode(",",$companyInfo->phone);
        $logo = json_decode($companyInfo->logo);
        $companyInformation = array(
            'name' => $companyInfo->name,
            'address' => $companyInfo->address,
            'phone' => $phone,
            'email' => $email,
            'logo' => 'uploads/logo/'.$logo[0]->image,
        );
        return response()->json($companyInformation);
    }

    public function footerLink()
    {
        $footerLink[] = FooterLink::whereNull('parent')->select('id','name')->get();
        $footerLink[] = FooterLink::where('parent','!=','')->select('id','name','slug','parent')->get();
        return response()->json($footerLink);
    }

    public function paymentOption()
    {
        $paymentOption = PaymentOption::select('image')->first();
        $image = json_decode($paymentOption->image);
        $paymentMethod = array(
            'image' => 'uploads/payment_option_image/'.$image[0]->image 
        );
        return response()->json($paymentMethod);
    }

    public function religion()
    {
        $religion = Religion::select('id','name')->get();
        return response()->json($religion);
    }

    public function country()
    {
        $country = Country::select('id','name')->get();
        return response()->json($country);
    }
}
