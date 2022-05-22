<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('category', ['Ciencia', 'Biologia', 'Computación', 'Machine Learning']);
            $table->float('valoration');
            $table->string('content',16000);
            $table->boolean('acepted');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->binary('pdf_path');
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
        Schema::table('articles', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('articles');
    }
}
