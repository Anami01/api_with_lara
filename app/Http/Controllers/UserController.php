<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{


    /**
     *Display a listing of the resource.
     *@return \Illuminate\Http\Response 
     **/

    public function index()
    {
        $data['data'] = User::all();
        return view('user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('photo');
        $destinationPath = 'uploads';
        $file->move($destinationPath, $file->getClientOriginalName());
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
        return redirect('user');
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
        $data = DB::table('users')->where('id', $id)->first();
        return view('user.form', ['edit_data' => $data]);
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
        $file = $request->file('photo');
        $destinationPath = 'uploads';
        $file->move($destinationPath, $file->getClientOriginalName());
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
        $data = DB::table('users')->where('id', $id)->update($array);
        return redirect('user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();
        return redirect('user');
    }

    /**
     *User registration
     **/
    public function register()
    {
        $data['country'] = DB::table('country')->get();
        return view('user.register', $data);
    }

    /**
     *For logging in system.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if ($request->session()->get('email') != '') {
            return redirect('user');
        } else {
            return view('user.login');
        }
    }
    /**
     *For Setting Session 
     **/
    public function setSession(Request $request)
    {
        $data = DB::table('users')->where('email', $request->username)->where('password', $request->password)->get()->first();
        if ($data) {
            $request->session()->put('email', $request->username);
            $request->session()->put('name', $data->name);
            return redirect('user');
        } else {
            $request->session()->flash('wrong_pass', "Please Enter Correct Username or Password");
            return redirect('login');
        }
    }

    /**
     *For Logging Out
     **/
    public function logout(Request $request)
    {
        $request->session()->forget('email');
        return redirect('login');
    }

    public function check_email(Request $request)
    {
        $data = DB::table('users')->where('email', $request->email)->get();
        if ($data->isEmpty()) {
            echo false;
        } else {
            echo true;
        }
    }

    public function get_state_data($id)
    {
        echo DB::table('state')->where('country_id', $id)->get();
    }


    public function get_city_data($state, $country)
    {
        echo DB::table('city')->where('state_id', $state)->where('country_id', $country)->get();
    }

    /**
     *For Logging Out
     **/
    public function add_city()
    {
        $data['country'] = DB::table('country')->get();
        $data['state'] = DB::table('state')->get();
        return view('user/add_city_state_country', $data);
    }

    /**
     *For Logging Out
     **/
    public function add_city_data(Request $request)
    {
        if (!empty($request->country)) {
            $array = array_filter($request->country);
            if (count($array) == 1) {
                $data = DB::table('country')->insert(array('country_name' => $array[0]));
            } else if (count($array) > 1) {
                foreach ($array as $value) {
                    $data = DB::table('country')->insert(array('country_name' => $value));
                }
            }
        }
        if (!empty($request->state) > 0) {
            $array = array_filter($request->state);
            if (count($array) == 1) {
                $data = DB::table('state')->insert(array('state_name' => $array[0], 'country_id' => $request->country_id_list));
            } else if (count($array) > 1) {
                foreach ($array as $value) {
                    $data = DB::table('state')->insert(array('state_name' => $value, 'country_id' => $request->country_id_list));
                }
            }
        }
        if (!empty($request->city) > 0) {
            $array = array_filter($request->city);
            if (count($array) == 1) {
                $data = DB::table('city')->insert(array('city_name' => $array[0], 'country_id' => $request->country_id_list, 'state_id' => $request->state_id_list));
            } else if (count($array) > 1) {
                foreach ($array as $value) {
                    $data = DB::table('city')->insert(array('city_name' => $value, 'country_id' => $request->country_id_list, 'state_id' => $request->state_id_list));
                }
            }
        }
        return redirect('/');
    }

    /**
     *For generating random data
     **/
    public function testDatabase()
    {
        $users = factory(User::class, 1)->create();
    }

    public function add_user(Request $request)
    {
        $array = array(
            'email' => $request->email,
            'name' => $request->name,
            'password' => $request->password,
        );
        $data = DB::table('users')->insert($array);
        if ($data == true) {
            return redirect('user');
        } else {
            return redirect('register');
        }
    }

    /** 
     *Change Password Form
     **/
    public function change_password()
    {
        return view('user.change_password');
    }

    /** 
     *Change Password Form
     **/
    public function change_pass(Request $request)
    {
        $check = DB::table('users')->where('email', $request->session()->get('email'))->where('password', $request->old_pass)->get();
        if (is_null($check)) {
            $request->session()->flash('pass_change', "Please Enter Correct Password");
            return redirect('change_password');
        } else {
            $data = DB::table('users')->where('email', $request->session()->get('email'))->update(array('password' => $request->new_pass));
            if ($data == '1') {
                return redirect('user');
            } else {
                $request->session()->flash('pass_change', "Please Enter Different Password");
                return redirect('change_password');
            }
        }
    }
}
