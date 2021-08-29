<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
 public function product()
 {
  return $this->hasOne('App\Product', 'id', 'product_id');
 }

 public function schedule()
 {
   return $this->belongsTo('App\Schedule', 'schedule_id', 'id');
 }

 public function checkout()
 {
   return $this->belongsTo('App\Checkout', 'checkout_id', 'id');
 }
}
