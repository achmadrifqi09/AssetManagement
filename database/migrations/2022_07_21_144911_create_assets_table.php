<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('item_category');
            $table->string('item_code');
            $table->foreignId('distribution_id')->nullable();
            $table->string('registration')->nullable();
            $table->string('item_name');
            $table->string('brand')->nullable();
            $table->string('certification_number')->nullable();
            $table->text('ingredient')->nullable();
            $table->string('how_to_earn');
            $table->integer('item_year');
            $table->string('item_size')->nullable();
            $table->string('item_condition')->nullable();
            $table->string('unit')->nullable();
            $table->integer('total');
            $table->string('price');
            $table->string('physical_evidence')->nullable();
            $table->string('file_bast')->nullable();
            $table->text('description')->nullable();
            $table->integer('used');
            $table->text('spesification')->nullable();
            $table->string('creator')->nullable();
            $table->string('title')->nullable();
            $table->string('location')->nullable();
            $table->string('user')->nullable();
            $table->string('internal_code');
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
        Schema::dropIfExists('assets');
    }
};
