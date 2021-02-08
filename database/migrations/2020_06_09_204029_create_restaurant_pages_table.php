<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurant_pages', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedBigInteger('restaurant_id');
			
			$table->foreign('restaurant_id')
				->references('id')->on('restaurants')
				->onDelete('cascade');
			
			$table->string('tag');
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
        Schema::dropIfExists('restaurant_pages');
    }
}
