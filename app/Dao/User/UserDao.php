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
    // $users = User::all();
    $users = DB::table('users as user1')
      ->join('users AS user2', 'user1.create_user_id', '=', 'user2.id')
      ->join('users as user3', 'user1.updated_user_id', '=', 'user3.id')
      ->orWhereNull('user1.deleted_user_id')
      ->select('user1.*', 'user2.name as create_username', 'user3.name as updated_user')
      ->paginate(5);
    return $users;
  }
  public function search(string $inputtext1 = null, string $inputtext2 = null, string $inputtext3 = null, string $inputtext4 = null)
  {
    if ($inputtext1 !== null && $inputtext2 !== null && $inputtext3 !== null && $inputtext4 !== null) {
      $users = DB::table('users as user1')
        ->join('users AS user2', 'user1.create_user_id', '=', 'user2.id')
        ->join('users as user3', 'user1.updated_user_id', '=', 'user3.id')
        ->select('user1.*', 'user2.name as create_username', 'user3.name as updated_user')
        // ->orWhereNull('user1.deleted_user_id')
        ->where(function ($query) use ($inputtext1, $inputtext2, $inputtext3, $inputtext4) {
          $query->where('user1.name', 'LIKE', '%' . $inputtext1 . '%')
            ->orWhere('user1.email', 'LIKE', '%' . $inputtext2 . '%')
            ->orwhereBetween('user1.created_at', [date($inputtext3), date($inputtext4)]);
        })
        ->paginate(5);
      $users->appends(['search' => $inputtext1]);
      return $users;
    } elseif ($inputtext1 !== null && $inputtext2 === null && $inputtext3 === null && $inputtext4 === null) {
      $users = DB::table('users as user1')
        ->join('users AS user2', 'user1.create_user_id', '=', 'user2.id')
        ->join('users as user3', 'user1.updated_user_id', '=', 'user3.id')
        // ->orWhereNull('user1.deleted_user_id')
        ->where(function ($query) use ($inputtext1) {
          $query->where('user1.name', 'LIKE', '%' . $inputtext1 . '%');
        })
        ->select('user1.*', 'user2.name as create_username', 'user3.name as updated_user')
        ->paginate(5);
      $users->appends(['search' => $inputtext1]);
      return $users;
    } elseif ($inputtext1 === null && $inputtext2 !== null && $inputtext3 === null && $inputtext4 === null) {
      $users = DB::table('users as user1')
        ->join('users AS user2', 'user1.create_user_id', '=', 'user2.id')
        ->join('users as user3', 'user1.updated_user_id', '=', 'user3.id')
        ->select('user1.*', 'user2.name as create_username', 'user3.name as updated_user')
        // ->orWhereNull('user1.deleted_user_id')
        ->where(function ($query) use ($inputtext2) {
          $query->where('user1.email', 'LIKE', '%' . $inputtext2 . '%');
        })
        ->paginate(5);
      $users->appends(['search' => $inputtext2]);
      return $users;
    } elseif ($inputtext1 === null && $inputtext2 === null && $inputtext3 !== null && $inputtext4 !== null) {
      $users = DB::table('users as user1')
        ->join('users AS user2', 'user1.create_user_id', '=', 'user2.id')
        ->join('users as user3', 'user1.updated_user_id', '=', 'user3.id')
        ->select('user1.*', 'user2.name as create_username', 'user3.name as updated_user')
        // ->orWhereNull('user1.deleted_user_id')
        ->where(function ($query) use ($inputtext3, $inputtext4) {
          $query->whereBetween('user1.created_at', [date($inputtext3), date($inputtext4)]);
        })
        ->paginate(5);
      $users->appends(['search' => $inputtext3, $inputtext4]);
      return $users;
    } elseif ($inputtext1 !== null && $inputtext2 === null && $inputtext3 !== null && $inputtext4 !== null) {
      $users = DB::table('users as user1')
        ->join('users AS user2', 'user1.create_user_id', '=', 'user2.id')
        ->join('users as user3', 'user1.updated_user_id', '=', 'user3.id')
        ->select('user1.*', 'user2.name as create_username', 'user3.name as updated_user')
        // ->orWhereNull('user1.deleted_user_id')
        ->where(function ($query) use ($inputtext1, $inputtext3, $inputtext4) {
          $query->whereBetween('user1.created_at', [date($inputtext3), date($inputtext4)])
            ->orWhere('user1.name', 'LIKE', '%' . $inputtext1 . '%');
        })
        ->paginate(5);
      $users->appends(['search' => $inputtext3, $inputtext4]);
      return $users;
    } elseif ($inputtext1 === null && $inputtext2 !== null && $inputtext3 !== null && $inputtext4 !== null) {
      $users = DB::table('users as user1')
        ->join('users AS user2', 'user1.create_user_id', '=', 'user2.id')
        ->join('users as user3', 'user1.updated_user_id', '=', 'user3.id')
        ->select('user1.*', 'user2.name as create_username', 'user3.name as updated_user')
        // ->orWhereNull('user1.deleted_user_id')
        ->where(function ($query) use ($inputtext2, $inputtext3, $inputtext4) {
          $query->whereBetween('user1.created_at', [date($inputtext3), date($inputtext4)])
            ->orWhere('user1.email', 'LIKE', '%' . $inputtext2 . '%');
        })
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
      'dob' => $request->dob,
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
  public function changePasswordUpdate(Request $request, User $user)
  {
    $id = Auth::user()->id;
    $user = DB::table('users')
      ->where('users.id', '=', $request->id)
      ->update(['password' => Hash::make($request->newpassword), 'updated_user_id' => $id]);
  }
  public function  deleteUserList(User $user)
  {
    $id = Auth::user()->id;
    $user = DB::table('users')
      ->where('users.id', '=',  $user->id)
      ->update(['deleted_user_id' => '1']);
    return  $user;
  }
}
