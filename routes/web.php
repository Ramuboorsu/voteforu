<?php

use Illuminate\Support\Facades\Route;

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

//1.voter Registration page
Route::any('/register', function () {
    return view('Voters.Register');
});

//2.sending otp to mobile number
Route::any('/regDetail', 'voteForUcontroller@vote');

//3.otp page 
Route::any('/otppage', function () {
    return view('Voters.otppage');
});

//3.otp verify 
Route::any('/otpsucces', 'voteForUcontroller@otpsucces');

//show voter home page
Route::any('/voteridpage', function () {
    return view('Voters.voterpage');
});

//voter login
Route::any('/loginvoter', function () {
    return view('Voters.loginvoter');
});

Route::any('/voteridsuccess', function () {
    return view('Voters.voterhome');
});

//3.aadhar upload 
Route::any('/aadhar', 'voteForUcontroller@aadhar');

//3.driving upload 
Route::any('/driving', 'voteForUcontroller@driving');

//volunteer home
Route::any('/volhome', function () {
    return view('Voters.volunterhome');
});