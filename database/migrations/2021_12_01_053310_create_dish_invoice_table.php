<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDishInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dish_invoice', function (Blueprint $table) {
            
            $table->id();
            $table->unsignedBigInteger("invoice_id");
            $table->unsignedBigInteger("dish_id");

            $table->foreign('invoice_id')
                ->references('id')->on('invoices')
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
        Schema::dropIfExists('dish_invoice');
    }
}
