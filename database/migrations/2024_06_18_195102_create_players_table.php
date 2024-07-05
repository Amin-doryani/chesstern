<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("idUtili");
            $table->foreign('idUtili')->references('id')->on('utilisateurs');
            $table->unsignedBigInteger("idter");
            $table->foreign('idter')->references('id')->on('tournaments');
            $table->string("name");
            $table->string("username");
            $table->integer("elo");
            $table->date("date");
            $table->string("iamge");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
