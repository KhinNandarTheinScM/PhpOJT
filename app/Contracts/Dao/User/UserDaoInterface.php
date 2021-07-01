<?php

namespace App\Contracts\Dao\User;
use Illuminate\Http\Request;
use App\Models\User;
interface UserDaoInterface
{
  public function setUsersList(Request $request);
  public function updateUserProfile(Request $request, User $user);
  public function changePasswordUpdate(Request $request,User $user);
  public function deleteUserList(User $user);
  
}
