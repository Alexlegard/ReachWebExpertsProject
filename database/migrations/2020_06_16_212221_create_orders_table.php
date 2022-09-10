<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
			
            $table->bigIncrements('id');
			$table->unsignedBigInteger('user_id')->nullable();
			
			$table->foreign('user_id')
				->references('id')->on('users')
				->onUpdate('cascade')
				->onDelete('set null');
				
			$table->string('billing_email');
			$table->string('billing_name');
			$table->string('billing_streetaddress');
			$table->string('billing_streetaddresstwo')->nullable();
			$table->string('billing_city');
			$table->string('billing_state_province');
			$table->string('billing_country');
			$table->string('billing_postalcode');
			$table->string('billing_name_on_card');
			$table->double('billing_subtotal');
			$table->double('billing_tax');
			$table->double('billing_total');
			$table->double('billing_commission');
			$table->string('payment_gateway')->default('stripe');
			$table->boolean('shipped')->default(false);
			$table->string('error')->nullable();
			$table->date('time_placed');
			
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
        Schema::dropIfExists('orders');
    }
}
