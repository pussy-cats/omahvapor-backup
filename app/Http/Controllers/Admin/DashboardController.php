<?php

namespace App\Http\Controllers\Admin;

use App\Schedule;
use App\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
 public function index()
 {
   $dateNow = Carbon::now();

  //  Generate Count Data
   $data = [
     'userToday' => User::where('created_at', 'LIKE', '%' . $dateNow->format('Y-m-d') . '%')
                    ->count(),
   ];

  //  Generate Charts Data
   $userPerWeek = User::whereBetween('created_at', [$dateNow->copy()->startOfWeek(), $dateNow->copy()->endOfWeek()])
                  ->get()
                  ->sortBy('created_at')
                  ->groupBy(function($date){
                    return Carbon::parse($date->created_at)->format('d');
                  });

   $userPerDay = [];
   foreach($userPerWeek as $user){
     $userPerDay[] = $user->count();
   }

   $userChart = app()->chartjs
   ->name('lineChartTest')
   ->type('bar')
   ->size(['width' => 400, 'height' => 300])
   ->labels(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'])
   ->datasets([
       [
           "label" => "Data",
           'backgroundColor' => "rgba(38, 185, 154, 0.31)",
           'borderColor' => "rgba(38, 185, 154, 0.7)",
           "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
           "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
           "pointHoverBackgroundColor" => "#fff",
           "pointHoverBorderColor" => "rgba(220,220,220,1)",
           'data' => [2.9,3, 2.8],
       ],
   ])
   ->options([]);

   $chartData = [
     'userChart' => $userChart
   ];
   return view('home', $data, $chartData);
 }
}
