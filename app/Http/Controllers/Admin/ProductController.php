<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
 public function index()
 {
  $data = [
   'allProducts' => Product::paginate(5),
  ];
  return view('product.index', $data);
 }

 public function addProduct()
 {
  return view('product.add');
 }

 public function storeProduct(Request $request)
 {
     $file = $request->file;
     $fileName = $file->getClientOriginalName();
     $uploadDestination = 'images/product';
     if($file->move($uploadDestination, $fileName)){
        $product = new Product;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->description = $request->description;
        $product->file = $fileName;
        if ($product->save()) {
         return redirect()->route('productIndex')->with('flash', [
          'card' => 'success',
          'message' => 'Tambah Data Produk Berhasil',
         ]);
        } else {
         return redirect()->route('productIndex')->with('flash', [
          'card' => 'failed',
          'message' => 'Tambah Data Produk Gagal',
         ]);
        }
     }
 }

 public function editProduct($id)
 {
  $data = [
   'product' => Product::find($id),
  ];
  return view('product.edit', $data);
 }

 public function updateProduct(Request $request, $id)
 {
  $product = Product::find($id);
  $product->name = $request->name;
  $product->price = $request->price;
  $product->stock = $request->stock;
  $product->description = $request->description;
  if ($product->save()) {
   return redirect()->route('productIndex')->with('flash', [
    'card' => 'success',
    'message' => 'Data Produk Berhasil Diedit',
   ]);
  } else {
   return redirect()->route('productIndex')->with('flash', [
    'card' => 'failed',
    'message' => 'Data Produk Gagal Diedit',
   ]);
  }
 }

 public function deleteProduct($id)
 {
  $product = Product::find($id);
  if ($product->delete()) {
   return redirect()->route('productIndex')->with('flash', [
    'card' => 'success',
    'message' => 'Data Produk Berhasil Dihapus',
   ]);
  } else {
   return redirect()->route('productIndex')->with('flash', [
    'card' => 'failed',
    'message' => 'Data Produk Gagal Dihapus',
   ]);
  }
 }
}
