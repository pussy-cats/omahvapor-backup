<?php

namespace App\Http\Controllers\Admin;

use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
 public function index()
 {
  $data = [
   'allAdmins' => User::role('admin')
                  ->paginate(5),
  ];
  return view('admin.index', $data);
 }

 public function addAdmin()
 {
  return view('admin.add');
 }

 public function createAdmin(Request $request)
 {
  $user = User::where('email', '=', $request->email)
          ->first();

  if ($user != null) {
   return redirect()->route('adminIndex')->with('flash', [
    'card' => 'warning',
    'message' => 'Data Email sudah terdaftar. Silahkan daftar dengan email lain',
   ]);
  }
  $user = new User;
  $user->name = $request->name;
  $user->email = $request->email;
  $user->password = Hash::make($request->password);
  $user->assignRole('admin');
  if ($user->save()) {
   $profile = new Profile;
   $profile->user_id = $user->id;
   $profile->phone_number = $request->phone_number;
   $profile->address = $request->address;
   if ($profile->save()) {
    return redirect()->route('adminIndex')->with('flash', [
     'card' => 'success',
     'message' => 'Data Admin berhasil disimpan',
    ]);
   } else {
    return redirect()->route('adminIndex')->with('flash', [
     'card' => 'failed',
     'message' => 'Data Admin gagal disimpan',
    ]);
   }
  }
 }

 public function editAdmin($id)
 {
  $data = [
   'adminData' => User::with('profile')
                  ->find($id),
  ];
  return view('admin.edit', $data);
 }

 public function updateAdmin(Request $request, $id)
 {
  $user = User::find($id);
  if ($user != null) {
   $user->name = $request->name;
   $user->profile->phone_number = $request->phone_number;
   $user->profile->address = $request->address;
   if ($user->save() && $user->profile->save()) {
    return redirect()->route('adminIndex')->with('flash', [
     'card' => 'success',
     'message' => 'Data Admin berhasil diedit',
    ]);
   } else {
    return redirect()->route('adminIndex')->with('flash', [
     'card' => 'failed',
     'message' => 'Data Admin gagal diedit',
    ]);
   }
  } else {
   return redirect()->route('adminIndex')->with('flash', [
    'card' => 'warning',
    'message' => 'Data Admin tidak ditemukan',
   ]);
  }
 }

 public function deleteAdmin($id)
 {
  $user = User::find($id);
  if ($user->profile->delete()) {
   if ($user->delete()) {
    return redirect()->route('adminIndex')->with('flash', [
     'card' => 'success',
     'message' => 'Hapus Data Admin berhasil',
    ]);
   } else {
    return redirect()->route('adminIndex')->with('flash', [
     'card' => 'failed',
     'message' => 'Hapus Data Admin gagal',
    ]);
   }
  } else {
   return redirect()->route('adminIndex')->with('flash', [
    'card' => 'failed',
    'message' => 'Hapus Data Admin gagal',
   ]);
  }
 }
}
