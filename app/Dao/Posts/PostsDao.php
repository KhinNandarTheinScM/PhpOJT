<?php

namespace App\Dao\Posts;

use DB;
use App\Contracts\Dao\Posts\PostsDaoInterface;
use App\Models\Post;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsDao implements PostsDaoInterface
{

  //user list action
  public function getPostsList()
  {
    $posts = DB::table('posts')
      ->join('users', 'users.id', '=', 'posts.create_user_id')
      ->select('posts.*', 'users.name')
      ->where('posts.status', '=', '1')
      ->latest()
      ->paginate(5);
    return $posts;
  }

  public function uploadData(Request $request, int $userId)
  {
    $path = 'uploads/' . $userId . '/csv';
    //if ($request->file()) {
    // $userId
    $name = time() . '_' . $request->file->getClientOriginalName();
    $request->file('file')->storeAs($path, $name, 'public');
    $file = $request->file('file');
    $filePath = $file->getRealPath();
    $file = fopen($filePath, 'r');
    while (($line = fgetcsv($file)) !== FALSE) {
      $rowData = implode(" ", $line);
      $row = explode(";", $rowData);
      $status = (int)$row[2];
      $existing_title = DB::table('posts')->where('title', $row[0])->first();
      if (!$existing_title) {
        Post::create(['title' => $row[0], 'description' => $row[1], 'status' => $status, 'create_user_id' => $userId, 'updated_user_id' => $userId]);
      }
    }
    fclose($file);
  }

  public function search(string $inputtext)
  {
    $posts = DB::table('posts')
      ->join('users', 'users.id', '=', 'posts.create_user_id')
      ->orWhere('title', 'LIKE', '%' . $inputtext . '%')
      ->orWhere('description', 'LIKE', '%' . $inputtext . '%')
      ->paginate(5);
    $posts->appends(['search' => $inputtext]);
    // ->get();
    return $posts;
  }

  public function setPostsList(Request $request)
  {
    $id = Auth::user()->id;
    $posts = DB::table('posts')->insert([
      'title' => $request->title, 'description' => $request->description, 'status' => '1',
      'create_user_id' => $id,
      'updated_user_id' => $id
    ]);
    return $posts;
  }
  public function updatePostsList(Request $request, Post $posts)
  {
    $id = Auth::user()->id;
    $posts = DB::table('posts')
      ->where('posts.id', '=', $request->id)
      ->update(['title' => $request->title, 'description' => $request->description, 'status' => $request->status == 'on' ? '1' : '0', 'create_user_id' => $id, 'updated_user_id' => $id]);
  }
  public function deletePostsList(Post $posts)
  {
    $id = Auth::user()->id;
    $posts = DB::table('posts')
      ->where('posts.id', '=', $posts->id)
      ->update(['status' => '0', 'deleted_user_id' => $id]);
    return $posts;
    // ->where('id', $posts->id)
    // ->delete();
  }
}

// public function deletePostsList(Post $posts)
// {
//   $id = Auth::user()->id;
//   $posts = DB::table('posts')
//     ->where('id', $posts->id)
//     ->delete();
// }
// }