<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('images', function($table){
        $table->increments('id');
        $table->unsignedInteger('cottage_id');
        $table->string('fullpath');
        $table->integer('order_val');
        $table->softDeletes();
        $table->timestamps();
      });
      
      Schema::table('images', function($table)
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
      Schema::drop('images');
    }
}
