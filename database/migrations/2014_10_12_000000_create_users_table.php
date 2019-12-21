<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
        });

        Schema::create('branches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('code');
            $table->integer('department_id');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->string('name');
            $table->string('address');
            $table->string('phone');
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('ci');
            $table->string('username');
            $table->integer('branch_id');
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->string('name');
            $table->string('description');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('address');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('status');
            $table->string('image')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('departments');
        Schema::dropIfExists('branches');
        Schema::dropIfExists('users');
    }
}
