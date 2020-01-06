<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchesProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedBigInteger('branch_id')->unsigned();
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->integer('quantity');
            $table->timestamps();
        });

        Schema::create('stock_history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('stock_id')->unsigned();
            $table->foreign('stock_id')->references('id')->on('stock')->onDelete('cascade');
            $table->unsignedBigInteger('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->string('type');
            $table->integer('old_quantity');
            $table->integer('new_quantity');
            $table->integer('ext_trans')->nullable(true);
            $table->unsignedBigInteger('user_id')->unsigned()->comment('Usuario responsable de la transaccion');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });

        Schema::create('stock_audit', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('status');
            $table->timestamps();
        });

        Schema::create('stock_audit_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('audit_id')->unsigned();
            $table->foreign('audit_id')->references('id')->on('stock_audit')->onDelete('cascade');
            $table->unsignedBigInteger('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->integer('system_declared');
            $table->integer('fisic_declared');
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
        Schema::dropIfExists('stock');
        Schema::dropIfExists('stock_history');
        Schema::dropIfExists('stock_audit');
        Schema::dropIfExists('stock_audit_detail');
    }
}
