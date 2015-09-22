<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('prices', function($table){
        $table->increments('id');
        $table->unsignedInteger('cottage_id');
        $table->date('start');
        $table->date('end');
        $table->integer('night_price');
        $table->integer('week_price');
        $table->timestamps();
      });
      
      Schema::table('prices', function($table)
      {
        $table->foreign('cottage_id')->references('id')->on('cottages');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::drop('prices');
    }
}
