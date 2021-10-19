<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class jsonPaseTestController extends Controller
{
    public function show() {
        $jsonUrl = 'https://raw.githubusercontent.com/intelcoder/PokemonGO-Pokedex-Korean/master/pokedex-korean.json';
        $jsonStr = file_get_contents($jsonUrl);

        $str = json_decode($jsonStr,false);

//        foreach ($str as $poke) {
//            echo $poke->name.'<br>';
//        }
        $returnData = "";
        return view('jsonParseTest',['data'=>$returnData]);
    }
}
