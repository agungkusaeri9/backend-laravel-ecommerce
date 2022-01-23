<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $guarded = ['id'];

    public function icon()
    {
        if($this->icon){
            return asset('storage/' . $this->icon);
        }else{
            return "https://picsum.photos/150";
        }
    }
}
