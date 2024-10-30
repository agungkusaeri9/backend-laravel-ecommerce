<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed']
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::validationError($validator->errors());
        }

        $user = User::create([
            'name' => request('name'),
            'username' => Str::lower(Str::snake(request('name'))) . rand(1, 1000),
            'email' => request('email'),
            'password' => bcrypt(request('password'))
        ]);

        if ($user) {
            return ResponseFormatter::success($user, 'Anda berhasil Mendaftar.', 201);
        }

        return ResponseFormatter::error(NULL, 'Anda gagal Mendaftar.');
    }
}
