<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetupStudentRelatedTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('students');
        Schema::dropIfExists('name_titles');
        Schema::dropIfExists('education_levels');

        Schema::create('name_titles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
        });

        Schema::create('education_levels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('short_name',10);
        });

        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('name_title_id');
            $table->string('first_name', 200);
            $table->string('last_name', 200);
            $table->string('short_name', 100);
            $table->string('citizen_id')->nullable();
            $table->date('birth_date')->default('0000-00-00');
            $table->string('avatar')->nullable();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('city')->nullable();
            $table->integer('province_id');
            $table->string('postal_code', 10);

            $table->integer('education_level_id')->unsigned();
            $table->text('billing_address')->nullable();

            $table->text('private_note')->nullable();
            $table->integer('status')->unsigned()->default(1);

            $table->timestamps();
            $table->softDeletes();
            $table->unsignedInteger('created_by');
            $table->unsignedInteger('updated_by')->nullable();


            $table->foreign('name_title_id')->references('id')->on('name_titles');
            $table->foreign('education_level_id')->references('id')->on('education_levels');
            $table->foreign('province_id')->references('id')->on('provinces');

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
        Schema::dropIfExists('name_titles');
        Schema::dropIfExists('education_levels');

    }
}
