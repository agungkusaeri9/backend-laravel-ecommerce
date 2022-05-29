<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::find(auth()->id());

        return view('admin.pages.profile.index',[
            'title' => 'My Profil',
            'user' => $user
        ]);
    }

    public function edit()
    {
        $user = User::find(auth()->id());

        return view('admin.pages.profile.edit',[
            'title' => 'Edit Profil',
            'user' => $user
        ]);
    }

    public function update(Request $request)
    {
        $user = User::find(auth()->id());
        $request->validate([
            'name' => ['required'],
            'username' => ['required',Rule::unique('users','username')->ignore($user->id),'alpha_num','alpha_dash'],
            'email' => ['required','email',Rule::unique('users','email')->ignore($user->id)],
            'avatar' => ['image','mimes:jpg,jpeg,png'],
        ]);
        $data = $request->except('role');
        if($request->hasFile('avatar')){
            if($user->avatar !== NULL){
                Storage::disk('public')->delete($user->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('user');
        }else{
            $data['avatar'] = $user->avatar;
        }
        if(request('password')){
            $data['password'] = bcrypt($request->password);
        }else{
            $data['password'] = $user->password;
        }
        $user->update($data);

        return redirect()->route('admin.profile')->with('success','Profile berhasil iupdate!');
    }
}
