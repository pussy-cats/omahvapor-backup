<?php

namespace App\Http\Controllers\Admin;

use App\Schedule;
use App\User;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
 public function index()
 {
  $data = [
   'allSchedules' => Schedule::with('user')
                      ->paginate(5),
  ];
  return view('schedule.index', $data);
 }

 public function indexCalendar()
 {
  $getSchedules = Schedule::with('user')
                  ->get();
  $allSchedules = [];
  foreach ($getSchedules as $schedule) {
   $allSchedules[] = \Calendar::event(
    $schedule->user->name,
    true,
    $schedule->start_time,
    $schedule->finish_time
   );
  }
  $data = [
   'allSchedules' => \Calendar::addEvents($allSchedules),
  ];
  return view('schedule.calendar', $data);
 }

 public function addSchedule()
 {
  $data = [
   'allUsers' => User::role('user')
                  ->with('profile')
                  ->get(),
  ];
  return view('schedule.add', $data);
 }

 public function createSchedule(Request $request)
 {
  $validate = Schedule::where('start_time', 'LIKE', '%' . $request->date . '%')
              ->get();
  if ($validate->count() >= 1) {
   return redirect()->route('scheduleIndex')->with('flash', [
    'card' => 'warning',
    'message' => 'Kuota Jadwal pada hari tersebut sudah terpenuhi. Silahkan pilih lain hari',
   ]);
  } else {
   $schedule = new Schedule;
   $schedule->start_time = $request->date;
   $schedule->finish_time = $request->date;
   $schedule->description = $request->description;
   $schedule->user_id = $request->user_id;
   if ($schedule->save()) {
    return redirect()->route('scheduleIndex')->with('flash', [
     'card' => 'success',
     'message' => 'Data Jadwal berhasil dibuat',
    ]);
   } else {
    return redirect()->route('scheduleIndex')->with('flash', [
     'card' => 'failed',
     'message' => 'Data Jadwal gagal dibuat',
    ]);
   }
  }
 }

 public function editSchedule($id)
 {
  $data = [
   'scheduleData' => Schedule::with('user')
                  ->find($id),
  ];
  return view('schedule.edit', $data);
 }

 public function updateSchedule(Request $request, $id)
 {
  $schedule = Schedule::find($id);
  if ($schedule->count() == 1) {
   $schedule->start_time = $request->date;
   $schedule->finish_time = $request->date;
   $schedule->description = $request->description;
   if ($schedule->save()) {
    return redirect()->route('scheduleIndex')->with('flash', [
     'card' => 'success',
     'message' => 'Data Jadwal berhasil diedit',
    ]);
   } else {
    return redirect()->route('scheduleIndex')->with('flash', [
     'card' => 'failed',
     'message' => 'Data Jadwal gagal diedit',
    ]);
   }
  } else {
   return redirect()->route('scheduleIndex')->with('flash', [
    'card' => 'warning',
    'message' => 'Data Jadwal tidak ditemukan',
   ]);
  }
 }

 public function deleteSchedule($id)
 {
  $schedule = Schedule::find($id);
  if ($schedule->delete()) {
   return redirect()->route('scheduleIndex')->with('flash', [
    'card' => 'success',
    'message' => 'Data Jadwal berhasil dihapus',
   ]);
  } else {
   return redirect()->route('scheduleIndex')->with('flash', [
    'card' => 'failed',
    'message' => 'Data Jadwal gagal dihapus',
   ]);
  }
 }

 public function detailSchedule($id)
 {
   $data = [
     'scheduleData' => Schedule::with('user.profile', 'carts.product')
                    ->find($id),
     'scheduleCarts' => Schedule::with('carts.product')
                    ->find($id)
   ];
   return view('schedule.detail', $data);
 }

 public function statusSchedule($id)
 {
   $schedule = Schedule::find($id);
   $schedule->status = 1;
   if($schedule->save()){
     return redirect()->back()->with('flash', [
       'card' => 'success',
       'message' => 'Status Jadwal berhasil dirubah sebagai selesai'
     ]);
   }else{
     return redirect()->back()->with('flash', [
       'card' => 'failed',
       'message' => 'Status Jadwal gagal dirubah sebagai selesai'
     ]);
   }
 }
}
