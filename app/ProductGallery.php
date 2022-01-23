<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{
    protected $table = 'product_galleries';
    protected $guarded = ['id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function photo()
    {
        if(substr($this->photo,0,4) == "http"){
            return $this->photo;
        }else{
            return asset('storage/' . $this->photo);
        }
    }

}
