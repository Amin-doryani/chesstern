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
        Schema::create('byes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("idp");
            $table->unsignedBigInteger("idter");
            $table->unsignedBigInteger("idround");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('byes');
    }
};
