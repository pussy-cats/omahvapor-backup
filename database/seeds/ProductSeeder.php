<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      for($i = 1; $i <= 100; $i++){
        Product::create([
          'name' => 'Produk ' . $i,
          'price' => 100000,
          'stock' => 10,
          'description' => 'Deskripsi'
        ]);
      }
  }
}
