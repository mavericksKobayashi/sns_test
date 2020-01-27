<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('flip_id',30);
            $table->char('nickname',30);
            $table->char('email',100);
            $table->char('password',100)->nullable();
            $table->char('place',30)->nullable();
            $table->char('gender',10)->nullable();
            $table->char('self_intro',200)->nullable();
            $table->integer('locked')->nullable();
            $table->integer('block')->nullable();
            $table->integer('freeze');
            $table->string('last_login',25)->nullable();
            $table->integer('created_at')->nullable();
            $table->integer('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
