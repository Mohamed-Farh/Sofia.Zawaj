<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('member_id')->unsigned();
            $table->foreign('member_id')->references('id')->on('members')
					->onDelete('cascade')
					->onUpdate('cascade');

            $table->string('who_can_text_me')->default('all');
            $table->string('nationality_can_text_me')->default('all');
            $table->string('age_can_text_me')->default('all');
            $table->enum('show_who_care_me', ['on', 'off'])->default('on');
            $table->enum('show_visit_me', ['on', 'off'])->default('on');
            $table->enum('show_block_me', ['on', 'off'])->default('on');
            $table->enum('show_unblock_me', ['on', 'off'])->default('on');
            $table->enum('show_new_messages', ['on', 'off'])->default('on');
            $table->enum('show_success_stories', ['on', 'off'])->default('on');
            $table->enum('email_send', ['on', 'off'])->default('off');
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
        Schema::dropIfExists('settings');
    }
}
