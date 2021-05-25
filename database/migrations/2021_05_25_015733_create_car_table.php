<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_type_id');
            $table->string('merk')->nullable();
            $table->string('no_plat', 20)->nullable();
            $table->string('color', 20)->nullable();
            $table->integer('year')->nullable();
            $table->boolean('status')->nullable()->default(true);
            $table->string('image')->nullable();
            $table->integer('price')->nullable();
            $table->integer('fine')->nullable();
            $table->foreign('car_type_id')
                ->references('id')
                ->on('car_type')
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
        Schema::dropIfExists('cars');
    }
}