<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMagazinePlantProtectionProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('magazine_plant_protection_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('magazine_id');
            $table->unsignedBigInteger('plant_protection_product_id');
            $table->float('quantity');
            $table->timestamps();
            $table->foreign('magazine_id')
                    ->references('id')
                    ->on('magazines')
                    ->onDelete('cascade');
            $table->foreign('plant_protection_product_id', 'ppp_id')
                    ->references('id')
                    ->on('plant_protection_products')
                    ->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('magazine_plant_protection_product');
   
        
    }
}
