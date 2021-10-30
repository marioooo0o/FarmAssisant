<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePractiseProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('practise_plant_protection_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('practise_id');
            $table->unsignedBigInteger('plant_protection_product_id');
            
            $table->foreign('practise_id')
                    ->references('id')
                    ->on('agricultural_practices')
                    ->onDelete('cascade');
            $table->foreign('plant_protection_product_id', 'ppp_id_foreign')
                    ->references('id')
                    ->on('plant_protection_products')
                    ->onDelete('cascade');
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
        
        Schema::dropIfExists('practise_product');
        
    }
}
