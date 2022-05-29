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
            return $this->icon;
        }else{
            return "https://picsum.photos/150";
        }
    }

    public function getIconAttribute($value)
    {
        return asset('storage/' . $value);
    }
}
