<?php

namespace App\Http\Controllers;

use App\Models\Poketmon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function showMore(Request $request,$page) {
        $offset = 20;

        // 숫자인지 확인
        if (!is_numeric($page)) {
            $page = 0;
        }

        $resultArray = [];
        $poketmons = Poketmon::all()->skip($offset * $page)->take($offset);

        foreach ($poketmons as $result) {
            if (!is_integer($result['num']) || $result['num'] < 1) {
                continue;
            }
            $poket['num'] = 'No.'.sprintf('%03d',$result['num']);
            $poket['name'] = $result['name'];
            $poket['html'] = '<li>
                <a href="pokedex/'.$result['num'].'">
                    <div class="li_wrap">
                        <div class="img">
                            <div class="thumb">
                                <!--<img src="'.$result['img'].'" alt="'.$poket['name'].'">-->
                                <img src="https://via.placeholder.com/120" alt="'.$poket['name'].'">
                            </div>
                        </div>
                        <div class="info">
                            <div class="num">'.$poket['num'].'</div>
                            <div class="name">'.$poket['name'].'</div>
                        </div>
                    </div>
                </a>
            </li>';
            array_push($resultArray,$poket);
        }

//        return response()->json(array('result'=>$page));
        return response()->json(array('result'=>$resultArray));
    }

    public function showDetail(Request $request, $num){
        $result = [];
        $evolution = [];

        $poketmon = Poketmon::all()->where('num','=',$num);

        foreach ($poketmon as $poketInfo) {
            $info['num'] = $poketInfo['num'];
            $info['name'] = $poketInfo['name'];
            $info['img'] = $poketInfo['img'];
            $info['group_num'] = $poketInfo['group_num'];

            if ($info['group_num'] > 0) {
                $evolutionPoke = DB::table('poketmons as a')
                    ->join('evolutions as b','a.group_num','=','b.group_num')
                    ->select('b.*')
                    ->where('a.num','=',$info['num'])
                    ->get();

                foreach ($evolutionPoke as $evolPoke) {
                    $evolInfo = [];
                    $evolInfo['name'] = $evolPoke->name;
                    $evolInfo['num'] = $evolPoke->num;
                    $evolInfo['img'] = $evolPoke->img;

                    // 진화 포켓몬
                    array_push($evolution,$evolInfo);
                }
            }

            // 현재 포켓몬
            array_push($result,$info);
        }
        return view('poketDetail',
            [
                'poke'=>$result,
                'evolution' =>$evolution
            ]);
    }
}
