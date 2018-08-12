<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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

            $table->engine = 'MyISAM';

            $table->increments('id')->unsigned();
            $table->string('name', 255);
            $table->string('email', 255)->unique()->index();
            $table->string('password', 255);
            $table->tinyInteger('role', 1)->default(2)->index();
            $table->tinyInteger('active')->nullable()->unsigned()->default(1)->index();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }

}
