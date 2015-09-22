<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('bookings', function(Blueprint $table)
      {
        $table->increments('id');
        $table->unsignedInteger('cottage_id');
        $table->unsignedInteger('user_id');
        $table->integer('nights');
        $table->date('first_night');
        $table->date('last_night');
        $table->integer('status');
        $table->integer('amount');
        $table->integer('paid');
        $table->timestamps();
      });
      
      Schema::table('bookings', function(Blueprint $table)
      {
        $table->foreign('cottage_id')->references('id')->on('cottages');
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
      Schema::drop('bookings');
    }
}
