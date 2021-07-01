<?php

namespace App\Http\Controllers;

use App\Contracts\Services\User\UserServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Input;
use App\Image;
use phpDocumentor\Reflection\Types\Null_;
use URL;
use Crypt;
use Hash;
use Session;

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
    // $this->middleware('visitors');
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
  public function logout()
  {
    Auth::logout();
    return redirect()->intended('/login');
    // return redirect()->route('user#login');
    // return view('user.login');
  }

  public function login()
  {

    return view('user.login');
  }

  /**
   * Show the form for creating a new User.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Request $request)
  {
    $name = Session::get('name');
    $email =  Session::get('email');
    $password = Session::get('password');
    $confirmpassword = Session::get('confirmpassword');
    $usertype =  Session::get('type');
    $phone = Session::get('phone');
    $date =  Session::get('date');
    $address =  Session::get('address');
    $path =  Session::get('path');
    return view('user.createuser', ['name' => $name, 'email' => $email, 'password' => $password, 'confirmpassword' => $confirmpassword, 'usertype' => $usertype, 'phone' => $phone, 'date' => $date, 'address' => $address, 'path' => $path]);
  }

  public function confirm(Request $request)
  {
    $request->validate([
      'name' => 'required',
      'email' => 'required|email',
      'password'         => 'required|min:10|regex:/[A-Z]/ |regex:/[0-9]/',
      'confirmpassword' => 'required|same:password'
    ]);
    $request->session()->put('name', $request->name);
    $request->session()->put('email', $request->email);
    $request->session()->put('password', $request->password);
    $request->session()->put('confirmpassword', $request->password);
    $request->session()->put('type', $request->usertype);
    $request->session()->put('phone', $request->phone);
    $request->session()->put('date', $request->date);
    $request->session()->put('address', $request->address);
    $request->usertype = '1' ? 'User' : 'Admin';
    $request->image->extension();
    $imageName = time() . '.' . $request->image->extension();
    $path = public_path('images');
    $urlpath = 'images/' . $imageName;
    $request->image->move($path, $imageName);
    $request['path'] = $imageName;
    $request->session()->put('path', $imageName);
    return view('user.confirmpost', ['confirusers' =>  $request]);
  }
  public function profileconfirm(Request $request)
  {
    $request->session()->put('name', $request->name);
    $request->session()->put('email', $request->email);
    $request->session()->put('type', $request->usertype);
    $request->session()->put('phone', $request->phone);
    $request->session()->put('date', $request->date);
    $request->session()->put('address', $request->address);
    $request->usertype = '1' ? 'User' : 'Admin';
    if ($request->hasFile('image')) {
      $request->image->extension();
      $imageName = time() . '.' . $request->image->extension();
      $path = public_path('images');
      $urlpath = 'images/' . $imageName;
      $request->image->move($path, $imageName);
      $request['path'] = URL::to('/images/' . $imageName);
      $request->session()->put('path', $imageName);
    }
    return view('user.confirmprofile', ['confirmuserprofile' =>  $request]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function confirmprofileupdate(Request $request, User $user)
  {
    $request->session()->forget('name');
    $request->session()->forget('email');
    $request->session()->forget('type');
    $request->session()->forget('phone');
    $request->session()->forget('date');
    $request->session()->forget('address');
    $request->session()->forget('path');
    $user = $this->userInterface->updateUserProfile($request, $user);
    return redirect()->route('user#index');
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
      return redirect()->intended('posts/index/');
    } else {
      $errors = [' password is incorrect'];
      return redirect()->back()->withErrors($errors);
    }
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $request->session()->forget('name');
    $request->session()->forget('email');
    $request->session()->forget('type');
    $request->session()->forget('phone');
    $request->session()->forget('date');
    $request->session()->forget('address');
    $request->session()->forget('path');
    $request->session()->forget('password');
    $request->session()->forget('confirmpassword');
    $posts = $this->userInterface->setUsersList($request);
    return redirect()->intended('users');
  }

  /**
   * Search
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function search(Request $request)
  {
    $searchname = $request->get('username');
    $searchmail = $request->get('email');
    $searchfrom = $request->get('create-from');
    $searchto = $request->get('create-to');
    if ($searchname != null || $searchmail != null || $searchfrom != null || $searchto != null) {
      $users = $this->userInterface->search($searchname, $searchmail, $searchfrom, $searchto);
      return view('user.index', ['users' =>   $users]);
    } else {
      $users = $this->userInterface->getUserList();
      return view('user.index', ['users' =>   $users]);
    }
  }

  public function showprofile()
  {
    $user = Auth::user();
    return view('user.showprofile', ['currentuser' => $user]);
  }

  public function edit(User $user)
  {
    return view('user.updateprofile', ['user' =>  $user]);
  }
  public function changepassword(User $user)
  {
    return view('user.changepassword', ['user' =>  $user]);
  }
  public function changepasswordupdate(Request $request, User $user)
  {
    $newvalue = Hash::make($request->newpassword);
    $request->validate([
      'password' => 'different:$newvalue',
      'newpassword'         => 'required|min:10|regex:/[A-Z]/ |regex:/[0-9]/',
      'confirmpassword' => 'required|same:newpassword'
    ]);
    $request->session()->put('password', $request->newpassword);
    $request->session()->put('confirmpassword', $request->newpassword);
    $user = $this->userInterface->changePasswordUpdate($request, $user);
    $users = $this->userInterface->getUserList();
    return view('user.index', ['users' => $users]);
  }

  public function delete(User $user)
  {
    $users = $this->userInterface->deleteUserList($user);
    $returnusers = $this->userInterface->getUserList();
    return view('user.index', ['users' =>  $returnusers]);
  }
}
