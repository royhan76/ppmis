<?php

namespace App\Http\Controllers\API;

use JWTAuth;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ApiController extends Controller
{
    public function register(Request $request)
    {
        //Validate data
        $data = $request->only('name', 'email', 'password', 'phone', 'username', 'repassword', 'image');
        $validator = Validator::make($data, [
            'name' => 'required|min:6|max:50',
            'username' => 'required|unique:App\Models\User,username|alpha_dash|min:6|max:50',
            'email' => 'required|unique:App\Models\User,email',
            'phone' => 'required',
            'password' => 'required|min:6',
            'repassword' => 'required|same:password',
            'image' => 'required|image|max:1024'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }
        $filename = '';
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $filename = random_int(1000, 9999) . '-' . time() . '.' . $file->getClientOriginalExtension();

            Storage::disk('s3')->put('ppmis/images/user/' . $filename, file_get_contents($file));
        }

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'USER',
            'email' => $request->email,
            'image' => $filename,
            'phone' => $request->phone
        ]);

        //User created, return success response
        return response()->json([
            'success' => true,
            'message' => 'User register successfully',
            'data' => $user
        ], Response::HTTP_OK);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('username', 'password');

        //valid credential
        $validator = Validator::make($credentials, [
            'username' => 'required',
            'password' => 'required|string|min:6|max:50'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 401);
        }

        //Request is validated
        //Crean token
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Login credentials are invalid.',
                ], 400);
            }
        } catch (JWTException $e) {
            return $credentials;
            return response()->json([
                'success' => false,
                'message' => 'Could not create token.',
            ], 500);
        }
        $user = User::where('username', $request->username)->first();
        $user->students = $user->students;
        //Token created, return with success response and jwt token
        return response()->json([
            'success' => true,
            'token' => $token,
            'data' => $user
        ]);
    }

    public function logout(Request $request)
    {
        //valid credential
        $validator = Validator::make($request->only('token'), [
            'token' => 'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        //Request is validated, do logout
        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                'success' => true,
                'message' => 'User has been logged out'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user cannot be logged out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function get_user(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user = JWTAuth::authenticate($request->token);

        return response()->json(['user' => $user]);
    }
}
