<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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

//Route::get('/','App\Http\Controllers\IndexController@index');
//Route::resource('/','App\Http\Controllers\PostController');
//Route::resource('/posts','App\Http\Controllers\PostController');
//Route::resource('posts','App\Http\Controllers\PostController');
//Route::resource('posts.comments','App\Http\Controllers\PostCommentController');

//Route::get('posts',[
//    'as' => 'posts.index',
//    'uses' => 'App\Http\Controllers\PostController@index'
//]);

Route::get('foo', function () {
    return 'Hello World';
});

Route::get('index',[
   'as' => 'LuigiIndex',
   'uses' => 'App\Http\Controllers\IndexController@show'
]);

//Route::get('posts',function (){
////    $posts = App\Models\Post::get();
//    $posts = App\Models\Post::with('user')->paginate(5);
////    $posts = App\Models\Post::get();
////    $posts->load('user');
//
//    return view('posts.index',compact('posts'));
//});

//Route::post('posts',function (Illuminate\Http\Request $request) {
//    $rule = [
//        'title'  => 'required',
//        'body'   => 'required|min:10'
//    ];
//
//    $validator = Validator::make($request->all(),$rule);
//
//    if ($validator->fails()) {
//        return redirect('posts/create')->withErrors($validator)->withInput();
//    }
//
//    return 'Valid & proceed to next job ~';
//});

//Route::get('posts/create',function () {
//    return view('posts.create');
//});

Route::resource('posts', 'App\Http\Controllers\PostController');

Route::get('/',function (){
    return App\Models\Post::findOrFail(100);
});
//매우 중요
//DB::listen(function($event){
//    var_dump($event->sql);
//});