<?php

namespace App\Http\Controllers;
use DB;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller { 

    public function __construct()
    {
        $this->middleware('session')->except(['login','logout','setSession','test','register']);
    }
    /**
    Display a listing of the resource.
    @return \Illuminate\Http\Response 
    **/
    
    public function index() {
        $data['data'] = User::all();
        return view('user/index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user/form');
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
            'name' => 'required',
            'address' => 'required',
            'number' => 'required',
            'gender' => 'required',
            'email' => 'required|unique:users,email',
            'city' => 'required',
            'photo' => 'required',
            'password' => 'required',
        ]);
        $file = $request->file('photo');
        $destinationPath = 'uploads';
        $file->move($destinationPath,$file->getClientOriginalName());
        $array = array(
            'name' => $request->name,
            'address' => $request->address,
            'number' => $request->number,
            'gender' => $request->gender,
            'email' => $request->email,
            'city' => $request->city,
            'photo' => $file->getClientOriginalName(),
            'password' => $request->password,
        );
        $data = DB::table('users')->insert($array);
        return redirect('/user');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DB::table('users')->where('id',$id)->first();
        return view('user/form',['edit_data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'number' => 'required',
            'gender' => 'required',
            'email' => 'required',
            'city' => 'required',
            'photo' => 'required',
            'password' => 'required',
        ]);
        $file = $request->file('photo');
        $destinationPath = 'uploads';
        $file->move($destinationPath,$file->getClientOriginalName());
        $array = array(
            'name' => $request->name,
            'address' => $request->address,
            'number' => $request->number,
            'gender' => $request->gender,
            'email' => $request->email,
            'city' => $request->city,
            'photo' => $file->getClientOriginalName(),
            'password' => $request->password,
        );
        $data = DB::table('users')->where('id',$id)->update($array);
        return redirect('/user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('users')->where('id',$id)->delete();
        return redirect('/user');
    }

     /**
     *For logging in system.
     *
     * @return \Illuminate\Http\Response
     */
     public function login(Request $request)
     {
        if($request->session()->get('email') != ''){
            return redirect('/user');
        }else{
            return view('user/login');
        }
    }
    /**
    *For Setting Session 
    **/
    public function setSession(Request $request)
    {
        $data = DB::table('users')->where('email',$request->username)->where('password',$request->password)->get()->first();
        if($data){
            $request->session()->put('email',$request->username);
            $request->session()->put('name',$data->name);
            return redirect('/user');
        }else{
            $request->session()->flash('wrong_pass',"Please Enter Correct Username or Password");
            return redirect('login');
        }
    } 
    /**
    *For Logging Out
    **/
    public function logout(Request $request)
    {
        $request->session()->forget('email');
        return redirect('/user');
    }

    /**
    For generating random data
    **/
    public function testDatabase()
    {
        $users = factory(User::class, 1)->create();
    }

    /**
    User registration
    **/
    public function register()
    {
        return view('user/register');
    }

    public function add_user(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);
        $array = array(
            'email' => $request->email,
            'name' => $request->name,
            'password' => $request->password,
        );
        $data = DB::table('users')->insert($array);
        if($data == true){
            return redirect('/user');
        }else{
            return redirect('/register');
        }
    }

    /** 
    Change Password Form
    **/
    public function change_password()
    {
        return view('user.change_password');
    }

    /** 
    Change Password Form
    **/
    public function change_pass(Request $request)
    {
        $request->validate([
            'old_pass' => 'required',
            'new_pass' => 'required',
            'confirm_pass' => 'required|same:new_pass',
        ]);
        $check = DB::table('users')->where('email',$request->session()->get('email'))->where('password',$request->old_pass)->get();
        if(is_null($check)){
            $request->session()->flash('pass_change',"Please Enter Correct Password");
            return redirect('change_password');
        }else{
            $data = DB::table('users')->where('email',$request->session()->get('email'))->update(array('password'=>$request->new_pass));
            if($data == '1'){
                return redirect('user');
            }else{
              $request->session()->flash('pass_change',"Please Enter Different Password");
            return redirect('change_password');  
            }
        }
    }
}
