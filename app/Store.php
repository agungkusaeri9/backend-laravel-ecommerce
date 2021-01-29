<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $guarded = [];

    public function photo()
    {
        if($this->photo !== NULL){
            return asset('storage/' . $this->photo);
        }else{
            return asset('assets/img/toko.jpg');
        }
    }
}
