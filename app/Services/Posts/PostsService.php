<?php

namespace App\Services\Posts;

use App\Contracts\Dao\Posts\PostsDaoInterface;
use App\Contracts\Services\Posts\PostsServiceInterface;

class PostsService implements PostsServiceInterface
{
  private $postsDao;

  /**
   * Class Constructor
   * @param OperatorUserDaoInterface
   * @return
   */
  public function __construct(PostsDaoInterface $postsDao)
  {
    $this->postsDao = $postsDao;
  }

  /**
   * Get User List
   * @param Object
   * @return $userList
   */

  public function getPostsList()
  {
    return $this->postsDao->getPostsList();
  }

}
