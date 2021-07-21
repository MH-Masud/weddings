<?php

namespace App\Http\Controllers;

use App\Models\DeletedMember;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class DeletedMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DeletedMember::orderByDesc('id')->get();
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
                            $btn = '<a href="javascript:void(0)" id="restoreMember_'.$row->id.'" title="Restore" onclick="return restore('.$row->id.')" class="edit btn btn-info btn-sm"><i class="fal fa-undo"></i></a>';
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
                    ->addColumn('featured',function($row){
                        $featured = '<span class="badge badge-success">'.$row->featured.'</span>';
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
                    ->addColumn('deleted_at',function($row){
                        $deleted_at = '<span>'.date('jS \\of F Y h:i:s A', strtotime($row->created_at)).'</span>';
                        return $deleted_at;
                    })
                    ->addColumn('deleted_by',function($row){
                        $user = User::where('id',$row->deleted_by)->value('name');
                        $deleted_by = '<span>'.$user.'</span>';
                        return $deleted_by;
                    })
                    ->rawColumns(['action','image','is_closed','featured','member_group','member_since','deleted_at','deleted_by'])
                    ->make(true);
        }
        $title = "Deleted Member List";
        $menu = "Members";

        return view('backend.deleted-member.index',compact('title','menu'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DeletedMember  $deletedMember
     * @return \Illuminate\Http\Response
     */
    public function show(DeletedMember $deletedMember)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DeletedMember  $deletedMember
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        date_default_timezone_set('Asia/Dhaka');
        $deletedMember = DeletedMember::findOrFail($id);
        $restoreMember = $deletedMember->replicate();
        unset($restoreMember->deleted_by);
        unset($restoreMember->added_by);

        $restoreMember->setTable('members');
        $restoreMember->save();
        DeletedMember::where('id',$id)->delete();
        return back()->with('success','Member is restored successfully!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DeletedMember  $deletedMember
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeletedMember $deletedMember)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DeletedMember  $deletedMember
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeletedMember $deletedMember)
    {
        //
    }
}
