<?php

namespace App\Http\Controllers\Admin;

use App\Checkout;
use Illuminate\Http\Request;
use PDF;

class InvoiceController extends Controller
{
  public function index($id)
  {
    $data = [
      'checkoutData' => Checkout::with(['carts' => function($q){
        return $q->where('is_paid', '=', '1');
      }, 'user.profile'])
        ->find($id)
    ];

    // return view('invoice.pdf', $data);
    $pdf = PDF::loadView('invoice.pdf', $data);
    return $pdf->stream();
  }
}
