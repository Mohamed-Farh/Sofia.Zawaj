<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_relations', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('my_id')->unsigned();
            $table->foreign('my_id')->references('id')->on('members')
					->onDelete('cascade')
					->onUpdate('cascade');

            $table->integer('member_id')->unsigned();
            $table->foreign('member_id')->references('id')->on('members')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->enum('status', ['0', '1'])->default('0');
            $table->enum('visit_profile', ['0', '1'])->default('0');
            $table->enum('ignore_list', ['0', '1'])->default('0');
            $table->enum('care_list', ['0', '1'])->default('0');
            $table->enum('send_message', ['0', '1'])->default('0');
            $table->enum('success_relation', ['0', '1'])->default('0');

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
        Schema::dropIfExists('member_relations');
    }
}
