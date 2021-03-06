<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('till', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->boolean('status');
            $table->integer('opening_cash');
            $table->integer('actual_cash');
            $table->timestamps();
        });

        Schema::create('transaction_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description');
        });

        Schema::create('till_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('till_id');
            $table->foreign('till_id')->references('id')->on('till');
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->references('id')->on('transaction_types');
            $table->integer('detail_id')->comment('Id de detalle de transaccion');
            $table->integer('cash_before_op');
            $table->integer('cash_after_op');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });

        Schema::create('till_audit', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('till_id');
            $table->foreign('till_id')->references('id')->on('till');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('registered_cash');
            $table->integer('declared_cash');
            $table->string('status');
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
        Schema::dropIfExists('till');
        Schema::dropIfExists('transaction_types');
        Schema::dropIfExists('till_transactions');
        Schema::dropIfExists('till_audit');
    }
}
