<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoketmonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poketmons', function (Blueprint $table) {
            $table->id();
            $table->integer('num')->unsigned()->comment('포켓몬 번호');
            $table->string('name',100)->comment('포켓몬 이름');
            $table->integer('type_num1')->unsigned()->default(0)->comment('타입1');
            $table->integer('type_num2')->unsigned()->default(0)->comment('타입2');
            $table->string('weakness', 200)->comment('약점');  // 구분자로 type_num 저장
            $table->integer('next_evolution')->comment('진화 포켓몬 번호');
            $table->float('weight',6,2)->comment('몸무게');
            $table->float('height',6,2)->comment('키');
            $table->timestamps();

            $table->index('num');
            $table->index('type_num1');
            $table->index('type_num2');

            $table->foreign('type_num1')->references('type_num')->on('types')->onUpdate('cascade');
            $table->foreign('type_num2')->references('type_num')->on('types')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poketmons');
    }
}
