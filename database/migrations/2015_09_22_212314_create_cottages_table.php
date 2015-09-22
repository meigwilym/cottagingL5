<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCottagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('cottages', function(Blueprint $table){
        $table->increments('id');
        $table->string('name');
        $table->string('slug');
        $table->text('description');
        
        $table->string('start_days');
        $table->integer('min_duration');
        
        $table->string('summary');
        $table->string('page_title');
        $table->string('keywords');
        $table->string('accommodation');
        $table->string('lat');
        $table->string('lon');
        $table->integer('sleeps');
        $table->integer('bedrooms');
        $table->integer('bathrooms');
        
        $table->integer('dogs');
        $table->integer('night_price');
        $table->integer('week_price');
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
      Schema::drop('cottages');
    }
}
