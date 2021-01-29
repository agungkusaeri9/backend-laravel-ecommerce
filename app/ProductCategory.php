<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'product_categories';
    protected $guarded = ['id'];

    public function icon()
    {
        if($this->icon !== NULL){
            return  asset('storage/' . $this->icon);
        }else{
            return "https://picsum.photos/150";
        }
    }
}
