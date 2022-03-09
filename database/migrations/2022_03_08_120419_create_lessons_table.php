<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table -> id();
            $table -> string('name');
            $table -> string('content');
            $table -> string('image') -> default('default.jpg');
            $table -> string('url'); 
            $table -> unsignedBigInteger('id_teacher');
            $table -> foreign('id_teacher')->references('id')->on('teachers')->onDelete('cascade');
            $table -> unsignedBigInteger('id_topic');
            $table -> foreign('id_topic')->references('id')->on('topics')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lessons');
    }
}
