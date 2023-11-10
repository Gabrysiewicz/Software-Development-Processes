<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Offert;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ValidationEditTest extends TestCase
{
    protected $user;
    protected $offert;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->offert = Offert::create([
            'user_id' => $this->user->id,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'city_id' => 1,
            'company' => 'Barber 44',
            'professions' => [1],
            'workplaces' => [1],
            'profile_picture' => 'profile_pictures/test_picture.jpg'
        ]);
    }
    // PUT: /offerts/{id}
    public function test_authenticated_user_cannot_edit_offert_without_name()
    {
        $data = [
            // 'first_name' => 'Jone',
            'last_name' => 'Doe',
            'city_id' => 1,
            'company' => 'Barber 44',
            'professions' => [1],
            'workplaces' => [1],
            'profile_picture' => 'profile_pictures/test_picture.jpg'
        ];
        
        $response = $this->actingAs($this->user)->put("/offerts/{$this->offert->id}", $data);
        $response->assertSessionHasErrors(['first_name']);
    }
    public function test_authenticated_user_cannot_edit_offert_without_surname()
    { 
        $data = [
            'first_name' => 'Jone',
            // 'last_name' => 'Doe',
            'city_id' => 1,
            'company' => 'Barber 44',
            'professions' => [1],
            'workplaces' => [1],
            'profile_picture' => 'profile_pictures/test_picture.jpg'
        ];
        
        $response = $this->actingAs($this->user)->put("/offerts/{$this->offert->id}", $data);
        $response->assertSessionHasErrors(['last_name']);
    }
    public function test_authenticated_user_cannot_edit_offert_without_city()
    {
        $data = [
            'first_name' => 'Jone',
            'last_name' => 'Doe',
            // 'city_id' => 1,
            'company' => 'Barber 44',
            'professions' => [1],
            'workplaces' => [1],
            'profile_picture' => 'profile_pictures/test_picture.jpg'
        ];
        
        $response = $this->actingAs($this->user)->put("/offerts/{$this->offert->id}", $data);
        $response->assertSessionHasErrors(['city_id']);
    }
    public function test_authenticated_user_cannot_edit_offert_without_profession()
    {
        $data = [
            'first_name' => 'Jone',
            'last_name' => 'Doe',
            'city_id' => 1,
            'company' => 'Barber 44',
            // 'professions' => [1],
            'workplaces' => [1],
            'profile_picture' => 'profile_pictures/test_picture.jpg'
        ];
        
        $response = $this->actingAs($this->user)->put("/offerts/{$this->offert->id}", $data);
        $response->assertSessionHasErrors(['professions']);
    }
    public function test_authenticated_user_cannot_edit_offert_without_workplace()
    {
        $data = [
            'first_name' => 'Jone',
            'last_name' => 'Doe',
            'city_id' => 1,
            'company' => 'Barber 44',
            'professions' => [1],
            // 'workplaces' => [1],
            'profile_picture' => 'profile_pictures/test_picture.jpg'
        ];
        
        $response = $this->actingAs($this->user)->put("/offerts/{$this->offert->id}", $data);
        $response->assertSessionHasErrors(['workplaces']);
    }
}
