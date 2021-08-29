<?php

use App\Profile;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Profile::create([
        'phone_number' => '1234567890',
        'address' => 'Boyolali',
        'user_id' => 1
      ]);
      Profile::create([
        'phone_number' => '1234567890',
        'address' => 'Boyolali',
        'user_id' => 2
      ]);
    }
}
