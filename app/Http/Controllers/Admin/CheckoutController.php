<?php

namespace App\Http\Controllers\Admin;

use App\Cart;
use App\Checkout;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
  public function index()
  {
    $data = [
      'allCheckouts' => Checkout::with('carts', 'user.profile')->paginate(5)
    ];
    return view('checkout.index', $data);
  }
  
  public function cartCheckout($id)
  {
    $data = [
      'scheduleData' => Schedule::with(["carts" => function($q){
                          return $q->where('is_paid', '=', '0');
                        }], 'user')
                        ->find($id),
      'sumOfTotal' => Cart::with('product')
                      ->where('schedule_id', '=', $id)
                      ->where('is_paid', '=', '0')
                      ->get()
                      ->sum(function($cart){
                        return $cart->product->price * $cart->quantity;
                      }),
    ];
    if($data['scheduleData']->carts->count() == 0){
      return redirect()->route('scheduleDetail', ['id' => $id])->with('flash', [
        'card' => 'warning',
        'message' => 'Data Keranjang yang bisa di checkout kosong. Silahkan cek kembali'
      ]);
    }else{
      return view('checkout.cart', $data);
    }
  }

  public function createCheckout(Request $request, $id)
  {
    $checkout = new Checkout;
    $checkout->total = $request->total;
    $checkout->pay = $request->pay;
    $checkout->change = $request->change;
    $checkout->schedule_id = $id;
    if($checkout->save()){
      $schedule = Schedule::find($id);
      foreach($schedule->carts as $cart){
        $cart->is_paid = 1;
        $cart->checkout_id = $checkout->id;
        $cart->save();
      }
      return redirect()->route('scheduleDetail', ['id' => $id])->with('flash', [
        'card' => 'success',
        'message' => 'Checkout Jadwal berhasil'
      ]);
    }else{
      return redirect()->route('scheduleDetail', ['id' => $id])->with('flash', [
        'card' => 'failed',
        'message' => 'Checkout Jadwal gagal'
      ]);
    }
  }

  public function detailCheckout($id)
  {
    $data = [
      'checkoutData' => Checkout::find($id)
    ];
    return view('checkout.detail', $data);
  }

  public function confirmationCheckout($id)
  {
    $checkout = Checkout::find($id);
    $greetingText = "Halo, " . $checkout->user->name . "%0a";
    $detailText = "Pembelian anda pada " . Carbon::parse($checkout->created_at)->isoFormat("D MMMM YYYY") . " telah masuk dalam sistem kami." . "%0a";
    $detailCheckoutText = "Rincian Pembelian anda :" . "%0a" . "Total Belanja : Rp." . number_format($checkout->total) . "%0a" . "Jumlah Produk : " . $checkout->carts->count();
    if($checkout->payment){
      $status = "Status : Sudah Dibayar";
    }else{
      $status = "Status : Belum Dibayar";
    }
    return redirect("https://api.whatsapp.com/send/?phone=" . $checkout->phone_number . "&text=" . $greetingText . "%0a" . $detailText . "%0a" . $detailCheckoutText . "%0a" . $status ."&app_absent=0");
  }
}
