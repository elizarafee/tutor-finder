<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConnectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('connections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('request_to');
            $table->integer('requested_by');
            $table->timestamp('requested_at')->nullable();
            $table->boolean('seen')->default(0);
            $table->timestamp('approved_at')->nullable();
            $table->integer('approved_by')->nullable();
            $table->timestamp('rejected_at')->nullable();
            $table->timestamp('rejected_by')->nullable();
            $table->text('rejection_reason')->nullable();
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
        Schema::dropIfExists('connections');
    }
}
