<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDishPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dish_order', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger("order_id")->nullable();
			$table->unsignedBigInteger("dish_id");
			
			$table->foreign('order_id')
				->references('id')->on('orders')
				->onUpdate('cascade')
				->onDelete('cascade');
			
			$table->foreign('dish_id')
				->references('id')->on('dishes')
				->onUpdate('cascade')
				->onDelete('cascade');
				
			$table->unsignedBigInteger('quantity');
			
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
        Schema::dropIfExists('dish_order');
    }
}
