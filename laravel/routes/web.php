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

Route::get('foo', function () {
    return 'Hello World';
});

Route::get('index',[
   'as' => 'LuigiIndex',
   'uses' => 'App\Http\Controllers\IndexController@show'
]);


Route::resource('posts', 'App\Http\Controllers\PostController');

Route::get('/',function (){
    //return App\Models\Post::findOrFail(100);
    $text =<<<EOT
**Note** To make lists look nice, you can wrap items with hanging indents:

    -   Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
        Aliquam hendrerit mi posuere lectus. Vestibulum enim wisi,
        viverra nec, fringilla in, laoreet vitae, risus.
    -   Donec sit amet nisl. Aliquam semper ipsum sit amet velit.
        Suspendisse id sem consectetuer libero luctus adipiscing.
EOT;
    return app(ParsedownExtra::class)->text($text);
});




//매우 중요
//DB::listen(function($event){
//    var_dump($event->sql);
//});