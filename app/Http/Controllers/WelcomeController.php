<?php

namespace App\Http\Controllers;

use App\Testimonial;
use App\Product;

class WelcomeController extends Controller
{
 public function index()
 {
  $data = [
   'recentProducts' => Product::all()->take(4)->sortByDesc('created_at'),
   'recentTestimonials' => Testimonial::all()->take(4)->sortByDesc('created_at')
  ];
  return view('welcome', $data);
 }
}
