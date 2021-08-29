<?php

namespace App\Http\Controllers\User;

use App\Cart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $data = [
            'allCarts' => Cart::where('checkout_id', '=', NULL)->where('user_id', '=', Auth::user()->id)->get()
        ];
        return view('cart.index', $data);
    }

    public function createCart($id)
    {
        $cart = new Cart;
        $cart->product_id = $id;
        $cart->user_id = Auth::user()->id;
        $cart->quantity = 1;
        $cart->is_paid = 0;
        if($cart->save()){
            return redirect()->back()->with('flash', [
                'card' => 'success',
                'message' => 'Produk berhasil dimasukkan ke keranjang'
            ]);
        }
    }
}