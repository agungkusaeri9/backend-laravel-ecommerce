<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class PasswordController extends Controller
{
    public function __invoke()
    {
        $validator = Validator::make(request()->all(),[
            'new_password' => ['required','required_with:new_password_confirmation','same:new_password_confirmation'],
            'new_password_confirmation' => ['required'],
            'old_password' => ['required','min:8']
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(),422);
        }

        $token = request()->header('Authorization');
        $user = JWTAuth::parseToken($token)->authenticate();

        // cek apakah password old sama
        if(Hash::check(request('old_password'),$user->password))
        {
            $user->update([
                'password' => bcrypt(request('new_password'))
            ]);

            return ResponseFormatter::success($user,'Password berhasil diupdate.');
        }else{
            return ResponseFormatter::error(NULL,'Password lama salah.');
        }
    }
}
