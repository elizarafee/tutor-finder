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
            $table->smallInteger('type')->default(0)->after('id'); // 1 => Admin 2 => Tutor 3 => Student
            $table->renameColumn('name', 'first_name');
            $table->string('last_name')->after('name');
            $table->string('mobile', 11)->nullable()->after('last_name');
            $table->text('proof_of_id')->nullable()->after('last_name');
            $table->text('picture')->nullable()->after('last_name');
           // $table->dropUnique('users_email_unique');
            $table->boolean('active')->default(1)->after('remember_token');
            $table->boolean('reviewed')->default(0)->after('remember_token');
            $table->timestamp('rejected_at')->nullable()->after('remember_token');
            $table->integer('rejected_by')->nullable()->after('remember_token');
            $table->text('rejection_reason')->nullable()->after('remember_token');
            $table->integer('approved_by')->nullable()->after('remember_token');
            $table->timestamp('approved_at')->nullable()->after('remember_token');
            $table->timestamp('completed_at')->nullable()->after('remember_token');
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
