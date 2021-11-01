<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyPoketmonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('poketmons', function (Blueprint $table) {
            $table->integer('group_num')->unsigned()->default(0)
                ->after('height')->comment('포켓몬 그룹 번호');
            $table->dropColumn('next_evolution');

            $table->index('group_num');
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
            $table->integer('next_evolution')->comment('진화 포켓몬 번호');
            $table->dropColumn('group_num');
        });
    }
}
