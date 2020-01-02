<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('payment_id');
            $table->foreign('payment_id')->references('id')->on('payment_methods');
            $table->integer('client_id');
            $table->foreign('client_id')->references('id')->on('users');
            $table->integer('total');
            $table->timestamps();
        });

        Schema::create('invoice_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('invoice_id');
            $table->foreign('invoice_id')->references('id')->on('invoices');
            $table->integer('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->integer('quantity');
            $table->integer('sub_total');
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
        Schema::dropIfExists('payment_methods');
        Schema::dropIfExists('invoices');
        Schema::dropIfExists('invoice_detail');
    }
}
