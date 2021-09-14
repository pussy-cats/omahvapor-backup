<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $data = [
            'allProducts' => Product::all()
        ];
        return view('product.guestIndex', $data);
    }

    public function detailProduct($id)
    {
        $data = [
            'productData' => Product::find($id)
        ];
        return view('product.guestDetail', $data);
    }
}
