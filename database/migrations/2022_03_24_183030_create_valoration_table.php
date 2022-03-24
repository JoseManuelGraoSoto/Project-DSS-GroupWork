<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValorationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valorations', function (Blueprint $table) {
            $table->id();
            $table->int('value');
            $table->string('comment');
            $table->boolean('isModerator');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('valorations', function (Blueprint $table) {
            $table->dropForeign(['article_id']);
        });

        Schema::dropIfExists('valorations');
    }
}
