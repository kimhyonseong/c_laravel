<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatchPokesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catch_pokes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_num')
                ->unsigned()->comment('유저 아이디');
            $table->integer('poke_num')
                ->unsigned()->comment('포켓몬 번호');
            $table->string('nickname')->nullable()->comment('별명');
            $table->integer('gender')->nullable()->comment('0:남 1:여');
            $table->float('height')->comment('신장');
            $table->float('weight')->comment('몸무게');
            $table->integer('favorites')->default(0)
                ->nullable()->comment('즐겨찾기');
            $table->integer('sort')->nullable()->comment('순서');
            $table->timestamps();

            $table->index('user_num');
            $table->index('poke_num');
            $table->index('favorites');
            $table->index('sort');

            $table->foreign('user_num')->references('id')
                ->on('users')->onUpdate('cascade');
            $table->foreign('poke_num')->references('num')
                ->on('poketmons')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catch_pokes');
    }
}
