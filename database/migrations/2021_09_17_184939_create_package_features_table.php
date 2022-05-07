<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_features', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('package_id')->unsigned();
            $table->foreign('package_id')->references('id')->on('packages')
					->onDelete('cascade')
					->onUpdate('cascade');

            $table->string('title')->nullable();
            $table->longText('name')->nullable();
            $table->enum('show', ['0', '1'])->default('0');
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
        Schema::dropIfExists('package_features');
    }
}
