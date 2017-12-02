<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salesOrders', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tanggal');
            $table->string('salesChannel');
            $table->string('salesPerson');
            $table->string('type');
            $table->string('customer');
            $table->string('shippingAddress');
            $table->string('billingAddress');
            $table->integer('total');
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
        Schema::drop('salesOrders');
    }
}
