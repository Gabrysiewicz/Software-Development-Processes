<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GuestTest extends TestCase
{
    use RefreshDatabase;
    //==== Route
    // Route::get('/register', [UserController::class, 'create'])->middleware('guest');
    // @Guest
    public function test_guest_user_can_access_register(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }
    // @Auth
    public function test_authenticated_user_can_access_register(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/register');

        $response->assertRedirect('/home');
    }
    //==== Route
    // Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
    // @Guest
    public function test_guest_user_can_access_login(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }
    // @Auth
    public function test_authenticated_user_can_access_login(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/login');

        $response->assertRedirect('/home');
    }
}
