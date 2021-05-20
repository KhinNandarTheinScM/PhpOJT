<?php

namespace App\Services\Posts;

use App\Contracts\Dao\Posts\PostsDaoInterface;
use App\Contracts\Services\Posts\PostsServiceInterface;
use Illuminate\Http\Request;
use App\Models\Post;
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

  public function search(string $inputtext)
  {
    return $this->postsDao->search($inputtext);
  }

  public function setPostsList(Request $request) {
     return $this->postsDao->setPostsList($request);
  }
  public function updatePostsList(Request $request, Post $posts){
    return $this->postsDao->updatePostsList($request,$posts);
  }
  public function deletePostsList(Post $posts) {
    return $this->postsDao->deletePostsList($posts);
  }
  public function uploadData(Request $request, int $userId){
    return $this->postsDao->uploadData($request,$userId);
  }
}
