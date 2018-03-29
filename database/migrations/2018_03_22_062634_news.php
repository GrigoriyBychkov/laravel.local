<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class News extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('author_id')->unsigned()->default(0);
            $table->foreign('author_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
            $table->string('title');
            $table->text('body');
            $table->string('img')->unique()->default('null');
            $table->integer('views')->default(0);
            $table->boolean('active')->default('1');
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
        Schema::dropIfExists('news');
    }
}
