<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Offert;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ValidationEditTest extends TestCase
{
    // PUT: /offerts/{id}
    public function test_authenticated_user_cannot_edit_offert_without_name()
    {
        $user = User::factory()->create();
        $offert = new Offert([
            'user_id' => $user->id,
            'name' => 'John',
            'surname' => 'Doe',
            'voivodeship' => 'Lubelskie',
            'city' => 'Lublin',
            'company' => 'Barber 44',
            'profession' => 'Barber',
            'workplace' => 'Salon'
        ]);
        $offert->save();
        
        $data = [
            // Missing 'name' field
            'surname' => 'Doe',
            'voivodeship' => 'Lubelskie',
            'city' => 'Lublin',
            'company' => 'Barber 44',
            'profession' => 'Barber',
            'workplace' => 'Salon',
        ];
        
        $response = $this->actingAs($user)->put("/offerts/{$offert->id}", $data);
        $response->assertSessionHasErrors(['name']);
    }
    public function test_authenticated_user_cannot_edit_offert_without_surname()
    {
        $user = User::factory()->create();
        $offert = new Offert([
            'user_id' => $user->id,
            'name' => 'John',
            'surname' => 'Doe',
            'voivodeship' => 'Lubelskie',
            'city' => 'Lublin',
            'company' => 'Barber 44',
            'profession' => 'Barber',
            'workplace' => 'Salon'
        ]);
        $offert->save();
        
        $data = [
            'name' => 'Jon',
            // Missing 'surname' field
            'voivodeship' => 'Lubelskie',
            'city' => 'Lublin',
            'company' => 'Barber 44',
            'profession' => 'Barber',
            'workplace' => 'Salon',
        ];
        $response = $this->actingAs($user)->put("/offerts/{$offert->id}", $data);
        $response->assertSessionHasErrors(['surname']);
    }
    public function test_authenticated_user_cannot_edit_offert_without_voivodeship()
    {
        $user = User::factory()->create();
        $offert = new Offert([
            'user_id' => $user->id,
            'name' => 'John',
            'surname' => 'Doe',
            'voivodeship' => 'Lubelskie',
            'city' => 'Lublin',
            'company' => 'Barber 44',
            'profession' => 'Barber',
            'workplace' => 'Salon'
        ]);
        $offert->save();
        
        $data = [
            'name' => 'Jon',
            'surname' => 'Doe',
            // Missing 'voivodeship' field
            'city' => 'Lublin',
            'company' => 'Barber 44',
            'profession' => 'Barber',
            'workplace' => 'Salon',
        ];
        
        $response = $this->actingAs($user)->put("/offerts/{$offert->id}", $data);
        $response->assertSessionHasErrors(['voivodeship']);
    }
    public function test_authenticated_user_cannot_edit_offert_without_city()
    {
        $user = User::factory()->create();
        $offert = new Offert([
            'user_id' => $user->id,
            'name' => 'John',
            'surname' => 'Doe',
            'voivodeship' => 'Lubelskie',
            'city' => 'Lublin',
            'company' => 'Barber 44',
            'profession' => 'Barber',
            'workplace' => 'Salon'
        ]);
        $offert->save();

        $data = [
            'name' => 'Jon',
            'surname' => 'Doe',
            'voivodeship' => 'Lubelskie',
            // Missing 'city' field
            'company' => 'Barber 44',
            'profession' => 'Barber',
            'workplace' => 'Salon',
        ];
        
        $response = $this->actingAs($user)->put("/offerts/{$offert->id}", $data);
        $response->assertSessionHasErrors(['city']);
    }
    public function test_authenticated_user_cannot_edit_offert_without_profession()
    {
        $user = User::factory()->create();
        $offert = new Offert([
            'user_id' => $user->id,
            'name' => 'John',
            'surname' => 'Doe',
            'voivodeship' => 'Lubelskie',
            'city' => 'Lublin',
            'company' => 'Barber 44',
            'profession' => 'Barber',
            'workplace' => 'Salon'
        ]);
        $offert->save();

        $data = [
            'name' => 'Jon',
            'surname' => 'Doe',
            'voivodeship' => 'Lubelskie',
            'city' => 'Lublin',
            'company' => 'Barber 44',
            // Missing 'profession' field
            'workplace' => 'Salon',
        ];
        
        $response = $this->actingAs($user)->put("/offerts/{$offert->id}", $data);
        $response->assertSessionHasErrors(['profession']);
    }
    public function test_authenticated_user_cannot_edit_offert_without_workplace()
    {
        $user = User::factory()->create();
        $offert = new Offert([
            'user_id' => $user->id,
            'name' => 'John',
            'surname' => 'Doe',
            'voivodeship' => 'Lubelskie',
            'city' => 'Lublin',
            'company' => 'Barber 44',
            'profession' => 'Barber',
            'workplace' => 'Salon'
        ]);
        $offert->save();

        $data = [
            'name' => 'Jon',
            'surname' => 'Doe',
            'voivodeship' => 'Lubelskie',
            'city' => 'Lublin',
            'company' => 'Barber 44',
            'profession' => 'Barber'
            // Missing 'workplace' field
        ];
        
        $response = $this->actingAs($user)->put("/offerts/{$offert->id}", $data);
        
        $response->assertSessionHasErrors(['workplace']);
    }
}
