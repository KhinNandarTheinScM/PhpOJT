<?php

namespace App\Models;

// use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Model
{
  use Notifiable;
  protected $table = 'users';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name', 'email', 'password','type','phone','dob','address','created_user_id', 
    'updated_user_id'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  // protected $hidden = [
  //   'password', 'remember_token',
  // ];
}
