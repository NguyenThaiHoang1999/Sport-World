<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function guard()
    {
        return Auth::guard();
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
        ]);
    }

    public function checkExistEmail($email) //kiểm tra email có tồn tại
    {
        return count(User::where('email', $email)->get());
    }

    public function checkExistEmailToken($emailToken) //kiểm tra email token có tồn tại
    {
        return count(User::where('email_token', $emailToken)->get());
    }

    public function checkExistPhone($phone) //kiểm tra sđt có tồn tại
    {
        return count(User::where('phone', $phone)->where('status_id', "<>", 1)->get());
    }

    public function signUp(Request $request)
    {
        $now = date("Y-m-d H:i:s");
        if ($this->checkExistEmail($request->email)) {
            return response()->json(['error' => 'exist email']);
        }

        if ($this->checkExistPhone($request->phone)) {
            return response()->json(['error' => 'exist phone']);
        } else {
            DB::table('users')
                ->where('phone', $request->phone)
                ->delete();
        }

        $email_token = str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789");

        $user = new User;
        $user->full_name = $request->fullName;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->avatar = "https://cdn.icon-icons.com/icons2/1378/PNG/512/avatardefault_92824.png";
        $user->email = $request->email;
        $user->email_token = $email_token;
        $user->password = Hash::make($request->password);
        $user->created_at = $now;
        $user->updated_at =  $now;
        $user->save();

        (new SendEmail())->sendEmail(
            $request->fullName,
            $request->email,
            array("name" => $request->fullName, "verifyEmailApi" => env('APP_URL') . "/api/verify-email/" . $request->email . "/" . $email_token),
            "Verify Email",
            "emails.verifyEmail"
        );

        return response()->json(["message" => 'Your account email is waited to verify. Please check your mail box!']);
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

    public function signIn(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if ($this->checkExistEmail($request->email)) {
            if (DB::table('users')->select("status_id")->where('email', $request->email)->first()->status_id == 2) {
                if ($token = $this->guard()->attempt($credentials)) {
                    DB::table('users')->where('email', $request->email)->increment('number_of_device', 1);
                    return response()->json(["token" => $this->respondWithToken($token)->original, "role_id" => auth()->user()->role_id, "id" => auth()->user()->id]);
                } else {
                    return response()->json(['error' => 'Wrong password']);
                }
            } else if (DB::table('users')->select("status_id")->where('email', $request->email)->first()->status_id == 1) {
                return response()->json(['error' => 'Your account is waiting to be verified.']);
            } else {
                return response()->json(['error' => 'Your account is banned.']);
            }
        } else {
            return response()->json(['error' => 'Your email does not exist in our system. Please sign up.']);
        }
    }

    public function signOut(Request $request)
    {
        if (DB::table('users')->where('id', $request->user_id)->select("number_of_device")->first()->number_of_device > 0) {
            DB::table('users')->where('id', $request->user_id)->decrement('number_of_device', 1);
        }
        $this->guard()->logout();
        return response()->json(["message" => 'Signed out successfully']);
    }

    public function userProfile()
    {
        return response()->json(auth()->user());
    }

    public function getUsers(Request $request)
    {
        $users = DB::table('users')
            ->join('roles', 'roles.id', 'users.role_id')
            ->join('statuses', 'statuses.id', 'users.status_id')
            ->select('users.id', 'full_name as name', 'users.created_at as registered', 'roles.name as role', 'statuses.status');

        if ($request->value != null) {
            $users = $users->where('full_name', 'like', "%{$request->value}%");
        }
        $users = $users->orderByDesc('users.id')->get();
        return response()->json("kkk");
    }

    public function numberOfUsers()
    {
        return response()->json(DB::table('users')
            ->select(DB::raw('count(id) as numberOfUsers'))
            ->first());
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

}
