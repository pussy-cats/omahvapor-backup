<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function checkout()
    {
        return $this->belongsTo('App\Checkout');
    }
}
