<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ValidationCreateTest extends TestCase
{
    protected $user;
    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }
    // POST: /offerts
    public function test_authenticated_user_cannot_create_offert_without_first_name()
    {
        // $user = User::factory()->create();
    
        $data = [
            'last_name' => 'Doe',
            'city_id' => 1,
            'company' => 'Barber 44',
            'professions' => [1],
            'workplaces' => [1],
            'profile_picture' => 'profile_pictures/test_picture.jpg'
        ];
        
        $response = $this->actingAs($this->user)->post('/offerts', $data);
        
        $response->assertSessionHasErrors(['first_name']);
    }
    public function test_authenticated_user_cannot_create_offert_without_last_name()
    {
        // $user = User::factory()->create();
        
        $data = [
            'first_name' => 'Jone',
            // Missing 'last_name' field
            'city_id' => 1,
            'company' => 'Barber 44',
            'professions' => [1],
            'workplaces' => [1],
            'profile_picture' => 'profile_pictures/test_picture.jpg'
        ];
        
        $response = $this->actingAs($this->user)->post('/offerts', $data);
        
        $response->assertSessionHasErrors(['last_name']);
    }
    public function test_authenticated_user_cannot_create_offert_without_city()
    {
        // $user = User::factory()->create();
        
        $data = [
            'first_name' => 'Jone',
            'last_name' => 'Doe',
            // 'city_id' => 1,
            'company' => 'Barber 44',
            'professions' => [1],
            'workplaces' => [1],
            'profile_picture' => 'profile_pictures/test_picture.jpg'
        ];
        
        $response = $this->actingAs($this->user)->post('/offerts', $data);
        
        $response->assertSessionHasErrors(['city_id']);
    }
    public function test_authenticated_user_cannot_create_offert_without_professions()
    {
        // $user = User::factory()->create();
        
        $data = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'city_id' => 1,
            'company' => 'Barber 44',
            // 'professions' => [1],
            'workplaces' => [1],
            'profile_picture' => 'profile_pictures/test_picture.jpg'
        ];
        
        $response = $this->actingAs($this->user)->post('/offerts', $data);
        
        $response->assertSessionHasErrors(['professions']);
    }
    public function test_authenticated_user_cannot_create_offert_without_workplaces()
    {
        // $user = User::factory()->create();
        
        $data = [
            'first_name' => 'Jone',
            'last_name' => 'Doe',
            'city_id' => 1,
            'company' => 'Barber 44',
            'professions' => [1],
            // 'workplaces' => [1],
            'profile_picture' => 'profile_pictures/test_picture.jpg'
        ];
        
        $response = $this->actingAs($this->user)->post('/offerts', $data);
        
        $response->assertSessionHasErrors(['workplaces']);
    }
}
