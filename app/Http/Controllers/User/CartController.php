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
            'allCarts' => Cart::where('checkout_id', '=', NULL)->where('user_id', '=', Auth::user()->id)->where('is_paid', '=', 0)->get()
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

    public function deleteCart($id)
    {
        $cart = Cart::find($id);
        if($cart->delete()){
            return redirect()->route('cartUserIndex')->with('flash', [
                'card' => 'success',
                'message' => 'Data Keranjang berhasil dihapus'
            ]);
        }else{
            return redirect()->route('cartUserIndex')->with('flash', [
                'card' => 'failed',
                'message' => 'Data Keranjang gagal dihapus'
            ]);
        }
    }

    public function addQuantity($id)
    {
        $cart = Cart::find($id);
        $cart->quantity = $cart->quantity + 1;
        if($cart->save()){
            return redirect()->route('cartUserIndex')->with('flash', [
                'card' => 'success',
                'message' => 'Keranjang berhasil ditambah'
            ]);
        }else{
            return redirect()->route('cartUserIndex')->with('flash', [
                'card' => 'failed',
                'message' => 'Keranjang gagal ditambah'
            ]);
        }
    }

    public function minusQuantity($id)
    {
        $cart = Cart::find($id);
        $cart->quantity = $cart->quantity - 1;
        if($cart->save()){
            return redirect()->route('cartUserIndex')->with('flash', [
                'card' => 'success',
                'message' => 'Keranjang berhasil dikurangi'
            ]);
        }else{
            return redirect()->route('cartUserIndex')->with('flash', [
                'card' => 'failed',
                'message' => 'Keranjang gagal dikurangi'
            ]);
        }
    }
}
