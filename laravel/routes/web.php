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
//Route::get('/welcome', function () {
//    return view('welcome');
//});

//Route::get('/',function () {
//    $greeting = 'Hello';
////    return view('welcome')->with('greeting',$greeting);
////    return view('welcome')->with([
////        'greeting'=>'Hello',
////        'name'=>'khs']);
//    $greeting = 'Hello';
//    $name = 'khs';
//    $items = ['Apple','Banana'];
//    return view('welcome',compact('greeting','name','items'));
//});
//
//Route::get('/',function () {
//    return view('error.503');    //디렉토리 속은 .으로 표기
//});

Route::get('/','App\Http\Controllers\IndexController@index');
//Route::resource('/','App\Http\Controllers\PostController');
//Route::resource('/posts','App\Http\Controllers\PostController');
Route::resource('posts','App\Http\Controllers\PostController');

Route::get('/foo', function () {
    return 'Hello World';
});