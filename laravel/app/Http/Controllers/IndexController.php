<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    // php artisan make:controller IndexController
    public function index() {
        $greeting = 'Hello';
        $name = 'khs';
        $items = ['Apple','Banana'];
        return view('welcome')->with(compact('greeting','name','items'));
    }

    public function show() {
        return 'Luigi!';
    }
}
