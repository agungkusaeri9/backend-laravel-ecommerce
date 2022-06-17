<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $table = 'transaction_details';
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function isRating()
    {
        $rating = ProductRating::where('user_id',auth()->id())->where('product_id',$this->product_id)->count();
        if($rating)
        {
            $status = true;
        }else{
            $status = false;
        }

        return $status;
    }
}
