<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductCategory extends Model
{
    protected $table = 'product_categories';
    protected $guarded = ['id'];

    public function icon()
    {
        if($this->icon !== NULL){
            if($this->slug === Str::before($this->icon, '.png')){
                return  asset('assets/img/' . $this->icon);
            }
        }else{
            return "https://picsum.photos/150";
        }
    }
}
