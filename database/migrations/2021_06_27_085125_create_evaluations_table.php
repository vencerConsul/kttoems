<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->integer('survey_id')->unsigned();
            $table->string('survey_title');
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->string('suffix');
            $table->string('email');
            $table->string('key1');
            $table->string('key2');
            $table->string('key3');
            $table->string('key4');
            $table->string('key5');
            $table->string('key6');
            $table->text('comment');
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
        Schema::dropIfExists('evaluations');
    }
}
