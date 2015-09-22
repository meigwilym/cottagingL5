<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('areas', function(Blueprint $table)
      {
        $table->increments('id');
        $table->unsignedInteger('parent_id')->nullable();
        $table->string('area');
        $table->string('slug');
        $table->string('description', 512);
        $table->timestamps();
      });
      
      Schema::table('areas', function(Blueprint $table)
      {
        $table->foreign('parent_id')->references('id')->on('areas');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::drop('areas');
    }
}
