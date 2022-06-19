<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;


class TicketController extends Controller
{
    //

    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index() {
      $user_id = auth()->user()->id;
      // dd($user_id);
      // $result = DB::select('select * from tickets where user_id = :id', ['id' => $user_id]);
      // $tickets = Ticket::all();
      // $tickets = Ticket::where('user_id', '=', $user_id);

      $tickets = User::find($user_id)->tickets;
      // dd($tickets);

      // $tickets = DB::table('tickets')
      //           ->where('user_id', '=', $user_id)
      //           ->get();
                // dd($tickets);
      // $tickets = json_decode($result, true);
      // $tickets = (array)$result;
      // dd($tickets);
      return View::make('ticket')->with('tickets', $tickets);
      // return view('ticket')->with('tickets', $tickets);
    }

    public function showForm(){
      return view('ticket-form');
    }

    public function showReply($id){
      // $reply = TicketReply::where('ticket_id', '=', $id);

      $replies = Ticket::find($id)->ticket_replies;
      // dd($replies);

      // $replies = DB::table('ticket_replies')
      //         ->where('ticket_id', '=', $id)
      //         ->get();
      // dd($replies);
      return view('ticket-reply')
                  ->with('replies', $replies)
                  ->with('ticket_id', $id);
    }

    public function store(Request $request){
      $this->validate($request, [
        'title' => 'required|max:255',
        'subject' => 'required|max:255',
        'priority' => 'required',
        'department' => 'required',
        'description' => 'required',
        'image' => 'nullable',
      ]);
      //image validation
      $file; // file will be stored in this
      $fileNameToStore = "";
      $toBeUploaded = false;
      if ($request->hasFile('image')){
        if ($request->file('image')->isValid()){
          //get file
          $file = $request->file('image');
          // get file name with extension
          $targetFile = $file->getClientOriginalName();
          $targetFile = strtolower($targetFile);
          //get directory to be uploaded to
          $targetDir = "uploads/";
          //get file name without extension
          $targetFileName = pathinfo($targetFile, PATHINFO_FILENAME);
          //get just extension
          $extension = $file->getClientOriginalExtension();
          //Filename to store
          $fileNameToStore = $targetFileName.'_'.time().'.'.$extension;
          $toBeUploaded = true;
        }
        else {
          return back()->with('statusDanger', "File is not valid");
        }
      } else {
        $toBeUploaded = false;
      }

      if ($toBeUploaded) {
        //check file size
        if ($file->getSize() > 2000000){
          return back()->with('statusDanger', "File size is too large");
        }

        // Allow certain file formats
        $imageFileType = $file->getClientOriginalExtension();
        if ($imageFileType != "png" && $imageFileType != "PNG"){
          return back()->with('statusDanger','Only png type is allowed');
        }
      }

      // posting data into database
      $add = auth()->user()->tickets()->create([
        'title' => $request->title,
        'subject' => $request->subject,
        'priority' => $request->priority,
        'department' => $request->department,
        'description' => $request->description,
        'image' => $fileNameToStore,
      ]);

      if($toBeUploaded){
        // storing the image in a storage
        $path = $request->file('image')->storeAs('public/uploads/', $fileNameToStore);
      }
      return redirect()->route('dashboard')->with('status','Ticket added successfully');
    }

    public function sendReply(Request $request, $id){
      // dd(auth()->user()->is_admin);
      $this->validate($request, [
        'msg' => 'required|max:255',
        'image' => 'nullable',
      ]);

      //image validation
      $file; // file will be stored in this
      $fileNameToStore = ""; //  this variable will be stored in the database
      $toBeUploaded = false;
      if ($request->hasFile('image')){
        if ($request->file('image')->isValid()){
          //get file
          $file = $request->file('image');
          // get file name with extension
          $targetFile = $file->getClientOriginalName();
          $targetFile = strtolower($targetFile);
          //get directory to be uploaded to
          $targetDir = "uploads/";
          //get file name without extension
          $targetFileName = pathinfo($targetFile, PATHINFO_FILENAME);
          //get just extension
          $extension = $file->getClientOriginalExtension();
          //Filename to store
          $fileNameToStore = $targetFileName.'_'.time().'.'.$extension;
          $toBeUploaded = true;
        }
        else {
          return back()->with('statusDanger', "File is not valid");
        }
      } else {
        $toBeUploaded = false;
      }

      if ($toBeUploaded) {
        //check file size
        if ($file->getSize() > 2000000){
          return back()->with('statusDanger', "File size is too large");
        }

        // Allow certain file formats
        $imageFileType = $file->getClientOriginalExtension();
        if ($imageFileType != "png" && $imageFileType != "PNG"){
          return back()->with('statusDanger','Only png type is allowed');
        }
      }

      $ticket = Ticket::find($id);
      // dd($ticket);
      $reply = $ticket->ticket_replies()->create([
        'description' => $request->msg,
        'image' => $fileNameToStore,
      ]);

      if ($toBeUploaded) {
        $path = $request->file('image')->storeAs('public/uploads/', $fileNameToStore);
      }
      return back()->with('status', 'Reply sent!');
    }
}
