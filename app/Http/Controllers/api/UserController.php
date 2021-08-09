<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Validator;

class UserController extends Controller
{

    public function guard()
    {
        return Auth::guard();
    }

    public function userProfile()
    {
        return response()->json(auth()->user());
    }
    public function verifyEmail($email, $email_token)
    {
        if ($this->checkExistEmail($email) == 0 || $this->checkExistEmailToken($email_token) == 0) {
            return response()->json(['error' => 'this is a bad request']);
        }
        DB::table('users')
            ->where('email', $email)
            ->where('email_token', $email_token)
            ->update(["status_id" => 2, "updated_at" => now(), 'email_token' => null]);
        DB::table('notifications')->insert([
            'user_id' => 1,
            'content' => 'User "' . DB::table('users')
                ->select('full_name')
                ->where('email', $email)
                ->first()
                ->full_name . '" has been signed up to our system.',
            'type_id' => 8, // New user
            'status' => 0,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
        return response()->json(["message" => "Your account is ready to use now."]);
    }


    public function signOut(Request $request)
    {
        if (DB::table('users')->where('id', $request->user_id)->select("number_of_device")->first()->number_of_device > 0) {
            DB::table('users')->where('id', $request->user_id)->decrement('number_of_device', 1);
        }
        $this->guard()->logout();
        return response()->json(["message" => 'Signed out successfully']);
    }

    public function getUserById($id)
    {
        $user = DB::table('users')
            ->join('roles', 'roles.id', 'users.role_id')
            ->join('statuses', 'statuses.id', 'users.status_id')
            ->select('users.id', 'full_name', 'avatar', 'address', 'phone', 'email', 'number_of_device', 'status', 'roles.name as role')
            ->where('users.id', $id)
            ->first();
        return response()->json($user);
    }

    public function updateStatusUserById($id, Request $request)
    {
        $fieldsToUpdate = ['updated_at' => date("Y-m-d H:i:s")];
        if ($request->status != null) {
            $fieldsToUpdate["status_id"] = $request->status;
        }
        if ($request->role != null) {
            $fieldsToUpdate["role_id"] = $request->role;
        }
        DB::table('users')
            ->where('id', $id)
            ->update($fieldsToUpdate);
        return response()->json(["message" => "Updated the user's information"]);
    }

    public function updateUserProfile(Request $request)
    {
        if (auth()->user() == null) {
            return response()->json(["error" => "Your session has expired. Please sign in again."]);
        }
        $user_id = auth()->user()->id;
        $credentials = $request->only('email', 'password');
        if ($this->guard()->attempt($credentials)) {

            $fieldsToUpdate = ['updated_at' => date("Y-m-d H:i:s")];
            if ($request->full_name != null) {
                $fieldsToUpdate["full_name"] = $request->full_name;
            }
            if ($request->avatar != null) {
                $fieldsToUpdate["avatar"] = $request->avatar;
            }
            if ($request->gender != null) {
                $fieldsToUpdate["gender"] = $request->gender;
            }
            if ($request->address != null) {
                $fieldsToUpdate["address"] = $request->address;
            }
            if ($request->phone != null) {
                $fieldsToUpdate["phone"] = $request->phone;
            }
            if ($request->newPassword != null) {
                $fieldsToUpdate["password"] = Hash::make($request->newPassword);
            }
            DB::table('users')
                ->where('id', $user_id)
                ->update($fieldsToUpdate);
            return response()->json(["message" => "Updated your information"]);
        } else {
            return response()->json(["error" => "Wrong password"]);
        }
    }

    public function getUserProfile($id)
    {
        $user = DB::table('users')
            ->join('products', 'users.id', 'products.user_id')
            ->join('images', 'products.id', 'images.product_id')
            ->join('places', 'places.id', 'products.place_id')
            ->where('users.id', $id)
            ->select(
            'products.id',
            'users.id as user_id',
            'users.avatar as user_avatar',
            'users.full_name as full_name',
            'products.created_at',
            'places.name as place_name',
            'images.image as product_image',
            'products.product_desc as product_desc',
            'products.product_price as product_price',
            'products.product_title as product_title',)
            ->first();
        return response()->json($user);
    }

}
