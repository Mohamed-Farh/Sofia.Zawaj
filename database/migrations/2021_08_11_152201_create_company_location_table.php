<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_location', function (Blueprint $table) {
            $table->increments('id');
            $table->string('country')->index()->nullable();
            $table->string('city')->index()->nullable();
            $table->string('address')->index()->nullable();
            $table->string('phone',20)->nullable();
            $table->string('whats',20)->nullable();
            $table->longText('map_url')->nullable();
            $table->longText('map_frame')->nullable();
            $table->unsignedTinyInteger('status')->default(0);
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
        Schema::dropIfExists('company_location');
    }
}
