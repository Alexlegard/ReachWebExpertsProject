<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuperAdminProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('super_admin_profiles', function (Blueprint $table) {
            
            $table->bigIncrements('id');
			$table->unsignedBigInteger('super_admin_id');
			
			$table->foreign('super_admin_id')
				->references('id')->on('super_admins')
				->onUpdate('cascade')
				->onDelete('cascade');
				
			$table->text('description')->nullable();
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
        Schema::dropIfExists('super_admin_profiles');
    }
}
