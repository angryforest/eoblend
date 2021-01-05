<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_views', function (Blueprint $table) {
            $table->collation = 'utf8_general_ci';
            $table->charset = 'utf8';
            $table->id();
            $table->timestamps();

            $table->string('url');
            $table->string('ip');
            $table->string('agent');
            $table->integer('time')->default(0);
            $table->string('referer')->nullable();
            $table->boolean('internal')->default(false);
            $table->boolean('mobile')->default(false);
            $table->unsignedInteger('user_id')->nullable();
            $table->enum('language', ['ru', 'en', 'de', 'fr', 'es', 'zh']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_views');
    }
}
