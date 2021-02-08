<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_restaurant', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedBigInteger("admin_id");
			$table->unsignedBigInteger("restaurant_id");
			
			$table->foreign('admin_id')
				->references('id')->on('admins')
				->onUpdate('cascade')
				->onDelete('cascade');
			
			$table->foreign('restaurant_id')
				->references('id')->on('restaurants')
				->onUpdate('cascade')
				->onDelete('cascade');
			
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
        Schema::dropIfExists('admin_restaurant');
    }
}
