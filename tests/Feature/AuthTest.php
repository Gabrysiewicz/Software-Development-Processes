<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Offert;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    //=== Route
    // Route::get('/offerts/create', [OffertController::class, 'create'])->middleware('auth');
    // @Auth
    public function test_authenticated_user_can_create_offert(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/offerts/create');

        $response->assertStatus(200);
    }
    // @Guest
    public function test_unauthenticated_user_can_create_offert(): void
    {
        $response = $this->get('/offerts/create');
        $response->assertRedirect('/login');
    }
    //=== Route
    // Route::post('/offerts', [OffertController::class, 'store'])->middleware('auth');
    // @Auth
    public function test_authenticated_user_can_store_offert(){
        // Create an authenticated user
        $user = User::factory()->create();
        $this->actingAs($user);

        // Simulate creating an offert
        $response = $this->post('/offerts', [
            'name' => 'John',
            'surname' => 'Doe',
            'voivodeship' => 'Lubelskie',
            'city' => 'Lublin',
            'company' => 'Barber 44',
            'profession' => 'Barber',
            'workplace' => 'Salon'
        ]);

        // Assert the response
        $response->assertRedirect('/')->with('message', 'Your offert has been added.');

        // Optional: Check if the offert was saved in the database
        $this->assertDatabaseHas('offerts', [
            'name' => 'John',
            'surname' => 'Doe',
            'voivodeship' => 'Lubelskie',
            'city' => 'Lublin',
            'company' => 'Barber 44',
            'profession' => 'Barber',
            'workplace' => 'Salon'
        ]);
    }
    // @Guest
    public function test_unauthenticated_user_can_store_offert(){
        // Simulate creating an offert
        $response = $this->post('/offerts', [
            'name' => 'John',
            'surname' => 'Doe',
            'voivodeship' => 'Lubelskie',
            'city' => 'Lublin',
            'company' => 'Barber 44',
            'profession' => 'Barber',
            'workplace' => 'Salon'
        ]);

        // Assert the response
        $response->assertRedirect('/login');

        // Optional: Check if the offert was saved in the database
        $this->assertDatabaseMissing('offerts', [
            'name' => 'John',
            'surname' => 'Doe',
            'voivodeship' => 'Lubelskie',
            'city' => 'Lublin',
            'company' => 'Barber 44',
            'profession' => 'Barber',
            'workplace' => 'Salon'
        ]);
    }
    //=== Route
    // Route::get('/offerts/{offert}/edit', [OffertController::class, 'edit'])->middleware('auth');
    // @Auth
    public function test_authenticated_user_can_edit_offert(){
        // Create an authenticated user
        $user = User::factory()->create();
        $this->actingAs($user);

        // Simulate accessing the edit route for a specific offert
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
        $response = $this->get("/offerts/{$offert->id}/edit");

        // Assert the response
        $response->assertStatus(200);
    }
    // @Guest
    public function test_unauthenticated_user_can_edit_offert(){
        $randId = rand(1, 100);
        $response = $this->get("/offerts/{$randId}/edit");
        // Assert the response
        $response->assertRedirect('/login');
    }
    //=== Route
    // Route::put('/offerts/{offert}', [OffertController::class, 'update'])->middleware('auth');
    // @Auth
    public function test_authenticated_user_can_update_offert()
    {
        // Create an authenticated user
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create an offert owned by the authenticated user
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
        
        // Simulate making a PUT request to update the offert
        $response = $this->put("/offerts/{$offert->id}", [
            'name' => 'Juliusz',
            'surname' => 'Słowacki',
            'voivodeship' => 'Lubelskie',
            'city' => 'Lublin',
            'company' => 'Barber 44',
            'profession' => 'Barber',
            'workplace' => 'Salon'
        ]);

        // Assert the response
        $response->assertStatus(302); // Adjust the expected status code
    }
    // @Guest
    public function test_unauthenticated_user_can_update_offert()
    {
        $randId = rand(1, 100);
        // Simulate making a PUT request to update the offert
        $response = $this->put("/offerts/{$randId}");

        // Assert the response
        $response->assertRedirect('/login');
    }
    //=== Route
    // Route::get('/offerts/manage', [OffertController::class, 'manage'])->middleware('auth');
    // @Auth
    public function test_authenticated_user_can_access_menage(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/offerts/manage');

        $response->assertStatus(200);
    }
    // @Guest
    public function test_unauthenticated_user_can_access_menage(): void
    {
        $response = $this->get('/offerts/manage');

        $response->assertRedirect('/login');
    }
    //=== Route
    // Route::delete('/offerts/{offert}', [OffertController::class, 'delete'])->middleware('auth');
    // @Auth
    public function test_authenticated_user_can_delete_offert(): void
    {
        // Create an authenticated user
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create an offert owned by the authenticated user
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

        // Simulate making a DELETE request to delete the offert
        $response = $this->delete("/offerts/{$offert->id}");

        // Assert the response
        $response->assertStatus(302); 
    }
    // @Guest
    public function test_unauthenticated_user_can_delete_offert(): void
    {
        // Create an offert owned by the authenticated user
        $randId = rand(1,100);

        // Simulate making a DELETE request to delete the offert
        $response = $this->delete("/offerts/{$randId}");

        // Assert the response
        $response->assertRedirect('/login');
        $response->assertStatus(302); 
    }
    //=== Route
    // Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');
    // @Auth
    public function test_authenticated_user_can_logout(): void
    {
        // Create an authenticated user
        $user = User::factory()->create();
        $this->actingAs($user);

        // Simulate making a POST request to logout the user
        $response = $this->post("/logout");

        // Assert the response
        $response->assertStatus(302); 
        $response->assertRedirect('/'); 
    }
    // @Guest
    public function test_unauthenticated_user_can_logout(): void
    {
        // Simulate making a POST request to logout the user
        $response = $this->post("/logout");

        // Assert the response
        $response->assertRedirect('/login'); 
    }
}
