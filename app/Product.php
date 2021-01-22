<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $guarded = ['id'];
    
    public function category()
    {
        return $this->belongsTo(ProductCategory::class,'product_category');
    }

    public function gallery()
    {
        return $this->hasMany(ProductGallery::class,'product_id');
    }

    public function details()
    {
        return $this->belongsTo(ProductDetail::class);
    }
}
