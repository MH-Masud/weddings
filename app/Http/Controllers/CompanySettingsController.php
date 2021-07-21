<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanySettings;

class CompanySettingsController extends Controller
{
    public function index()
    {
        $title = 'General Information';
        $menu = 'Company Settings';
        $company = CompanySettings::first();
        return view('backend.company.index',compact('title','menu','company'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'required|max:255',
            'address' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        if ($request->file('logo')) {
            $logoImage = $this->uploadImage($request->file('logo'), 'uploads/logo', 64, 64, 100, 100);
        } else {
            $logoImage = null;
        }

        $company = new CompanySettings();
        $company->name = $request->name;
        $company->email = $request->email;
        $company->phone = $request->phone;
        $company->address = $request->address;
        $company->logo = $logoImage;
        $company->working_day = $request->working_day;
        $company->working_hour = $request->working_hour;
        $company->app_store_link = $request->app_store_link;
        $company->play_store_link = $request->play_store_link;
        $company->admin_approval = $request->admin_approval;
        $company->save();
        return back()->with('success','General information save successfully.');
    }

    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'required|max:255',
            'address' => 'required',
        ]);
        $company = CompanySettings::findOrFail($id);
        $logo = json_decode($company->logo);

        if ($request->file('logo')) {
            $logoImage = $this->uploadImage($request->file('logo'), 'uploads/logo', 64, 64, 100, 100);

            @unlink(public_path($logo->main));
            @unlink(public_path($logo->thumb));
            @unlink(public_path($logo->small));

            $updateInfo = array(
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'logo' => $logoImage,
                'working_day' => $request->working_day,
                'working_hour' => $request->working_hour,
                'app_store_link' => $request->app_store_link,
                'play_store_link' => $request->play_store_link,
                'admin_approval' => $request->admin_approval,
            );
        } else {
            $updateInfo = array(
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'working_day' => $request->working_day,
                'working_hour' => $request->working_hour,
                'app_store_link' => $request->app_store_link,
                'play_store_link' => $request->play_store_link,
                'admin_approval' => $request->admin_approval,
            );
        }
        CompanySettings::where('id',$id)->update($updateInfo);
        return back()->with('success','General information updated successfully.');
    }
    public function edit(Request $request,$id){
        CompanySettings::where('id',$id)->update(array('google_map' => $request->google_map));
        return back()->with('success','Google map updated successfully.');
    }
    public function show($id){
        $title = 'Google Map';
        $menu = 'Company Settings';
        $map = CompanySettings::where('id',$id)->first()->value('google_map');

        return view('backend.company.google_map',compact('title','menu','map'));
    }
}
