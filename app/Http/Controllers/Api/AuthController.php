<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollectionResource;
use App\Http\Resources\UserResource;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
   public function login(Request $request)
   {
      //validate the request 
       $data = $request->validate([
           'email'    => 'required|email',
           'password' => 'required',
       ]);
       if(auth()->attempt($data)){
        $user = auth()->user();

        //generate access token for the user
        $token= $user->createToken('user-login')->accessToken;

        // assign token to user response 
        $user->token = $token;
        //user api resource to return data
        $user = new UserResource($user);
        // return success response response 
        return $this->sendResponse($user, "Login successfull");
        }else {
            // return failed response 
            return $this->sendError('Credentails not match', 400 );
        }
    }
    public function register(Request $request)
    {
        // Validate request
        $data = $request->validate([
            "first_name" => "required",
            "last_name" => "required",
            "email" => "required|email|unique:users",
            "phone" => "required|unique:users|max:11",
            "password" => "required|string|min:6|confirmed",
        ]);
        
      
        // register user 
        $register_user = User::create([
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);
        

        if($register_user) {
            //if user created then create profile for the user
            Profile::create([
                'user_id' => $register_user->id,
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
            ]);

            //generate access token for the user
            $token= $register_user->createToken('user-login')->accessToken;

            //find user
            $user = User::find($register_user->id);
            $user->token = $token;
            //user api resource to return data
            $user = new UserResource($user);
            return $this->sendResponse($user, "Register success", 201 );
        }else {
            return $this->sendError('Failed to register'. 400);
        }
    }

    public function user_profile()
    {
        //find auth user
        $user = auth()->user();

        //if find return user with resource
        if($user) {
            // make token null to avoid error
            $user->token = null;
            $user = new UserResource($user);
            return $this->sendResponse($user, "Register success");
        }else {
            // return failed response 
            return $this->sendError('User not found role found', 404);
        }
        
    }
    public function single_users($user_id)
    {
        //find user with the request id
        $user = User::find($user_id);

        //if find return user with resource
        if($user) {
            // make token null to avoid error
            $user->token = null;
            $user = new UserResource($user);
            return $this->sendResponse($user, "Register success");
        }else {
            // return failed response 
            return $this->sendError('User not found role found', 404);
        }
        
    }
    public function all_users()
    {
        $users = User::orderBy('id', 'desc')->get();

        if(count($users) > 0) {
            $users = UserCollectionResource::collection($users);
            return $this->sendResponse($users, "User retrieved successfully.");
        }
    }
}
