<?php

namespace App\Dao\User;

use DB;
use App\Contracts\Dao\User\UserDaoInterface;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;

class UserDao implements UserDaoInterface
{

  //user list action
  public function getUserList()
  {
    $users = User::all();
    return $users;
  }
  public function search(string $inputtext1 = null, string $inputtext2 = null, string $inputtext3 = null, string $inputtext4 = null)
  {
    if ($inputtext1 !== null && $inputtext2 !== null && $inputtext3 !== null && $inputtext4 !== null) {
      $users = DB::table('users')
        ->orWhere('name', 'LIKE', '%' . $inputtext1 . '%')
        ->orWhere('email', 'LIKE', '%' . $inputtext2 . '%')
        ->orwhereBetween('created_at', [date($inputtext3), date($inputtext4)])
        ->paginate(5);
      $users->appends(['search' => $inputtext1]);
      return $users;
    } elseif ($inputtext1 !== null && $inputtext2 === null && $inputtext3 === null && $inputtext4 === null) {
      $users = DB::table('users')
        ->orWhere('name', 'LIKE', '%' . $inputtext1 . '%')
        ->paginate(5);
      $users->appends(['search' => $inputtext1]);
      return $users;
    } elseif ($inputtext1 === null && $inputtext2 !== null && $inputtext3 === null && $inputtext4 === null) {
      $users = DB::table('users')
        ->orWhere('email', 'LIKE', '%' . $inputtext2 . '%')
        ->paginate(5);
      $users->appends(['search' => $inputtext2]);
      return $users;
    } elseif ($inputtext1 === null && $inputtext2 === null && $inputtext3 !== null && $inputtext4 !== null) {
      $users = DB::table('users')
        ->orwhereBetween('created_at', [date($inputtext3), date($inputtext4)])
        ->paginate(5);
      $users->appends(['search' => $inputtext3, $inputtext4]);
      return $users;
    } elseif ($inputtext1 !== null && $inputtext2 === null && $inputtext3 !== null && $inputtext4 !== null) {
      $users = DB::table('users')
        ->orWhere('name', 'LIKE', '%' . $inputtext1 . '%')
        ->orwhereBetween('created_at', [date($inputtext3), date($inputtext4)])
        ->paginate(5);
      $users->appends(['search' => $inputtext3, $inputtext4]);
      return $users;
    } elseif ($inputtext1 === null && $inputtext2 !== null && $inputtext3 !== null && $inputtext4 !== null) {
      $users = DB::table('users')
        ->orWhere('email', 'LIKE', '%' . $inputtext2 . '%')
        ->orwhereBetween('created_at', [date($inputtext3), date($inputtext4)])
        ->paginate(5);
      $users->appends(['search' => $inputtext3, $inputtext4]);
      return $users;
    }
  }

  public function setUsersList(Request $request)
  {
    $id = Auth::user()->id;
    $users = DB::table('users')->insert([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
      'profile' => $request->image,
      'type' => $request->usertype = 'Admin' ? '0' : '1',
      'phone' => $request->phone,
      'address' => $request->description,
      'create_user_id' => $id,
      'updated_user_id' => $id,
    ]);
    // $users->save();
    return $users;
  }

  public function updateUserProfile(Request $request, User $user)
  {
    $id = Auth::user()->id;
    $user = DB::table('users')
      ->where('users.id', '=', $id)
      ->update(['name' => $request->name, 'email' => $request->email, 'profile' => $request->image, 'type' => $request->usertype == 'Admin' ? '0' : '1', 'phone' => $request->phone, 'dob' => $request->dob, 'address' => $request->description, 'create_user_id' => $id, 'updated_user_id' => $id]);
  }
  public function  deleteUserList(User $user)
  {
    $id = Auth::user()->id;
    $user = DB::table('users')
      ->where('users.id', '=',  $user->id)
      ->update(['status' => '0', 'deleted_user_id' => $id]);
    return  $user;
  }
}
