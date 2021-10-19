<?php

use App\Models\Poketmon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class InsertPoketmonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('poketmons', function (Blueprint $table) {
//            $file = Storage::disk('public')->get('Pokemon/pokedex-korean.json');
//            $contents = json_decode($file,true);

            $jsonUrl = 'https://raw.githubusercontent.com/intelcoder/PokemonGO-Pokedex-Korean/master/pokedex-korean.json';
            $jsonStr = file_get_contents($jsonUrl);
            $contents = json_decode($jsonStr,true);
            $cnt = count($contents);

            $poketmon = new Poketmon;

            for($i = 0; $i < $cnt; $i++) {
                $pokeNum = number_format($contents[$i]['num']);
                $pokeName = $contents[$i]['name'];
                $pokeImg = $contents[$i]['img'];
                $pokeType = $contents[$i]['type'];
                $pokeWeak = $contents[$i]['weaknesses'];

                $pokeHeight = explode(' ', $contents[$i]['height']);
                $pokeHeight = $pokeHeight[0];
                $pokeWeight = explode(' ', $contents[$i]['weight']);
                $pokeWeight = $pokeWeight[0];

                // 타입 1,2
                if (strpos($pokeType, '/') !== false) {
                    $pokeTypes = explode('/', $pokeType);
                } else {
                    $pokeTypes = [$pokeType];
                }

                for ($k = 0; $k < count($pokeTypes); $k++) {
                    $pokeTypesNum[$k] = typeToNum(trim($pokeTypes[$k]));
                }

                // 두번째 타입이 없으면 0으로 설정
                if (!isset($pokeTypes[1])) {
                    $pokeTypesNum[1] = 0;
                }

                // 다음 진화
                if (isset($contents[$i]['next_evolution'])) {
                    $pokeNextEv = ($contents[$i]['next_evolution']);
                } else {
                    $pokeNextEv[0]['num'] = null;
                }

                $evolutionCnt = count($pokeNextEv);

                if ($evolutionCnt > 0) {
                    $poketmon->next_evolution = $pokeNextEv[0]['num'];
                }

                // 약점 -  배열로 저장되어있음
                $pokeWeakParsed = "";
                $weekCnt = count($pokeWeak);
                for ($j = 0; $j < $weekCnt; $j++) {
                    $pokeWeakParsed .= $pokeWeak[$j];
                    if ($weekCnt - 1 != $j) {
                        $pokeWeakParsed .= '/';
                    }
                }

//            $poketmon->num = $pokeNum;
//            $poketmon->name = $pokeName;
//            $poketmon->weight = $pokeWeight;
//            $poketmon->height = $pokeHeight;
//            $poketmon->img = $pokeImg;
//            $poketmon->type_num1 = $pokeTypesNum[0];
//            $poketmon->type_num2 = $pokeTypesNum[1];
//            $poketmon->weakness = $pokeWeakParsed;

                // 마지막 줄만 저장이 됨
//            $poketmon->save();

                // 이렇게 하면 created_at, updated_at 생성이 안됨
//            DB::table('poketmons')->insert([
//                'num' => $pokeNum,
//                'name' => $pokeName,
//                'weakness' => $pokeWeakParsed,
//                'weight' => $pokeWeight,
//                'height' => $pokeHeight,
//                'img' => $pokeImg,
//                'type_num1' => $pokeTypesNum[0],
//                'type_num2' => $pokeTypesNum[1],
//                'next_evolution' => number_format($pokeNextEv[0]['num']),
//            ]);

                Poketmon::create([
                    'num' => $pokeNum,
                    'name' => $pokeName,
                    'weakness' => $pokeWeakParsed,
                    'weight' => $pokeWeight,
                    'height' => $pokeHeight,
                    'img' => $pokeImg,
                    'type_num1' => $pokeTypesNum[0],
                    'type_num2' => $pokeTypesNum[1],
                    'next_evolution' => number_format($pokeNextEv[0]['num']),
                ]);
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('poketmons', function (Blueprint $table) {
            $num = DB::table('poketmons')->count();

            // 포켓몬 갯수에 따른 쿼리 변경
            if ($num <= 151) {
                DB::table('poketmons')->truncate();
            } else {
                DB::table('poketmons')->where('num', '<=', 151)->delete();
            }
        });
    }
}
