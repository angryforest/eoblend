<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecificationsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('specifications', function (Blueprint $table) {
            $table->collation = 'utf8_general_ci';
            $table->charset = 'utf8';
            $table->increments('id');

            $table->unsignedInteger('oil_id');
            $table->enum('language', ['eng', 'rus']);
            $table->string('title', 128)->nullable();
            $table->string('description', 256)->nullable();
            $table->text('plant')->nullable();
            $table->text('aroma')->nullable();
            $table->text('properties')->nullable();
            $table->text('methods')->nullable();
            $table->text('contraindications')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('specifications');
    }
}
