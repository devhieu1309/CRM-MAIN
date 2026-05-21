<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileUpdateTest extends TestCase {
    use RefreshDatabase;

    public function test_profile_page_is_displayed() {
        $this->actingAs(User::factory()->create())->get('/profile')->assertOk();
    }

    public function test_user_can_update_profile_information() {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
        ->from('/profile')
        ->patch('/profile', [
            'name' => 'Test User',
            'email' => 'test@gmail.com'
        ]);

        $response->assertSessionHasNoErrors()->assertRedirect('/profile');

        $user->refresh();
        $this->assertSame('Test User', $user->name);
        $this->assertSame('test@gmail.com', $user->email);
        $this->assertNull($user->email_verified_at);
    }

    public function test_email_verification_status_is_unchange_when_the_email_address_is_unchanged() {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
        ->from('/profile')
        ->patch('/profile', [
            'name' => 'Test User',
            'email' => $user->email
        ]);

        $response->assertSessionHasNoErrors()->assertRedirect('/profile');

        $this->assertNotNull($user->refresh()->email_verified_at);
    }
}
