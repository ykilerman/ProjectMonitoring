<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('name',100);
            $table->string('description');
            $table->string('icon_path');
            $table->string('client_name',50);
            $table->integer('value');
            $table->integer('update_schedule');
            $table->timestamp('last_notification')->useCurrent();
            $table->enum('status',['Preparing','On Going','Closed','Deleted','Archived'])->default('Preparing');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('projects');
    }
}
