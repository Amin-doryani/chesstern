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
        Schema::create('tournaments', function (Blueprint $table) {
            $table->id();
            $table->integer("maxplayers");
            $table->integer("rounds");
            $table->string("titel");
            $table->string("status");
            $table->datetime("startin");
            $table->datetime("reqendin");
            $table->string("desc");
            $table->string("image");
            $table->string("min");
            $table->string("sec");
            $table->unsignedBigInteger("idUtili");
            $table->foreign('idUtili')->references('id')->on('utilisateurs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournaments');
    }
};
