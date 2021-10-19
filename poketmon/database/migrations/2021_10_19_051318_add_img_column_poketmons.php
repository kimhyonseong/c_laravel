<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImgColumnPoketmons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('poketmons', function (Blueprint $table) {
            $table->string('img',200)->after('name')->nullable()->comment('포켓몬 이미지');
            $table->integer('next_evolution')->nullable()->change();
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
            $table->integer('next_evolution')->comment('진화 포켓몬 번호')->change();
            $table->dropColumn('img');
        });
    }
}
