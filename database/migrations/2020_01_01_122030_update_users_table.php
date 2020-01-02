<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('type')->default(0)->after('id'); // 1 => Student 2 => Tutor 3 => Modarator 
            $table->renameColumn('name', 'first_name');
            $table->string('last_name')->after('name');
            $table->string('mobile')->nullable()->after('last_name');
            $table->text('proof_of_id')->nullable()->after('last_name');
            $table->text('picture')->nullable()->after('last_name');
            $table->text('bio')->after('last_name')->nullable();
            $table->dropUnique('users_email_unique');
            $table->integer('approved_by')->nullable()->after('remember_token');
            $table->timestamp('profile_approved_at')->nullable()->after('remember_token');
            $table->timestamp('profile_completed_at')->nullable()->after('remember_token');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
