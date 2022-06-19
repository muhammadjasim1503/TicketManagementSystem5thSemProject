<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    //
    public function logout(Request $request){
      if (auth()->check()){
        auth()->logout();
      }
      return back();
    }
}
