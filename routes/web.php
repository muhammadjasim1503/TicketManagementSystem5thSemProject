<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Login routes
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

//Logout routes
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

//Register routes
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

//Ticket routes
Route::get('/ticket', [TicketController::class, 'index'])->name('ticket');
Route::get('/ticket-form', [TicketController::class, 'showForm'])->name('ticket-form');
Route::post('/ticket-form', [TicketController::class, 'store']);
Route::get('/ticket-reply/{id}', [TicketController::class, 'showReply'])->name('ticket-reply');
Route::post('/send-ticket-reply/{id}', [TicketController::class, 'sendReply'])->name('send-ticket-reply');

//Home routes
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard-ticket/{id}', [DashboardController::class, 'showDashboadTicket'])->name('dashboard-ticket');
Route::post('/close-ticket/{id}', [DashboardController::class, 'closeTicket'])->name('close-ticket');
