<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
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

    public function ratings()
    {
        return $this->hasMany(ProductRating::class);
    }


}
