<?php

namespace App\Http\Controllers;

use App\Contracts\Services\User\UserServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Input;
class UserController extends Controller
{
  private $userInterface;
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(UserServiceInterface $userInterface)
  {
    $this->userInterface = $userInterface;
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $users = $this->userInterface->getUserList();
    return view('user.index', ['users' => $users]);
  }

  /**
   * Show the form for creating a new User.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Request $request)
  {
    return view('user.createuser');
  }
  public function confirm(Request $request)
  {
     return view('user.confirmpost');
  
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function checkuser(Request $request)
  {
    $request->validate([
      'email' => 'required|email',
      'password' => 'required',
    ]);
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();
      return redirect()->intended('posts/index');
    } else {
      $errors = ['Email or password is incorrect'];
      return redirect()->back()->withErrors($errors);
    }
  }

  /**
     * Search
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
      $searchname=$request->get('username');
      $searchmail=$request->get('email');
      $searchfrom=$request->get('create-from');
      $searchto=$request->get('create-to');
      if($searchname!=null|| $searchmail!=null|| $searchfrom!=null||$searchto!=null){
           $users = $this->userInterface->search($searchname,$searchmail, $searchfrom, $searchto);
            return view('user.index', ['users' =>   $users]);
      }else {
           $users = $this->userInterface->getUserList();
            return view('user.index', ['users' =>   $users]);
      }
    }


}
