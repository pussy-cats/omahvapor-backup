<?php

namespace App\Http\Controllers\Admin;

use App\Cart;
use App\Product;
use App\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
  public function addCart($id)
  {
    $data = [
      'scheduleData' => Schedule::with('user.profile')
                        ->find($id),
      'allProducts' => Product::paginate(5)
    ];
    return view('cart.add', $data);
  }

  public function createCart(Request $request, $id)
  {
    foreach($request->products as $product){
      $cart = new Cart;
      $cart->schedule_id = $id;
      $cart->product_id = $product;
      $cart->quantity = 1;
      $cart->is_paid = 0;
      $cart->save();
    }
    if($cart->save()){
      return redirect()->route('scheduleDetail', ['id' => $id])->with('flash', [
        'card' => 'success',
        'message' => 'Tambah Data Produk ke Jadwal ini berhasil'
      ]);
    }else{
      return redirect()->route('scheduleDetail', ['id' => $id])->with('flash', [
        'card' => 'failed',
        'message' => 'Tambah Data Produk ke Jadwal ini gagal'
      ]);
    }
  }

  public function deleteCart($id)
  {
    $cart = Cart::find($id);
    if($cart->delete()){
      return redirect()->back()->with('flash', [
        'card' => 'success',
        'message' => 'Hapus Data Produk untuk Jadwal ini berhasil'
      ]);
    }else{
      return redirect()->back()->with('flash', [
        'card' => 'failed',
        'message' => 'Hapus Data Produk untuk Jadwal ini gagal'
      ]);
    }
  }
}
