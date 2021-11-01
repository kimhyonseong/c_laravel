<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvolutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evolutions', function (Blueprint $table) {
            $table->id();
            $table->integer('group_num')->unsigned()->default(0)
                ->comment('포켓몬 그룹 번호');
            $table->integer('num')->unsigned()
                ->comment('포켓몬 번호');
            $table->string('name',100)
                ->comment('포켓몬 이름');
            $table->string('img',200)->nullable()
                ->comment('포켓몬 이미지');
            $table->timestamps();

            $table->index('num');
            $table->foreign('group_num')
                ->references('group_num')
                ->on('poketmons')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evolutions');
    }
}
