<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TermsAcceptedTest extends TestCase {
    use RefreshDatabase;

    public function test_user_without_terms_accepted_cannot_see_any_page() {
        $user = User::factory()->create([
            'terms_accepted_at' => null
        ]);

        $response = $this->actingAs($user)->get('/tasks');

        $response->assertStatus(302);

        $response->assertRedirect('/terms');

        $response = $this->actingAs($user)->get('/projects');

        $response->assertStatus(302);

        $response->assertRedirect('/terms');
    }
}
