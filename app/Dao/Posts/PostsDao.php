<?php

namespace App\Dao\Posts;

use App\Contracts\Dao\Posts\PostsDaoInterface;
use App\Models\Post;

class PostsDao implements PostsDaoInterface
{ 

  //user list action
  public function getPostsList()
  {
    $posts = Post::all();
    return $posts;
  }

}
