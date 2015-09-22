<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCottageAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('cottage_area', function($table)
      {
        $table->increments('id');
        $table->integer('cottage_id')->unsigned();
        $table->integer('area_id')->unsigned();

        $table->foreign('cottage_id')
                ->references('id')
                ->on('cottages');
        $table->foreign('area_id')
                ->references('id')
                ->on('areas');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::drop('cottage_area');
    }
}
