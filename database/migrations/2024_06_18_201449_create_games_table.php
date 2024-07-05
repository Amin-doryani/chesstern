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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("idp1");
            $table->foreign('idp1')->references('id')->on('players');
            $table->unsignedBigInteger("idp2");
            $table->foreign('idp2')->references('id')->on('players');
            $table->unsignedBigInteger("idter");
            $table->foreign('idter')->references('id')->on('tournaments');
            $table->string("pgn");
            $table->string('round');
            $table->integer("res");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
