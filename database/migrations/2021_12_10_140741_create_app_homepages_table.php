<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppHomepagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_homepages', function (Blueprint $table) {
            $table->increments('id');

            $table->string('page_no')->nullable();

            $table->longText('title')->nullable();

            $table->string('content')->nullable();

            $table->string('image')->nullable();

            $table->enum('status', ['0', '1'])->default('0');

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
        Schema::dropIfExists('app_homepages');
    }
}
