<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantProtectionProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plant_protection_products', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name');
            $table->date('sale_deadline');              //termin do sprzedaży
            $table->date('term_for_use');               //termin do użytku
            $table->string('type');                       //rodzaj
            $table->string('active_substance');          //substancja czynna
            $table->string('plant')->nullable();         //uprawa
            $table->string('pest')->nullable();          //agrofag
            $table->string('dose')->nullable();         //dawka
            $table->string('deadline')->nullable();     //termin
            $table->string('group_name');                //nazwa grupy
            $table->string('small_area')->nullable();  //mało obszarowe
            $table->string('application')->nullable();  //zastosowanie/użytkownik
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plant_protection_product');
    }
}
