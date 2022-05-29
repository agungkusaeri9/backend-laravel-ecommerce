<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\Http\Controllers\Controller;
use App\Province;
use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $store = Store::with('city')->first();
        $cities = City::all();
        return view('admin.pages.store.show',[
            'title' => 'Profile Toko',
            'store' => $store,
            'cities' => $cities
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
            'desc' => ['required'],
            'city' => ['required'],
            'address' => ['required'],
            'logo' => ['image','mimes:jpg,jpeg,png,svg'],
        ]);
        $store = Store::first();
        $data = $request->all();
        if($store){
            if(request()->file('logo')){
                $data['logo'] = request()->file('logo')->store('store','public');
                Storage::disk('public')->delete($store->logo);
            }else{
                $data['logo'] = $store->logo;
            }
            $store->update($data);
        }else{
            $data['logo'] = request()->file('logo')->store('store','public');
            Store::create($data);
        }

        return redirect()->route('admin.store.index')->with('success','Toko berhasil diupdate!');
    }
}
