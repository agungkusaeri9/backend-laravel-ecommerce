<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Transaction extends Model
{
    use Notifiable,SoftDeletes;
    protected $table ='transactions';
    protected $guarded = ['id'];

    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
