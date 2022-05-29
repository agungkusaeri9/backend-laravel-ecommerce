<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProfileController extends Controller
{
    public function show()
    {
        $token = request()->header('Authorization');
        $user = JWTAuth::parseToken($token)->authenticate();

        if($user)
        {
            return ResponseFormatter::success($user,'Profile User.');
        }else{
            return ResponseFormatter::error(NULL,'Profile User Tidak Ada.',400);
        }
    }

    public function update()
    {

        $token = request()->header('Authorization');
        $user = JWTAuth::parseToken($token)->authenticate();
        $validator = Validator::make(request()->all(),[
            'name' => ['required'],
            'avatar' => ['image','mimes:jpg,jpeg,png'],
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(),422);
        }

        if(request()->hasFile('avatar')){
            if($user->avatar !== NULL){
                Storage::disk('public')->delete($user->avatar);
            }
            $avatar = request()->file('avatar')->store('user');
        }else{
            $avatar = $user->avatar;
        }
        $user->update([
            'name' => request('name'),
            'avatar' => $avatar
        ]);

        return ResponseFormatter::success($user,'Profile berhasil diupdate.');
    }
}
