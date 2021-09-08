<?php

namespace App\Http\Controllers\User;

use App\Cart;
use App\Checkout;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class CheckoutController extends Controller
{
    public function addCheckout()
    {
        $allCarts = Cart::where('checkout_id', '=', NULL)->where('user_id', '=', Auth::user()->id)->where('is_paid', '=', 0)->get();
        if($allCarts->count() === 0){
            return redirect()->back()->with('flash', [
                'card' => 'warning',
                'message' => 'Keranjang anda kosong, silahkan tambahkan produk dahulu'
            ]);
        }else{
            $totalPrice = $allCarts->sum(function($item){
                return $item->product->price * $item->quantity;
            });
            $totalItem = $allCarts->sum(function($item){
                return $item->quantity;
            });
            $totalProductPrice = $allCarts->sum(function($item){
                return $item->product->price;
            });

            $data = [
                'provinceRajaOngkir' => RajaOngkir::provinsi()->all(),
                'totalPrice' => $totalPrice,
                'totalItem' => $totalItem,
                'totalProductPrice' => $totalProductPrice,
                'allCarts' => $allCarts
            ];
            return view('checkout.userIndex', $data);
        }
    }

    public function createCheckout(Request $request)
    {
        $allCarts = Cart::where('checkout_id', '=', NULL)->where('user_id', '=', Auth::user()->id)->where('is_paid', '=', '0')->get();
        $totalPrice = $allCarts->sum(function($item){
            return $item->product->price * $item->quantity;
        });

        $checkout = new Checkout;
        $checkout->total = $totalPrice;
        $checkout->courier = $request->courier;
        $checkout->deliveryfee = $request->deliveryfee;
        $checkout->address = $request->address;
        $checkout->user_id = Auth::user()->id;
        if($checkout->save()){
            foreach($allCarts as $cart){
                $cart->checkout_id = $checkout->id;
                $cart->is_paid = 1;
                $cart->save();
            }
            return redirect()->route('home')->with('flash', [
                'card' => 'success',
                'message' => 'Checkout berhasil'
            ]);
        }else{
            return redirect()->route('home')->with('flash', [
                'card' => 'failed',
                'message' => 'Checkout gagal'
            ]);
        }
    }
}
