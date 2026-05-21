<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase {
    use RefreshDatabase;

    public function test_guest_redirected_to_the_login_page() {
        $this->get('/dashboard')->assertRedirect('/login');
    }
    
    public function test_authenticated_users_can_visit_the_dashboard() {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
    }
}