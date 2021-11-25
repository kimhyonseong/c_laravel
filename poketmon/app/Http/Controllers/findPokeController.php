<?php

namespace App\Http\Controllers;

use App\Models\Poketmon;
use App\Models\catchPoke;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class findPokeController extends Controller
{
    public function index() {
        return view('findPoke');
    }

    public function find(): \Illuminate\Http\JsonResponse
    {
        $jsonUrl = asset('json/pokedex-korean.json');
        $jsonStr = file_get_contents($jsonUrl);
        $str = json_decode($jsonStr,false);
        $findPoke = [];

        for ($i=0; $i<8; $i++) {
            ${'rare_'.$i} = [];
        }

        foreach ($str as $poke) {
            array_push(${'rare_'.(int)$poke->rare},$poke->num);
        }

        $groupArray = [
            ['rate'=>0,'value'=>'rare_0'],
            ['rate'=>0.5,'value'=>'rare_1'],
            ['rate'=>3,'value'=>'rare_2'],
            ['rate'=>5,'value'=>'rare_3'],
            ['rate'=>8.5,'value'=>'rare_4'],
            ['rate'=>13,'value'=>'rare_5'],
            ['rate'=>25,'value'=>'rare_6'],
            ['rate'=>45,'value'=>'rare_7'],
        ];

        $randomGroup = randomRate($groupArray);
        $randomPokemonNum = ${$randomGroup}[mt_rand(0,count(${$randomGroup})-1)];
        $pokemonInfo = Poketmon::where('num',$randomPokemonNum)->get();

        foreach ($pokemonInfo as $resultPoke) {
            // 삽입될 정보
            $findPoke['num'] = $resultPoke['num'];
            $findPoke['gender'] = mt_rand(0,1);
            $findPoke['height'] = weight($resultPoke['height']);
            $findPoke['weight'] = weight($resultPoke['weight']);

            // 보여주기 용도
            $findPoke['name'] = $resultPoke['name'];
            $findPoke['img'] = $resultPoke['img'];
            $findPoke['type_num1'] = $resultPoke['type_num1'];
            $findPoke['type_num2'] = $resultPoke['type_num2'];
            $findPoke['types'] = typeHtml($findPoke['type_num1']);

            if ($resultPoke['type_num1'] > 0) {
                $findPoke['type1_color'] = typeColor($resultPoke['type_num1']);
            }

            if ($resultPoke['type_num2'] > 0) {
                $findPoke['types'] .= typeHtml($findPoke['type_num2']);
                $findPoke['type2_color'] = typeColor($resultPoke['type_num2']);
            }
        }

        if (Auth::check()) {
            catchPoke::create([
                'user_num' => Auth::id(),
                'poke_num' => $findPoke['num'],
                'height' => $findPoke['height'],
                'weight' => $findPoke['weight'],
                'gender' => $findPoke['gender'],
            ]);
        }

        return response()->json(array('pokemon'=>$findPoke));
    }
}
