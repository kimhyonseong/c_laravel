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

        return response()->json(array('result'=>$resultArray));
    }

    public function showDetail(Request $request, $num){
        $result = [];
        $pokeList = [];
        $evolution = [];

        $thisPoke = Poketmon::all()->where('num','=',$num);
        $pokeListRes = DB::table('poketmons')->select('name','num')
            ->whereRaw('if(? < (select MIN(num) from poketmons),num = (select MAX(num) from poketmons), num = ?)',
                [$num-1,$num-1])
            ->orWhereRaw('if(? > (select MAX(num) from poketmons),num = (select MIN(num) from poketmons), num = ?)',
                [$num+1,$num+1])
            ->get();

        /*
         * 1 일때 151,2
         * 151 일때 150,1
         */

        foreach ($pokeListRes as $pokeInfo) {
            if ($pokeInfo->num == $num + 1) {
                //다음 번호
                $next['num_int'] = $pokeInfo->num;
                $next['num_str'] = 'No.'.sprintf('%03d',$pokeInfo->num);
                $next['name'] = $pokeInfo->name;

                $pokeList['next'] = $next;
            } elseif ($pokeInfo->num == ($num - 1)) {
                //이전 번호
                $pre['num_int'] = $pokeInfo->num;
                $pre['num_str'] = 'No.'.sprintf('%03d',$pokeInfo->num);
                $pre['name'] = $pokeInfo->name;

                $pokeList['pre'] = $pre;
            } else {
                //나머지
                $extra['num_int'] = $pokeInfo->num;
                $extra['num_str'] = 'No.'.sprintf('%03d',$pokeInfo->num);
                $extra['name'] = $pokeInfo->name;
            }
        }

        // 나머지 번호 존재 시
        if (isset($extra)) {
            if (empty($pokeList['pre'])) {
                $pokeList['pre'] = $extra;
            } else {
                $pokeList['next'] = $extra;
            }
        }

        //파라미터에 해당하는 포켓몬 정보
        foreach ($thisPoke as $pokeInfo) {
            $info['num_int'] = $pokeInfo['num'];
            $info['num_str'] = 'No.'.sprintf('%03d',$pokeInfo['num']);
            $info['name'] = $pokeInfo['name'];
            $info['img'] = $pokeInfo['img'];
            $info['group_num'] = $pokeInfo['group_num'];
            $info['weakness'] = $pokeInfo['weakness'];
            $info['type_num1'] = $pokeInfo['type_num1'];
            $info['type_num2'] = $pokeInfo['type_num2'];
            $info['weight'] = sprintf('%.1f',$pokeInfo['weight']).'kg';
            $info['height'] = sprintf('%.2f',$pokeInfo['height']).'m';

            if (empty($info['type_num2'])) {
                $info['types'] = typeHtml($info['type_num1']);
            } else {
                $info['types'] = typeHtml($info['type_num1']) .' '. typeHtml($info['type_num2']);
            }

            if ($info['group_num'] > 0) {
                $evolutionPoke = DB::table('poketmons as a')
                    ->join('evolutions as b','a.group_num','=','b.group_num')
                    ->select('b.*')
                    ->where('a.num','=',$info['num_int'])
                    ->get();

                foreach ($evolutionPoke as $evolPoke) {
                    $evolInfo = [];
                    $evolInfo['name'] = $evolPoke->name;
                    $evolInfo['num_int'] = $evolPoke->num;
                    $evolInfo['num_str'] = 'No.'.sprintf('%03d',$evolPoke->num);
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
                'evolution' =>$evolution,
                'pokeList' =>$pokeList,
            ]);
    }
}
