<?php

namespace App\Http\Controllers\Admin;

use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
 public function index()
 {
  $data = [
   'allUsers' => User::role('user')
                ->with('profile')
                ->paginate(5),
  ];
  return view('user.index', $data);
 }

 public function addUser()
 {
  return view('user.add');
 }

 public function createUser(Request $request)
 {
  $validate = User::where('email', '=', $request->email)
              ->get();
  if ($validate->count() != null) {
   return redirect()->route('userIndex')->with('flash', [
    'card' => 'warning',
    'message' => 'Data Email sudah ada',
   ]);
  } else {
   $user = new User;
   $user->name = $request->name;
   $user->email = $request->email;
   $user->password = Hash::make($request->password);
   $user->assignRole('user');
   if ($user->save()) {
    $profile = new Profile;
    $profile->user_id = $user->id;
    $profile->phone_number = $request->phone_number;
    $profile->address = $request->address;
    if ($profile->save()) {
     return redirect()->route('userIndex')->with('flash', [
      'card' => 'success',
      'message' => 'Tambah Data Pengguna berhasil',
     ]);
    } else {
     return redirect()->route('userIndex')->with('flash', [
      'card' => 'failed',
      'message' => 'Tambah Data Pengguna gagal',
     ]);
    }
   }
  }
 }

 public function editUser($id)
 {
     $data = [
         'userData' => User::find($id)
     ];
     return view('user.edit', $data);
 }

 public function updateUser(Request $request, $id)
 {
     $user = User::find($id);
     $user->name = $request->name;
     $user->email = $request->email;
     $user->password = Hash::make($request->password);
     if($user->save()){
        $profile = Profile::where('user_id', '=', $id)->first();
        $profile->phone_number = $request->phone_number;
        $profile->address = $request->address;
        if($profile->save()){
            return redirect()->route('userIndex')->with('flash', [
                'card' => 'success',
                'message' => 'Edit Data Pengguna berhasil'
            ]);
        }
     }else{
         return redirect()->route('userIndex')->with('flash', [
             'card' => 'failed',
             'message' => 'Edit Data Pengguna gagal'
         ]);
     }
 }

 public function deleteUser($id)
 {
  $user = User::find($id);
  if ($user->delete()) {
   return redirect()->route('userIndex')->with('flash', [
    'card' => 'success',
    'message' => 'Hapus Data User berhasil',
   ]);
  } else {
   return redirect()->route('userIndex')->with('flash', [
    'card' => 'failed',
    'message' => 'Hapus Data User gagal',
   ]);
  }
 }
}
