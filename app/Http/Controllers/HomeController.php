<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function __construct()
    {
      $this->middleware('guest');
    }

    public function index (){
      // dd(auth()->user());
      // dd(auth()->user()->tickets);
      return view('home');
    }
}
