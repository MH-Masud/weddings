<?php

namespace App\Http\Controllers;

use App\Models\Recaptcha;
use Illuminate\Http\Request;

class RecaptchaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recaptcha = Recaptcha::first();
        if ($recaptcha) {
            $title = 'Recaptcha Update';
            $menu = 'Configurations';
            return view('backend.recaptcha.edit',compact('title','recaptcha','menu'));
        } else {
            $title = 'Recaptcha Add';
            $menu = 'Configurations';
            return view('backend.recaptcha.create',compact('title','menu'));
        }
        
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
            'site_key' => 'required|max:255',
            'secret_key' => 'required|max:255',
        ]);
        $recaptcha = new Recaptcha();
        $recaptcha->active = ($request->active) ? $request->active : 'no' ;
        $recaptcha->secret_key = $request->secret_key;
        $recaptcha->site_key = $request->site_key;
        $recaptcha->save();

        return redirect()->route('recaptcha.index')->with('Recaptcha is added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recaptcha  $recaptcha
     * @return \Illuminate\Http\Response
     */
    public function show(Recaptcha $recaptcha)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recaptcha  $recaptcha
     * @return \Illuminate\Http\Response
     */
    public function edit(Recaptcha $recaptcha)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recaptcha  $recaptcha
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'site_key' => 'required|max:255',
            'secret_key' => 'required|max:255',
        ]);

        $updateData = array(
            'active' => $request->active ? $request->active : 'no',
            'site_key' => $request->site_key,
            'secret_key' => $request->secret_key,
        );
        Recaptcha::where('id',$id)->update($updateData);
        return back()->with('success','Recaptcha is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recaptcha  $recaptcha
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recaptcha $recaptcha)
    {
        //
    }
}
