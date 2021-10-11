<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dishes', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedBigInteger('menu_id');
			
			$table->foreign('menu_id')
				->references('id')->on('menus')
				->onDelete('cascade');
				
			$table->string('name');
			$table->json('price');
			$table->json('special_price')-> nullable();
			$table->text('description');
			$table->string('slug');
			$table->string('cuisine');
			$table->integer('calories')->nullable();
			$table->unsignedBigInteger('people_served');
			$table->unsignedBigInteger('stock');
			$table->boolean('is_beverage');
			$table->boolean('is_alcoholic');
			$table->boolean('on_sale')->default(false);
			$table->date('on_sale_until')->nullable();
			$table->string('image')->default('default.jpg');
			$table->string('image_external_url')->nullable();
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
        Schema::dropIfExists('dishes');
    }
}
