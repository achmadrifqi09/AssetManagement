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
        Schema::create('distributions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id');
            $table->foreignId('supervisor_id');
            $table->foreignId('finance_and_assets_subsection_id'); 
            $table->foreignId('user_item_manager_id');
            $table->text('necessity');
            $table->string('reference_number');
            $table->date('date');
            $table->string('text_date');
            $table->integer('used_item');
            $table->string('text_used_item');
            $table->string('description');
            $table->string('field')->nullable();
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
        Schema::dropIfExists('distributions');
    }
};
