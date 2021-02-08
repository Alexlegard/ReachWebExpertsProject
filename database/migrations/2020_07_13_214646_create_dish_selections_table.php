<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDishSelectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dish_selections', function (Blueprint $table) {
            $table->BigIncrements('id');
			$table->unsignedBigInteger('dish_id');
			
			$table->foreign('dish_id')
				->references('id')->on('dishes')
				->onUpdate('cascade')
				->onDelete('cascade');
				
			$table->string('name');
			$table->json('options');
			$table->string('radio_or_checkbox');
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
        Schema::dropIfExists('dish_selections');
    }
}
