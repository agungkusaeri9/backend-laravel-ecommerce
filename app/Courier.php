<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    protected $guarded = ['id'];

    public function status()
    {
        if($this->status)
        {
            return '<span class="badge badge-success">Aktif</span>';
        }else{
            return '<span class="badge badge-danger">Tidak Aktif</span>';
        }
    }

    public function scopeActive($q)
    {
        return $q->where('status',1);
    }
}
