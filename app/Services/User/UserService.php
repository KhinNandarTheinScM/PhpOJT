<?php

namespace App\Services\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\Contracts\Services\User\UserServiceInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\User;
class UserService implements UserServiceInterface
{
  private $userDao;

  /**
   * Class Constructor
   * @param OperatorUserDaoInterface
   * @return
   */
  public function __construct(UserDaoInterface $userDao)
  {
    $this->userDao = $userDao;
  }

  /**
   * Get User List
   * @param Object
   * @return $userList
   */

  public function getUserList()
  {
    return $this->userDao->getUserList();
  }
  // public function search(string $inputtext1,string $inputtext2,string $inputtext3,string $inputtext4)
  public function search(string $inputtext1 = null, string $inputtext2 = null, string $inputtext3 = null, string $inputtext4 = null)
  {
    return $this->userDao->search($inputtext1, $inputtext2, $inputtext3, $inputtext4);
  }
  public function setUsersList(Request $request) {
    return $this->userDao->setUsersList($request);
 }
 public function updateUserProfile(Request $request, User $user){
  return $this->userDao->updateUserProfile($request,$user);
}
public function deleteUserList(User $user) {
  return $this->userDao->deleteUserList($user);
}

}
