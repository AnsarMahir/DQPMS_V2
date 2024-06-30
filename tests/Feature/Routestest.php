<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class Routestest extends TestCase
{
    use RefreshDatabase;
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_home_screen_shows_welcome()
    {
        $response = $this->get('/');
        $response->assertViewIs('welcome');

    }
    

    /** @test */
    public function dashboard_route_redirects_to_login_if_not_authenticated()
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect('/login');
    }

    /** @test */
    public function dashboard_route_redirects_to_verification_if_not_verified()
    {
        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertRedirect('/verify-email');
    }

    /** @test */
    public function dashboard_route_loads_for_authenticated_and_verified_user()
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertViewIs('dashboard');
    }
    public function testCallNonAvailableRoute()
    {
        // Simulate a POST request to the showPaperDetails method without session data
        $response = $this->post('/paperdetails');

        // Assert the view is rendered correctly
        $response->assertStatus(404);
    }
}
