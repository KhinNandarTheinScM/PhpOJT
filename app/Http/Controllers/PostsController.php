<?php

namespace App\Http\Controllers;

use DB;
use Response;
// use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Facades\Excel;
// use Maatwebsite\Excel\Excel;
use App\Posts;
use Illuminate\Http\Request;
use App\Contracts\Services\Posts\PostsServiceInterface;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Session;

class PostsController extends Controller
{
    private $postsInterface;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PostsServiceInterface $postsInterface)
    {
        $this->postsInterface = $postsInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->postsInterface->getPostsList();
        return view('posts.index', ['posts' =>  $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $title = Session::get('title');
        $description =  Session::get('description');
        return view('posts.createpost', ['description' => $description, 'title' => $title]);
    }

    /**
     * Show the form for upload a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showupload(Request $request)
    {
        return view('posts.showupload');
    }

    // Upload CSV
    function csvToArray($filename = '', $delimiter = ',')
    {
        // if (!file_exists($filename) || !is_readable($filename))
        //     return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }
    public function postupload(Request $request)
    {
        $id = Auth::user()->id;
        $posts = $this->postsInterface->uploadData($request, $id);
    }



    /**
     * Show the form for confirm a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirm(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $request->session()->put('title', $request->title);
        $request->session()->put('description', $request->description);
        return view('posts.confirmpost', ['confirmposts' =>  $request]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $posts = $this->postsInterface->setPostsList($request);
        return redirect()->intended('posts/index');
    }

    /**
     * Search
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $search = $request->get('search');
        if ($search != '') {
            $posts = $this->postsInterface->search($search);
            return view('posts.index', ['posts' =>  $posts]);
        } else {
            $posts = $this->postsInterface->getPostsList();
            return view('posts.index', ['posts' =>  $posts]);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function show(Posts $posts)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.editpost', ['post' =>  $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        return view('posts.confirmupdatepost', ['posts' =>  $request]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function confirmupdate(Request $request, Post $posts)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $posts = $this->postsInterface->updatePostsList($request, $posts);
        return redirect()->route('posts#index');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
    }
    public function exportCsvView()
    {
        $posts = $this->postsInterface->getPostsList();
        return view('posts.index', ['posts' =>  $posts]);
        return view('exportExcel');
    }
    public function exportCsv(Request $request)
    {
        $fileName = 'tasks.csv';
        $tasks = Post::all();
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Title', 'Description');

        $callback = function () use ($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                $row['Title']  = $task->title;
                $row['Description']    = $task->description;
                $row['status']    = $task->status;
                fputcsv($file, array($row['Title'], $row['Description'], $row['status']));
            }

            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
        $posts = $this->postsInterface->getPostsList();
        return view('posts.index', ['posts' =>  $posts]);
    }
    public function delete(Post $post)
    {
        $posts = $this->postsInterface->deletePostsList($post);
        $returnposts = $this->postsInterface->getPostsList();
        return view('posts.index', ['posts' =>  $returnposts]);
    }
}
