<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function auth(Request $request){
        try{
            $validate = $request->validate(
                [
                    "username" => "required|string|exists:users,username",
                    "password" => "required|string"
                ]
                );
            $username = $validate['username'];
            $password = $validate['password'];

            $user = User::firstWhere('username',$username);

            if(!Hash::check($password,$user->password)){
                return response([
                    "msg" => "The email or password entered is incorrect."
                ],Response::HTTP_NOT_FOUND);
            }

            $token = $user->createToken("auth")->plainTextToken;
            $data = [
                "user" => $user,
                "token" => $token
            ];
            return response()->json([
                "message" => "Success",
                "data" => $data
            ],Response::HTTP_OK);
            
        }catch(\Exception $e){
            if ($e instanceof ValidationException) {
                return response()->json(["message" => "Failed", "error" => $e->errors()], Response::HTTP_BAD_REQUEST);
            }
            return response()->json(["message" => "Failed", "error" => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully.']);
    }

    public function store(Request $request){
        try {
            $validate = $request->validate([
                "fullname"=>"required|string",
                "username"=>"required|string|unique:users,username",
                "password"=>"required|string",
                "email"=>"required|email",
                "role"=>"required|string|in:'SuperAdmin','Admin','User','Guest'",
            ]);
            $data = User::query()->create($validate);

            return response()->json(["message" => "Success", "data" => $data]);
        } catch (\Exception $ex) {
            if ($ex instanceof ValidationException) {
                return response()->json(["message" => "Failed", "error" => $ex->errors()], Response::HTTP_BAD_REQUEST);
            }
            return response()->json(["message" => "Failed", "error" => $ex->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function update(Request $request, User $user)
    {
        try {
            $validated = $request->validate([
                'fullname' => ['string'],
                'username' => ['string', Rule::unique('users', 'username')->ignore($user->id)],
                'email'    => ['email', Rule::unique('users', 'email')->ignore($user->id)],
                'password' => ['string'],
                'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            ]);
    
            // Enkripsi password jika diisi
            if (isset($validated['password'])) {
                $validated['password'] = bcrypt($validated['password']);
            }

            if ($request->hasFile('photo')) {
                $image = base64_encode(file_get_contents($request->file('photo')->getRealPath()));
                $validated['photo'] = $image;
            }
    
            $user->update($validated);

            return response()->json(["message" => "Success", "data" => $user]);
        } catch (ValidationException $ex) {
            return response()->json([
                "message" => "Validation Failed",
                "error" => $ex->errors()
            ], Response::HTTP_BAD_REQUEST);
        } catch (\Exception $ex) {
            return response()->json([
                "message" => "Failed",
                "error" => $ex->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getById(User $user){
       if(!$user){
        return response()->json([
            "message" => "failed",
            "error"=>"user tidak ada"
        ],Response::HTTP_NOT_FOUND);
       }
        return response()->json([
            "message" => "success",
            "data"=>$user
        ],Response::HTTP_OK);
    }
}
