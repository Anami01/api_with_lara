<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use DB;
use Validator;

class UserapiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all();
        if($data->isnotEmpty()){
            $response = array(
                'success' => true,
                'data' => $data,
                'msg' => 'Data found.'
            );
        }else{
            $response = array(
                'success' => false,
                'msg' => 'No data found.'
            );
        }
        return response()->json($response); 
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
        $rawPostData = json_decode(file_get_contents("php://input"));
        if($rawPostData->name){
            $array = array(
                'name' => $rawPostData->name,
                'email' => $rawPostData->email,
                'password' => $rawPostData->password,
                'api_token' => str_random(60)
            );
            $data = DB::table('users')->insert($array);
            if($data == true){
                $response = array(
                    'success' => true,
                    'msg' => 'Successfully registered'
                );
            }else{
                $response = array(
                    'success' => false,
                    'msg' => 'Something went wrong'
                );
            }
        }else{
            $response = array(
                'success' => false,
                'msg' => 'No data entered.'
            );
        }
        return response()->json($response); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = User::find($id);
        if(is_null($data)){
            $response = array(
                'success' => false,
                'msg' => 'No data found.'
            );
        }else{
            $userData = User::where('id',$id)->firstorFail();
            $response = array(
                'success' => true,
                'data' => $userData,
                'msg' => 'Data found.'
            );
        }
        return response()->json($response); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $rawPostData = json_decode(file_get_contents("php://input"));
        if($rawPostData->name){
            $array = array(
                'name' => $rawPostData->name,
                'email' => $rawPostData->email,
                'password' => $rawPostData->password,
            );
            $data = DB::table('users')->where('id',$id)->update($array);
            if($data == '1'){
                $response = array(
                    'success' => true,
                    'msg' => 'Successfully updated'
                );
            }else{
                $response = array(
                    'success' => false,
                    'msg' => 'Something went wrong'
                );
            }
        }else{
            $response = array(
                'success' => false,
                'msg' => 'No data entered.'
            );
        }
        return response()->json($response); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!empty($id)){
            $data = User::find($id);
            if(is_null($data)){
                $response = array(
                    'success' => false,
                    'msg' => 'User does not exists.'
                ); 
            }else{
                $delete = User::destroy($id);
                $response = array(
                    'success' => true,
                    'msg' => 'Successfully deleted.'
                );
            }
        }else{
            $response = array(
                'success' => false,
                'msg' => 'No data.'
            );
        }
        return response()->json($response); 
    }

    public function login()
    {
        $rawPostData = json_decode(file_get_contents("php://input"));
        if($rawPostData->email && $rawPostData->password){
            $credentials = [
                'email' => $rawPostData->email,
                'password' => $rawPostData->password,
            ];
            if (auth()->attempt($credentials)) {
                $token = auth()->user()->createToken('login')->accessToken;
                return response()->json(['token' => $token], 200);
            } else {
                return response()->json(['error' => 'Unauthorised'], 401);
            }
        }else{
            return response()->json(['error' => 'Something went wrong'], 500);
        }
        
    } 

    public function register()
    {
        $rawPostData = json_decode(file_get_contents("php://input"));
        $user = User::create([
            'name' => $rawPostData->name,
            'address' => $rawPostData->address,
            'email' => $rawPostData->email,
            'password' => bcrypt($rawPostData->password),
        ]);
        $token = $user->createToken('register')->accessToken;
        return response()->json(['token' => $token], 200);
    }

    public function test()
    {
        // $rawPostData = json_decode(file_get_contents("php://input"));
        // $response = array(
        //     'success' => true,
        //     'msg' => $rawPostData
        // );
        // return response()->json($response);

        $data = User::all();
        if($data->isnotEmpty()){
            $response = array(
                'success' => true,
                'data' => $data,
                'msg' => 'Data found.'
            );
        }else{
            $response = array(
                'success' => false,
                'msg' => 'No data found.'
            );
        }
        return response()->json($response); 
    }
}