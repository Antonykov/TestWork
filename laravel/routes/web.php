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
    return view('moodle');
});

Route::get('users', 'App\Http\Controllers\Moodle\MoodleController@showUsers');
Route::get('courses', 'App\Http\Controllers\Moodle\MoodleController@showCourses');
Route::get('enrolusers', 'App\Http\Controllers\Moodle\MoodleController@showEnrolusers');
