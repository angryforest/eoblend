<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompatibilityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compatibility', function (Blueprint $table) {
            $table->collation = 'utf8_general_ci';
            $table->charset = 'utf8';
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedInteger('oil_id');
            $table->unsignedInteger('pair_oil_id');
            $table->float('compatibility')->default(1.0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compatibility');
    }
}
