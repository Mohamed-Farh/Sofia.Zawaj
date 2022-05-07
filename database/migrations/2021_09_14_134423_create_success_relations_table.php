<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuccessRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('success_relations', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->nullable();

            $table->string('age')->nullable();

            $table->string('gender')->nullable();

            $table->longText('word')->nullable();

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
        Schema::dropIfExists('success_relations');
    }
}
