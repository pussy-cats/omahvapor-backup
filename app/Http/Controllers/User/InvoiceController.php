<?php

namespace App\Http\Controllers\User;

use App\Checkout;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function index()
    {
        $data = [
            'allInvoices' => Checkout::with('carts')->withCount('carts')->where('user_id', '=', Auth::user()->id)->get()
        ];
        return view('invoice.userIndex', $data);
    }
}
