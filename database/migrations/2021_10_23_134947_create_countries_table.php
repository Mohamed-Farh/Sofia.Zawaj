<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration {

	public function up()
	{
		Schema::create('countries', function(Blueprint $table) {
            $table->id();
			$table->string('name', 255);
			$table->boolean('arabic')->default(0);
			$table->boolean('status')->default(1);
		});
	}

	public function down()
	{
		Schema::drop('countries');
	}
}
