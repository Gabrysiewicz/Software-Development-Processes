<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ValidationCreateTest extends TestCase
{
    // POST: /offerts
    public function test_authenticated_user_cannot_create_offert_without_name()
    {
        $user = User::factory()->create();
        
        $data = [
            // Missing 'name' field
            'surname' => 'Doe',
            'voivodeship' => 'Lubelskie',
            'city' => 'Lublin',
            'company' => 'Barber 44',
            'profession' => 'Barber',
            'workplace' => 'Salon',
        ];
        
        $response = $this->actingAs($user)->post('/offerts', $data);
        
        $response->assertSessionHasErrors(['name']);
    }
    public function test_authenticated_user_cannot_create_offert_without_surname()
    {
        $user = User::factory()->create();
        
        $data = [
            'name' => 'Jon',
            // Missing 'surname' field
            'voivodeship' => 'Lubelskie',
            'city' => 'Lublin',
            'company' => 'Barber 44',
            'profession' => 'Barber',
            'workplace' => 'Salon',
        ];
        
        $response = $this->actingAs($user)->post('/offerts', $data);
        
        $response->assertSessionHasErrors(['surname']);
    }
    public function test_authenticated_user_cannot_create_offert_without_voivodeship()
    {
        $user = User::factory()->create();
        
        $data = [
            'name' => 'Jon',
            'surname' => 'Doe',
            // Missing 'voivodeship' field
            'city' => 'Lublin',
            'company' => 'Barber 44',
            'profession' => 'Barber',
            'workplace' => 'Salon',
        ];
        
        $response = $this->actingAs($user)->post('/offerts', $data);
        
        $response->assertSessionHasErrors(['voivodeship']);
    }
    public function test_authenticated_user_cannot_create_offert_without_city()
    {
        $user = User::factory()->create();
        
        $data = [
            'name' => 'Jon',
            'surname' => 'Doe',
            'voivodeship' => 'Lubelskie',
            // Missing 'city' field
            'company' => 'Barber 44',
            'profession' => 'Barber',
            'workplace' => 'Salon',
        ];
        
        $response = $this->actingAs($user)->post('/offerts', $data);
        
        $response->assertSessionHasErrors(['city']);
    }
    public function test_authenticated_user_cannot_create_offert_without_profession()
    {
        $user = User::factory()->create();
        
        $data = [
            'name' => 'Jon',
            'surname' => 'Doe',
            'voivodeship' => 'Lubelskie',
            'city' => 'Lublin',
            'company' => 'Barber 44',
            // Missing 'profession' field
            'workplace' => 'Salon',
        ];
        
        $response = $this->actingAs($user)->post('/offerts', $data);
        
        $response->assertSessionHasErrors(['profession']);
    }
    public function test_authenticated_user_cannot_create_offert_without_workplace()
    {
        $user = User::factory()->create();
        
        $data = [
            'name' => 'Jon',
            'surname' => 'Doe',
            'voivodeship' => 'Lubelskie',
            'city' => 'Lublin',
            'company' => 'Barber 44',
            'profession' => 'Barber'
            // Missing 'workplace' field
        ];
        
        $response = $this->actingAs($user)->post('/offerts', $data);
        
        $response->assertSessionHasErrors(['workplace']);
    }
}
