<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    //
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index (){
      // dd(auth()->user());
      // dd(auth()->user()->tickets);
      $user_id = auth()->user()->id;
      $users = User::where('is_admin', '=', 0 )->get();
      $tickets = User::find($user_id)->tickets;

      return view('dashboard.dashboard')
                  ->with('tickets', $tickets)
                  ->with('users', $users);
    }

    public function showDashboadTicket($id){
      $tickets = User::find($id)->tickets;
      return view('dashboard.dashboard-ticket')
                ->with('tickets', $tickets);
    }

    public function closeTicket($id){
      $ticket =  Ticket::find($id);
      $ticket->is_closed = 1;
      $ticket->save();
      return back();
    }

}
