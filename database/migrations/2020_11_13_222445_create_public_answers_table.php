<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public_answers', function (Blueprint $table) {
            $table->id();
            $table->integer('answered_by')->unsigned();
            $table->integer('problem_id')->unsigned();
            $table->integer('asked_by')->unsigned();
            $table->text('answer');
            $table->text('problem');
            $table->string('response')->nullable();
            $table->boolean('deleted')->nullable();

            $table->timestamps();
            $table->index('problem_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('public_answers');
    }
}
