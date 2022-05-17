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
        Schema::create('pieces_instruments', function (Blueprint $table) {
            $table->bigInteger('piece_id')->unsigned();
            $table->bigInteger('instrument_id')->unsigned();
            $table->integer('count')->unsigned()->default(1);
            $table->foreign('piece_id')->references('id')->on('pieces')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('instrument_id')->references('id')->on('instruments')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('pieces_instruments');
    }
};
