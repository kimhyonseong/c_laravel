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

    public function showMore(Request $request,$page) {
        $offset = 20;

        // 숫자인지 확인
        if (!is_numeric($page)) {
            $page = 0;
        }

        /* 안됨...
        if (!is_int($page)) {
            $page = 0;
        } */

        $resultArray = [];
        $poketmons = Poketmon::all()->skip($offset * $page)->take($offset);

        foreach ($poketmons as $result) {
            if (!is_integer($result['num']) || $result['num'] < 1) {
                continue;
            }
            $poket['num'] = 'No.'.sprintf('%03d',$result['num']);
            $poket['name'] = $result['name'];
            $poket['html'] = '<li>
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
            </li>';
            array_push($resultArray,$poket);
        }

//        return response()->json(array('result'=>$page));
        return response()->json(array('result'=>$resultArray));
    }

    public function showDetail(Request $request, $num){
        $result = [];

        $poketmon = Poketmon::all()->where('num','=',$num);
        $pre_poketmon = Poketmon::all()->where('next_evolution','=',$num);

        foreach ($poketmon as $poketInfo) {
            $info['num'] = $poketInfo['num'];
            $info['name'] = $poketInfo['name'];
            $info['img'] = $poketInfo['img'];
            $info['next_evolution'] = $poketInfo['next_evolution'];
            $info['next_evolution_info'] = [];

            if ($info['next_evolution'] > 0) {
                $next_poketmon = Poketmon::all()->where('num', '=', $info['next_evolution']);

                foreach ($next_poketmon as $next_poketInfo) {
                    $next_info['num'] = $next_poketInfo['num'];
                    $next_info['name'] = $next_poketInfo['name'];
                    $next_info['img'] = $next_poketInfo['img'];
                    $next_info['next_evolution'] = $next_poketInfo['next_evolution'];

                    array_push($info['next_evolution_info'],$next_info);
                }
            }

            array_push($result,$info);
        }
        return view('poketDetail',['data'=>$result]);
    }
}
