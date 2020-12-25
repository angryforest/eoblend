<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOilDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oil_data', function (Blueprint $table) {
            $table->collation = 'utf8_general_ci';
            $table->charset = 'utf8';
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedInteger('oil_id');
            $table->enum('language', ['ru', 'en', 'de', 'fr', 'es', 'zh']);
            $table->string('name', 128)->nullable();
            $table->string('title', 128)->nullable();
            $table->string('description', 256)->nullable();
            $table->text('plant')->nullable();
            $table->text('aroma')->nullable();
            $table->text('properties')->nullable();
            $table->text('methods')->nullable();
            $table->text('contraindications')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('oil_data');
    }
}
