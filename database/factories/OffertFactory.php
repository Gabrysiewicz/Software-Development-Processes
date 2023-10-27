<?php

namespace Database\Factories;

use App\Models\Offert;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Offert>
 */
// DONT WORK FOR NOW AS INTENDEED
class OffertFactory extends Factory
{
    public function definition(): array
    {    
        return [
            'user_id' => 1,
            'name' => Str::random(10),
            'surname' => Str::random(10),
            'profession' => Str::random(10),
            'workplace' => Str::random(10),
            'voivodeship' => Str::random(10),
            'city' => Str::random(10)
            // 'company' => $faker->optional(0.5)->company, // Nullable 50% of the time
            // 'youtube' => $faker->optional(0.2)->url, // Nullable 20% of the time
            // 'facebook' => $faker->optional(0.2)->url, // Nullable 20% of the time
            // 'instagram' => $faker->optional(0.2)->userName, // Nullable 20% of the time
            // 'tiktok' => $faker->optional(0.2)->userName, // Nullable 20% of the time
            // 'twitter' => $faker->optional(0.2)->userName, // Nullable 20% of the time
            // 'description' => $faker->optional(0.5)->text, // Nullable 50% of the time
        ];
    }
};