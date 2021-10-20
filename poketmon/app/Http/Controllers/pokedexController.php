<?php

namespace App\Http\Controllers;

use App\Models\Poketmon;
use Illuminate\Http\Request;

class pokedexController extends Controller
{
    public function show() {
//        $poketmons = Poketmon::where('num','<','5')->get();
//        foreach ($poketmons as $list) {
//            echo $list->name.'<br>';
//        }

        $returnData = "";
        return view('pokedex',['data'=>$returnData]);
    }

    public function showMore(Request $request) {
        $offset = 10;
        $page = $request->input('page');

        if (!is_integer($page)) {
            $page = 0;
        }

        $resultArray = [];
        $poketmons = Poketmon::all()->skip($offset * $page)->take(10);

        foreach ($poketmons as $result) {
            $poket['num'] = $result['num'];
            $poket['name'] = $result['name'];
            array_push($resultArray,$poket);
        }

        return response()->json(array('result'=>$resultArray));
        //return response($resultArray);
    }
}
