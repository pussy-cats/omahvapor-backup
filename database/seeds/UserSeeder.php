<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      User::create([
        'name' => 'Naufal Azri',
        'email' => 'naufalazri1996@gmail.com',
        'password' => Hash::make('naufalazri'),
      ])->assignRole('admin');
      User::create([
        'name' => 'Wildan Ramadhan',
        'email' => 'wildanramadhan@gmail.com',
        'password' => Hash::make('wildanramadhan'),
      ])->assignRole('user');
    }
}
