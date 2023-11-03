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
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('voivodeship_id')->constrained('voivodeships')->onDelete('cascade');
            $table->string('name', 16);
            $table->timestamps();
        });
        
        $this->insertDefaultData();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
    protected function insertDefaultData()
    {
        DB::table('cities')->insert([
            ['voivodeship_id' => 1, 'name' => 'lublin', 'created_at' => now(), 'updated_at' => now()],
            ['voivodeship_id' => 1, 'name' => 'zamosc', 'created_at' => now(), 'updated_at' => now()],
            ['voivodeship_id' => 1, 'name' => 'chelm', 'created_at' => now(), 'updated_at' => now()],
            ['voivodeship_id' => 1, 'name' => 'biala podlaska', 'created_at' => now(), 'updated_at' => now()],
            ['voivodeship_id' => 1, 'name' => 'pulawy', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
};
