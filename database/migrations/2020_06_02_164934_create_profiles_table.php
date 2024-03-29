<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            
            $table->bigIncrements('id');
			$table->unsignedBigInteger('user_id');
			
			$table->foreign('user_id')
				->references('id')->on('users')
				->onDelete('cascade');
			
			$table->text('description')->nullable();
			$table->json('billing_address')->nullable();
			$table->json('shipping_address')->nullable();
            $table->timestamps();
			
			// Add an index to any foreign id in our table
			// for performance purposes.
			$table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
