<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $guarded = ['id'];

    public function logo()
    {
        if($this->logo !== NULL){
            return asset('storage/' . $this->logo);
        }else{
            return asset('assets/img/toko.jpg');
        }
    }

    public function city(){
        return $this->belongsTo(City::class);
    }
}
