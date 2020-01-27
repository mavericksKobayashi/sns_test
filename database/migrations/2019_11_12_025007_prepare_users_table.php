<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PrepareUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
          $table->string('email')->nullable()->change();
          $table->string('password')->nullable()->change();
          $table->string('avatar')->nullable();
          $table->string('facebook_id')->unique()->nullable();
          $table->string('facebook_name')->nullable();
          $table->string('twitter_id')->unique()->nullable();
          $table->string('twitter_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
