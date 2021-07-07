<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AccountController extends Controller
{
    public function show()
    {
        return view('user.pages.account.show',[
            'title' => auth()->user()->name,
            'store' => Store::first(),
            'cart_count' => Cart::where('user_id', auth()->id())->count()
        ]);
    }

    public function update()
    {
        request()->validate([
            'name' => ['required'],
            'email' => ['required'],
            'username' => ['required'],
            'gender' => ['in:laki-laki,perempuan'],
            'avatar' => ['image','mimes:jpg,jpeg,png','max:2048']
        ]);
        $avatar = request()->file('avatar');
        if(request('avatar'))
        {
            Storage::disk('public')->delete(auth()->user()->avatar);
            $nameOrigin = Str::snake(auth()->user()->username) . '.' . $avatar->getClientOriginalExtension();
            $avatar->storeAs('user',$nameOrigin);
            $name = 'user/' . $nameOrigin;
        }else{
            $name = auth()->user()->avatar;
        }

        auth()->user()->update([
            'name' => request('name'),
            'phone_number' => request('phone_number'),
            'gender' => request('gender'),
            'address' => request('address'),
            'avatar' => $name
        ]);

        return redirect()->back()->with('success', 'Profile has been updated');
    }
}
