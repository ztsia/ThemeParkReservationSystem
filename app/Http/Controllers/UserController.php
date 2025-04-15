<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
  // get cart items for the specific user id
  public function getCartItems($userId)
  {
    return User::find($userId)->carts;
  }   
}
