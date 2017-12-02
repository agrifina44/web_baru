<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('nama');
            $table->string('ktkPerson');
            $table->string('no_hp');
            $table->text('alamat');
            $table->string('provinsi');
            $table->string('kabupaten');
            $table->string('tipe');
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
        Schema::drop('suppliers');
    }
}
