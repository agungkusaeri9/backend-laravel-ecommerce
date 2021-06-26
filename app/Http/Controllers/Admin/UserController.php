<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('name','asc')->get();
        return view('admin.pages.user.index',[
            'title' => 'Data User',
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.user.create',[
            'title' => 'Tambah User'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'username' => ['required','unique:users,username','alpha_num','alpha_dash'],
            'email' => ['required','email','unique:users,email'],
            'password' => ['required','min:5'],
            'phone_number' => ['required'],
            'role' => ['required','in:admin,user'],
            'avatar' => ['image','mimes:jpg,jpeg,png'],
        ]);
        $data = $request->all();
        if($request->hasFile('avatar')){
            $data['avatar'] = $request->file('avatar')->store('user');
        }else{
            $data['avatar'] = NULL;
        }
        $data['username'] = $request->username . rand(1,100);
        User::create($data);

        return redirect()->route('admin.users.index')->with('success','User berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.pages.user.edit',[
            'title' => 'Edit User ' . $user->name,
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required'],
            'username' => ['required',Rule::unique('users','username')->ignore($user->id),'alpha_num','alpha_dash'],
            'email' => ['required','email',Rule::unique('users','email')->ignore($user->id)],
            'phone_number' => ['required'],
            'role' => ['required','in:admin,user'],
            'avatar' => ['image','mimes:jpg,jpeg,png'],
        ]);
        $data = $request->all();
        if($request->hasFile('avatar')){
            if($user->avatar !== NULL){
                Storage::disk('public')->delete($user->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('user');
        }else{
            $data['avatar'] = $user->avatar;
        }
        if($request->has('password')){
            $data['password'] = bcrypt($request->password);
        }else{
            $data['password'] = $user->password;
        }
        if($request->username !== $user->username){
            $data['username'] = $request->username . rand(1,100);
        }else{
            $data['username'] = $user->username;
        }
        
        $user->update($data);

        return redirect()->route('admin.users.index')->with('success','User berhasil ditambahkan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user->avatar !== NULL){
            unlink('storage/' . $user->avatar);
        }
        $user->delete();
        return redirect()->route('admin.users.index')->with('success','User berhasil ditambahkan!');
    }
}
