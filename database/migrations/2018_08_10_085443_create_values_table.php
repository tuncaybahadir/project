<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValuesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('values', function(Blueprint $table)
		{
            $table->engine = 'MyISAM';

			$table->increments('id')->unsigned();
            $table->integer('project_id')->unsigned()->index();
            $table->integer('version_id')->unsigned()->index();
            $table->char('lang', 2)->index();
            $table->string('key', 255);
            $table->string('value', 255);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('values');
	}

}
