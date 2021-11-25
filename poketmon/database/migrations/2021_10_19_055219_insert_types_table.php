<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class InsertTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('types', function (Blueprint $table) {
            DB::table('types')->insert([
                'type_num' =>  0,
                'type_name' => '없음',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);

            DB::table('types')->insert([
                'type_num' =>  1,
                'type_name' => '노멀',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);

            DB::table('types')->insert([
                'type_num' =>  2,
                'type_name' => '불꽃',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);

            DB::table('types')->insert([
                'type_num' =>  3,
                'type_name' => '물',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);

            DB::table('types')->insert([
                'type_num' =>  4,
                'type_name' => '전기',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);

            DB::table('types')->insert([
                'type_num' =>  5,
                'type_name' => '풀',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);

            DB::table('types')->insert([
                'type_num' =>  6,
                'type_name' => '얼음',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);

            DB::table('types')->insert([
                'type_num' =>  7,
                'type_name' => '격투',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);

            DB::table('types')->insert([
                'type_num' =>  8,
                'type_name' => '독',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);

            DB::table('types')->insert([
                'type_num' =>  9,
                'type_name' => '땅',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);

            DB::table('types')->insert([
                'type_num' =>  10,
                'type_name' => '비행',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);

            DB::table('types')->insert([
                'type_num' =>  11,
                'type_name' => '에스퍼',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);

            DB::table('types')->insert([
                'type_num' =>  12,
                'type_name' => '벌레',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);

            DB::table('types')->insert([
                'type_num' =>  13,
                'type_name' => '바위',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);

            DB::table('types')->insert([
                'type_num' =>  14,
                'type_name' => '고스트',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);

            DB::table('types')->insert([
                'type_num' =>  15,
                'type_name' => '드래곤',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);

            DB::table('types')->insert([
                'type_num' =>  16,
                'type_name' => '악',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);

            DB::table('types')->insert([
                'type_num' =>  17,
                'type_name' => '강철',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);

            DB::table('types')->insert([
                'type_num' =>  18,
                'type_name' => '페어리',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('types', function (Blueprint $table) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            DB::table('types')->truncate();
        });
    }
}
