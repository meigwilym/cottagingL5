<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCottageFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('cottage_feature', function(Blueprint $table) {
        $table->increments('id');
        $table->integer('cottage_id')->unsigned();
        $table->integer('feature_id')->unsigned();
        $table->foreign('cottage_id')->references('id')->on('cottages');
        $table->foreign('feature_id')->references('id')->on('features');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::drop('cottage_feature');
    }
}
