<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdatePoketmonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('poketmons', function (Blueprint $table) {
            $jsonUrl = 'http://localhost/json/pokedex-korean.json';
            $jsonStr = file_get_contents($jsonUrl);

            $contents = json_decode($jsonStr,false);

            foreach ($contents as $poke) {
                $poke_group = [];

                $pokeNum = number_format($poke->num);

                //이전 진화
                if (isset($poke->prev_evolution)) {
                    foreach ($poke->prev_evolution as $pre) {
                        // 이전 진화를 포켓몬 그룹에 넣기
                        // 이상해풀이면 이상해씨가 들어감
                        array_push($poke_group,$pre->num);
                    }
                }

                // 다음 진화
                if (isset($poke->next_evolution)) {
                    // 다음 진화가 있는데 이전 진화가 없을 시 자신이 포켓몬 그룹이 됨
                    if (!isset($poke_group[0])) {
                        array_push($poke_group,$poke->num);
                    }
                }

                // 포켓몬 그룹이 있을때만 업데이트
                if (isset($poke_group[0])) {
                    $pokeGroupNum = $poke_group[0];

                    DB::table('poketmons')->where('num',$pokeNum)
                        ->update(['group_num' => $pokeGroupNum]);
                }
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
        DB::table('poketmons')
            ->update(['group_num' => 0]);
    }
}
