<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
//use Illuminate\Support\Facades\Auth;
use Validator;

class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
//    private $minutes = 7*24*60;// 7 суток
    private $minutes = 10;// 7 суток
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
//            'c_password' => 'required|same:password',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $apitoken = Str::random(60);
        $user = User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => $input['password'],
  //              'remember_token' => $input['c_password'],
                'api_token' => $apitoken,
            ]);
//        $user = User::create($input);
//        $success['token'] =  $user->createToken('MyApp')->accessToken;
//        $success['name'] =  $user->name;
//        $minutes = 7*24*60; // 7 суток
        
        return $this->sendResponseAuth($user, $apitoken, $this->minutes, 'User register successfully.');
    }
    
    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $input = $request->all();
        $user = User::where('email', $input['email'])->first();
        if ( $user && Hash::check($input['password'], $user->password) ) {
            $apitoken = $user->api_token;
//            $minutes = 7*24*60;
            return $this->sendResponseAuth($user, $apitoken, $this->minutes, 'User login successfully.');
        }
        return $this->sendError('Login Error.', ['login failed','login or pass incorrect']);       
//        $user = User::create($input);
//        $success['token'] =  $user->createToken('MyApp')->accessToken;
//        $success['name'] =  $user->name;
       
    }
    
    public function logout(Request $request) {
        return $this->sendResponseLogout('User logout successfully.');
    }
    
    public function error(Request $request, $msg_id) {
        $arraymsg[1] = 'Incorrect token, please login';
        $arraymsg[2] = 'User already log in';
        $arraymsg[3] = 'User already registered';
        $arraymsg[4] = 'User not authorized';
        return $this->sendError('Error:', ['Error',$arraymsg[$msg_id]]);  
    }    
    
    public function test(Request $request) {
        return $this->sendResponseTest('Test passed. token is valid.');
    }    
    
}
