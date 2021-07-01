<?php

namespace App\Contracts\Services\User;
use Illuminate\Http\Request;
use App\Models\User;
interface UserServiceInterface
{
  public function getUserList();
  public function setUsersList(Request $request);
  public function updateUserProfile(Request $request, User $user);
  public function changePasswordUpdate(Request $request,User $user);
  public function deleteUserList(User $user);
}
