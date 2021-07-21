<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Payment;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Hash;
use DataTables;
use Auth;
use Illuminate\Support\Arr;
use DB;
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:user-list', ['only' => ['index','store']]);
         $this->middleware('permission:user-create', ['only' => ['create','store']]);
         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:user-delete', ['only' => ['destroy']]);
         $this->middleware('permission:user-show', ['only' => ['show']]);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<a href="'.route('user.edit',$row->id).'" title="Edit" class="edit btn btn-info btn-sm">Edit</a> <a href="'.route('user.show',$row->id).'" class="edit btn btn-primary btn-sm" title="View">View</a> <a href="'.route('user.destroy',$row->id).'" class="edit btn btn-danger btn-sm" onclick="return confirm_delete('.$row->id.')" title="Delete">Delete</a><form id="delete_form_'.$row->id.'" action="'.route('user.destroy',$row->id).'" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                </form>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        $title = 'User List';
        $menu = 'Admin Settings';
        $users = User::get();
        return view('backend.user.index',compact('title','users','menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Add User';
        $menu = 'Admin Settings';
        $roles = Role::get();
        return view('backend.user.create',compact('title','roles','menu'));
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
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'password' => 'required|confirmed|min:6',
            'roles' => 'required'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $user->assignRole($request->input('roles'));
        return redirect()->route('user.index')->with('success', 'User Created Successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'User Detail';
        $menu = 'Admin Settings';
        $user = User::findOrFail($id);
        $userRole = $user->roles->pluck('name','name')->all();
        return view('backend.user.show',compact('title','user','userRole','menu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Edit User';
        $user = User::findOrFail($id);
        $roles = Role::get();
        $menu = 'Admin Settings';
        $userRole = $user->roles->pluck('name','name')->all();
        return view('backend.user.edit',compact('title','user','roles','userRole','menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'confirmed',
        ]);

        $input = $request->all('name','email','phone','password');
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));
        return back()->with('success', 'User is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'User deleted successfully!');
    }

    public function login(Request $request){
        $remember = $request->rememberme ? true : false;
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)){
            // Session::put('api_base_url',"/laraWeddings/api/");
            // Session::put('api_token','Bearer 2|H1OmHrx6GhicEg32OFp78TGzUOuyySfwwFxqQFpA');
            return redirect()->route('dashboard')->with('success', 'Welcome to dashboard!');
        }else{
            return back()->withInput($request->only('email','password' ,'rememberme'))->with('warning', 'Invalid credential!');
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Successfully logged out!');;
    }

    public function dashboard()
    {
        $title = 'Home';
        $menu = "Dashboard";
        return view('backend.dashboard',compact('title','menu'));
    }
}
