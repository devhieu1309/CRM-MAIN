<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UserPageTest extends TestCase {
    use RefreshDatabase;

    protected function setUp() : void {
        parent::setUp();

        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'delete']);

        Role::create(['name' => 'admin'])->givePermissionTo(['manage users', 'delete']);
        Role::create(['name' => 'user']);
    }

    public function test_user_without_permission_cannot_see_user_page() {
        $user = User::factory()->create();
        $user->assignRole('user');

        $response = $this->actingAs($user)->get('/users');

        $response->assertStatus(403);
    }

    public function test_user_with_permission_can_see_user_page() {
        $user = User::factory()->create();
        $user->assignRole('admin');

        $response = $this->actingAs($user)->get('/users');

        $response->assertStatus(200);
    }
}
