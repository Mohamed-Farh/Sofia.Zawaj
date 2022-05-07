<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code_no')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('image')->default('avatar.png');
            $table->integer('admin')->default(0);
            $table->string('gender');

            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('nationality')->nullable();
            $table->string('dual_nationality')->nullable();


            $table->string('marriage_type')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('age')->nullable();
            $table->string('children_number')->nullable();
            $table->string('children_with')->nullable();

            $table->string('weight')->nullable();
            $table->string('tall')->nullable();
            $table->string('skin')->nullable();
            $table->string('hair_color')->nullable();
            $table->string('listen_music')->nullable();
            $table->string('body_status')->nullable();

            $table->string('religiosity')->nullable();
            $table->string('pray')->nullable();
            $table->string('smoke')->nullable();
            $table->string('beard')->nullable();
            $table->string('hegab')->nullable();

            $table->string('education')->nullable();
            $table->string('education_type')->nullable();
            $table->string('money_status')->nullable();
            $table->string('work_field')->nullable();
            $table->string('work')->nullable();
            $table->string('money_month')->nullable();
            $table->string('health_status')->nullable();

            $table->longText('partner_description')->nullable();
            $table->longText('your_description')->nullable();

            $table->string('full_name')->nullable();
            $table->string('phone')->nullable();

            $table->string('status')->default(0);
            $table->timestamp('last_seen')->nullable();
            $table->string('condition_agree')->default(1);

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
        Schema::dropIfExists('members');
    }
}
