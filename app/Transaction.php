<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table ='transactions';
    protected $guarded = ['id'];

    public function shipment()
    {
        return $this->belongsTo(Shipment::class);
    }
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
