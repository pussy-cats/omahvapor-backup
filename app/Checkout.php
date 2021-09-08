<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
 public function schedule()
 {
   return $this->belongsTo('App\Schedule', 'schedule_id', 'id');
 }

 public function carts()
 {
   return $this->hasMany('App\Cart', 'checkout_id', 'id');
 }

 public function user()
 {
   return $this->hasOne('App\User', 'id', 'user_id');
 }

 public function payment()
 {
   return $this->hasOne('App\Payment', 'checkout_id', 'id');
 }
}
