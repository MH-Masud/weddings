<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use DataTables;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Contact::orderByDesc('id')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('image', function($row){
                           $image = json_decode($row->image);
                           if ($image) {
                               $btn = '<img src="'.asset('uploads/contact_image/'.$image[0]->thumb).'" title="'.$row->title.'" alt="'.$row->title.'" width="100" height="100">';
                           } else {
                               $btn = '';
                           }
                            return $btn;
                    })
                    ->addColumn('action', function($row){
                           $btn = '<a href="'.route('contact.edit',$row->id).'" title="Edit" class="btn btn-info btn-sm"><i class="fal fa-edit"></i></a> <a href="'.route('contact.destroy',$row->id).'" class="edit btn btn-danger btn-sm" onclick="return confirm_delete('.$row->id.')" title="Delete"><i class="fal fa-trash"></i></a><form id="delete_form_'.$row->id.'" action="'.route('contact.destroy',$row->id).'" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                </form>';
                            return $btn;
                    })
                    ->rawColumns(['image','action'])
                    ->make(true);
        }
        $title = 'Contact List';
        $menu = 'Extra Settings';
        return view('backend.contact.index',compact('title','menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Contact Add';
        $menu = 'Extra Settings';
        return view('backend.contact.create',compact('title','menu'));
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
            'title' => 'required|max:255',
            'image' => 'required|image|mimes:png,jpg,jpeg',
            'link' => 'required'
        ]);
        if ($request->file('image')) {
            $image = $this->uploadImage($request->file('image'), 'uploads/contact_image', 50, 50, 50, 50);
        }else{
            $image = null;
        }
        $contact = new Contact();
        $contact->title = $request->title;
        $contact->image = $image;
        $contact->link = $request->link;
        $contact->save();
        return redirect()->route('contact.index')->with('success','Contact is saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $title = 'Contact Edit';
        $menu = 'Extra Settings';
        $contact = Contact::findOrFail($id);
        return view('backend.contact.edit',compact('title','menu','contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' => 'required|max:255',
            'image' => 'image|mimes:png,jpg,jpeg',
            'link' => 'required'
        ]);
        $oldImage = json_decode(Contact::where('id',$id)->value('image'));
        if ($request->file('image')) {
            $image = $this->uploadImage($request->file('image'), 'uploads/contact_image', 50, 50, 50, 50);
            @unlink('uploads/contact_image/'.$oldImage[0]->image);
            @unlink('uploads/contact_image/'.$oldImage[0]->thumb);
            $updateData = array(
                'title' => $request->title,
                'image' => $image,
                'link' => $request->link,
            );
        }else{
            $updateData = array(
                'title' => $request->title,
                'link' => $request->link,
            );
        }
        Contact::where('id',$id)->update($updateData);
        return back()->with('success','Contact is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $oldImage = json_decode(Contact::where('id',$id)->value('image'));
        @unlink('uploads/contact_image/'.$oldImage[0]->image);
        @unlink('uploads/contact_image/'.$oldImage[0]->thumb);
        Contact::findOrFail($id)->delete();
        return back()->with('success','Contact is deleted successfully!');
    }
}
