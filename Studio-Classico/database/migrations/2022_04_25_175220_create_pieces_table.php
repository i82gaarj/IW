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
        Schema::create('pieces', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->bigInteger("user_id")->unsigned();
            $table->string("author");
            $table->integer("year");
            $table->integer("duration");
            $table->string("type");
            $table->string("file_name");
            $table->integer("n_downloads")->default(0);
            $table->integer("n_visits")->default(0);
            $table->foreign("user_id")->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('pieces');
    }
};
