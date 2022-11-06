<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instances_zones', function (Blueprint $table) {
            $table->bigIncrements('id');        
            $table->unsignedBigInteger('instance_id');
            $table->unsignedBigInteger('zone_id');
            $table->boolean('active_zone')->default(false);
            $table->timestamps();
        });

        Schema::table('instances_zones', function($table) {
            $table->foreign('zone_id')
                  ->references('id')
                  ->on('zones')->onDelete('cascade');   
            $table->foreign('instance_id')
                  ->references('id')
                  ->on('instances')->onDelete('cascade');
                  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instances_zones');
    }
};
