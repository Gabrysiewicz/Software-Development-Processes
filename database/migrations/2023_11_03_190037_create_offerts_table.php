<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('offerts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('profile_picture')->nullable();
            // $table->string('profession');
            // $table->string('workplace');
            $table->unsignedBigInteger('city_id');
            // $table->unsignedBigInteger('profession_id');
            // $table->unsignedBigInteger('workplace_id');
            $table->string('company')->nullable();
            $table->string('youtube')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('twitter')->nullable();
            $table->longText('description')->nullable();

            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            // $table->foreign('profession_id')->references('id')->on('offert_profession')->onDelete('cascade');
            // $table->foreign('workplace_id')->references('id')->on('offert_workplace')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offerts');
    }
};
