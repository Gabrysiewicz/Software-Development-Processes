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
        Schema::create('offert_profession', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('offert_id');
            $table->unsignedBigInteger('profession_id');
            $table->timestamps();

            $table->foreign('offert_id')->references('id')->on('offerts')->onDelete('cascade');
            $table->foreign('profession_id')->references('id')->on('professions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offert_profession');
    }
};
