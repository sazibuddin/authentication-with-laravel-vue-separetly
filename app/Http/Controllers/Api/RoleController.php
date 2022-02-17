<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::orderBy('id', 'desc')->get();
        if(count($roles) > 0) {
            return $this->sendResponse($roles, "Role retrivd successfully");
        } else {
            return $this->sendError('No role found', 404);
        }
    }
    public function create(Request $request)
    {
        // Validate request
        $data = $request->validate([
            'name' => 'required',
            'permissions' => 'required',
        ]);
        $data['permissions'] = json_encode($data['permissions']);
        // create role 
        $role = Role::Create($data);
        if($role) {
            // return success response 
            return $this->sendResponse($role, "Role create success");
        }else {
               // return faile response 
            return $this->sendError('Failed to create role', 400);
        }

    }

    public function update_role(Request $request)
    {
        // Validate request
        $data = $request->validate([
            'role_id' => 'required',
            'user_id' => 'required',
        ]);

        //find user
        $user = User::find($request->user_id);
        //find role with id
        $role = Role::find($request->role_id);

        //if role not found, return 404 with message
        if(!$role) {
            return $this->sendError('No role found', 404);
        }

        //assign new role to the user
        $user->role_id = $request->role_id;

        //save user
        if($user->save()) {
            // return success response 
            $user->token = null;
            $user = new UserResource($user);
            return $this->sendResponse($user, "Role assign to user successfull");
        }else {
            // return failed response 
            return $this->sendError('Failed assign role', 400);
        }
    }
    public function remove_role($user_id)
    {
        $user = User::find($user_id);
        if($user) {
            $user->role_id = null;

            if($user->save()) {
                $user->token = null;
                $user = new UserResource($user);
                return $this->sendResponse($user, "Register success");
            }else {
                return $this->sendError('Failed remove role', 400);
            }
        }else {
            return $this->sendError('No user found', 404);
        }
    }
}
