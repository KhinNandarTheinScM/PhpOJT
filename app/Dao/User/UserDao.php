<?php

namespace App\Dao\User;

use DB;
use App\Contracts\Dao\User\UserDaoInterface;
use App\Models\User;
use Illuminate\Support\Facades\Log;

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
}
