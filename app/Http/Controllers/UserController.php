<?php

namespace App\Http\Controllers;

use App\Contracts\Services\User\UserServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
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
        return view('user.index',['users' => $users]);
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
        'email' => 'required',
        'password' => 'required',
    ]);
        Log::info('Welcome');
        Log::info($request);
        $credentials = $request->only('email', 'password');
        Log::info($credentials);
        if (Auth::attempt($credentials)) {
            Log::info('Showing the user profile for user2: ');

            $request->session()->regenerate();

            // return redirect()->intended('post');
            return redirect()->intended('posts/index');
            
        }else {
          $errors = ['Email or password is incorrect'];
          return redirect()->back()->withErrors($errors);
        }

        // return back()->withErrors([
        //     'email' => 'The provided credentials do not match our records.',
        // ]);
    }

}
