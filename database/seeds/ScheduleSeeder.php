<?php

use App\Schedule;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Schedule::create([
        'start_time' => Carbon::create(2021, 6, 10, 0, 0, 0, "Asia/Jakarta"),
        'finish_time' => Carbon::create(2021, 6, 10, 0, 0, 0, "Asia/Jakarta"),
        'description' => 'Servis AC dan Jok Mobil',
        'user_id' => 2
      ]);
    }
}
