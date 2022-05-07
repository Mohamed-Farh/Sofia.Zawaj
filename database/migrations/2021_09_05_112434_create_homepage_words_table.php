<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomepageWordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homepage_words', function (Blueprint $table) {
            $table->increments('id');

            $table->longText('description')->nullable();
            $table->string('type')->nullable();
            $table->enum('vision', ['1', '0'])->nullable()->default('0');

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
        Schema::dropIfExists('homepage_words');
    }
}
