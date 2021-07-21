<?php

namespace App\Http\Controllers;

use App\Models\SMTP;
use Illuminate\Http\Request;

class SMTPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'SMTP Setting';
        $menu = "Company Settings";
        $smtp = SMTP::first();
        return view('backend.smtp.index',compact('title','menu','smtp'));
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
            'smtp_status' => 'required',
            'host_name' => 'required',
            'port' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        $smtp = new SMTP();
        $smtp->smtp_status = $request->smtp_status;
        $smtp->host_name = $request->host_name;
        $smtp->port = $request->port;
        $smtp->username = $request->username;
        $smtp->password = $request->password;

        $smtp->save();
        return back()->with('success','SMTP is saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SMTP  $sMTP
     * @return \Illuminate\Http\Response
     */
    public function show(SMTP $sMTP)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SMTP  $sMTP
     * @return \Illuminate\Http\Response
     */
    public function edit(SMTP $sMTP)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SMTP  $sMTP
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'smtp_status' => 'required',
            'host_name' => 'required',
            'port' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        $smtpUpdate = array(
            'smtp_status' => $request->smtp_status,
            'host_name' => $request->host_name,
            'port' => $request->port,
            'username' => $request->username,
            'password' => $request->password,
        );
        SMTP::where('id',$id)->update($smtpUpdate);
        return back()->with('success','SMTP is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SMTP  $sMTP
     * @return \Illuminate\Http\Response
     */
    public function destroy(SMTP $sMTP)
    {
        //
    }
}
