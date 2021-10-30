<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgriculturalPractiseFieldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agricultural_practise_field', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agricultural_practise_id');
            $table->unsignedBigInteger('field_id');
            $table->foreign('agricultural_practise_id')
                    ->references('id')
                    ->on('agricultural_practices')
                    ->onDelete('cascade');
            $table->foreign('field_id')
                    ->references('id')
                    ->on('fields')
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
        Schema::dropIfExists('agricultural_practise_field');
    }
}
