<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTutorQualificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutor_qualifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('tutor_id');
            $table->integer('level');
            $table->string('subject');
            $table->string('institute');
            $table->string('status');
            $table->text('proof_of_doc')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('tutor_qualifications');
    }
}
