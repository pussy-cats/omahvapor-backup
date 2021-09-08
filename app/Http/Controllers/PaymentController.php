<?php

namespace App\Http\Controllers;

use App\Checkout;
use App\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function addPayment($id)
    {
        $data = [
            'checkoutData' => Checkout::find($id)
        ];
        return view('payment.add', $data);
    }

    public function createPayment($id, Request $request)
    {
        $file = $request->file;
        $fileName = $file->getClientOriginalName();
        $uploadDestination = 'images/payments';
        if($file->move($uploadDestination, $fileName)){
            $payment = new Payment;
            $payment->checkout_id = $id;
            $payment->bank = $request->bank;
            $payment->file = $fileName;
            if($payment->save()){
                return redirect()->route('invoiceUserIndex')->with('flash', [
                    'card' => 'success',
                    'message' => 'Pembayaran berhasil'
                ]);
            }else{
                return redirect()->route('invoiceUserIndex')->with('flash', [
                    'card' => 'failed',
                    'message' => 'Pembayaran gagal'
                ]);
            }
        }
    }
}
