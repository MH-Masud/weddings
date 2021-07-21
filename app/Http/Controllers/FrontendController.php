<?php

namespace App\Http\Controllers;

use App\Models\CompanySettings;
use App\Models\FooterLink;
use App\Models\Gallery;
use App\Models\HappyStory;
use App\Models\Member;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function Index()
    {
        
        $slider = Slider::get();
        // $premiumMember = Member::select('id','member_profile_id','profile_image','date_of_birth')->where('membership','2')->inRandomOrder()->limit(6)->get();
        $happyStory = HappyStory::limit(6)->get();
        $footerLink = FooterLink::whereNull('parent')->get();
        return view('frontend.index');
    }
}
