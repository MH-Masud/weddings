<?php

namespace App\Http\Controllers;

use App\Models\GoogleAnalytics;
use Illuminate\Http\Request;

class GoogleAnalyticsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $googleAnalytics = GoogleAnalytics::first();
        // if ($googleAnalytics) {
        //     $title = 'Google Analytics Update';
        //     $menu = 'Configurations';
        //     return view('backend.google-analytics.edit',compact('title','googleAnalytics','menu'));
        // } else {
            $title = 'Google Analytics Add';
            $menu = 'Configurations';
            return view('backend.google-analytics.create',compact('title','menu'));
        // }
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
        $this->validate($request,[
            'tracking_id' => 'required|max:255'
        ]);
        $googleAnalytics = new GoogleAnalytics();
        $googleAnalytics->active = $request->active ? $request->active : 'no';
        $googleAnalytics->tracking_id = $request->tracking_id;
        $googleAnalytics->save();
        return back()->with('success','Google analytics is updated successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GoogleAnalytics  $googleAnalytics
     * @return \Illuminate\Http\Response
     */
    public function show(GoogleAnalytics $googleAnalytics)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GoogleAnalytics  $googleAnalytics
     * @return \Illuminate\Http\Response
     */
    public function edit(GoogleAnalytics $googleAnalytics)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GoogleAnalytics  $googleAnalytics
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GoogleAnalytics $googleAnalytics)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GoogleAnalytics  $googleAnalytics
     * @return \Illuminate\Http\Response
     */
    public function destroy(GoogleAnalytics $googleAnalytics)
    {
        //
    }
}
