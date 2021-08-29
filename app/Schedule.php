<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
 public function user()
 {
  return $this->hasOne('App\User', 'id', 'user_id');
 }

 public function carts()
 {
   return $this->hasMany('App\Cart', 'schedule_id', 'id');
 }

 public function checkouts()
 {
   return $this->hasMany('App\Checkout', 'schedule_id', 'id');
 }
}
