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
        Schema::create('skm_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('skm_id');
            $table->unsignedBigInteger('skm_indicator_id');
            $table->float('score');
            $table->timestamps();

            $table->foreign('skm_id')->references('id')->on('skm')->onDelete('cascade');
            $table->foreign('skm_indicator_id')->references('id')->on('skm_indicators')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skm_results');
    }
};
