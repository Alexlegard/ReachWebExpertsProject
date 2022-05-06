<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('order_id')->nullable();
            $table->foreign('order_id')
                ->references('id')->on('orders')
                ->onDelete('cascade');

            $table->unsignedBigInteger('admin_id')->nullable();
            $table->foreign('admin_id')
                ->references('id')->on('admins')
                ->onDelete('cascade');

            $table->timestamp('time_issued');
            $table->string('customer_email');
            $table->string('customer_name');
            $table->string('customer_streetaddress');
            $table->string('customer_streetaddresstwo')->nullable();
            $table->string('customer_city');
            $table->string('customer_state_province');
            $table->string('customer_country');
            $table->string('customer_postalcode');
            $table->string('customer_name_on_card');
            $table->double('subtotal');
            $table->double('tax');
            $table->double('total');
            $table->double('commission');
            $table->boolean('shipped')->default('false');
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
        Schema::dropIfExists('dish_invoice');
        Schema::dropIfExists('invoices');
    }
}
