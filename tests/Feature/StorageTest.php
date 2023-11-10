<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Offert;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class StorageTest extends TestCase
{
    public function test_delete_offert_deletes_profile_picture()
    {
        // Create an authenticated user
        $user = User::factory()->create();
        $this->actingAs($user);

        // Arrange: Create an Offert with a profile picture
        $offert = new Offert([
            'user_id' => $user->id,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'city_id' => 1,
            'company' => 'Barber 44',
            'professions' => [1],
            'workplaces' => [1],
            'profile_picture' => 'profile_pictures/test_picture.jpg'
        ]);
        $offert->save();

        // Act: Call the delete method
        $response = $this->delete("/offerts/{$offert->id}");

        // Assert: Check if the Offert was deleted from the database
        $this->assertDatabaseMissing('offerts', ['id' => $offert->id]);

        // Assert: Check if the profile picture was deleted from the storage
        Storage::disk('public')->assertMissing($offert->profile_picture);
        
        // Optional: Check the response status and redirection
        $response->assertRedirect('/offerts/manage');
    }
}
