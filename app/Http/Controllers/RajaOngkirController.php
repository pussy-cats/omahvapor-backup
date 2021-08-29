<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class RajaOngkirController extends Controller
{
    public function getCity($id)
    {
        $cities = RajaOngkir::kota()->dariProvinsi($id)->get();
        return response()->json($cities);
    }

    public function getService($cityId, $courierId)
    {
        $cost = RajaOngkir::ongkosKirim([
            'origin' => 445,
            'destination' => $cityId,
            'weight' => 1000,
            'courier' => $courierId
        ])->get();
        return response()->json($cost);
    }
}
