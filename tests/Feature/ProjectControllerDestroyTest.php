<?php

use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ProjectControllerDestroyTest extends TestCase {

    use RefreshDatabase;

    protected Permission $deletePermission;
    protected Role $adminRole;

    protected Role $userRole;

    protected function setUp() : void {
        $this->deletePermission = Permission::create(['name' => 'delete']);

        $this->adminRole = Role::create(['name' => 'admin']);

        $this->userRole = Role::create(['name' => 'user']);

        $this->adminRole->givePermissionTo($this->deletePermission);
    }

    public function test_admin_can_destroy_project() {
        $user = User::factory()->create();
        $user->assignRole($this->adminRole);

        $project = Project::factory()->create([
            'client_id' => Client::factory()->create(),
            'user_id' => $user->id
        ]);

        $response = $this->actingAs($user)->delete(route('projects.destroy', $project));

        $response->assertRedirect(route('projects.index'));

        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }

    public function test_user_cannot_destroy_project() {
        $user = User::factory()->create();
        $user->assignRole($this->userRole);

        $project = Project::factory()->create([
            'client_id' => Client::factory()->create(),
            'user_id' => $user->id
        ]);

        $response = $this->actingAs($user)->delete(route('projects.destroy', $project));

        $response->assertStatus(403);

        $response->assertSee('Forbidden');

        $this->assertDatabaseHas('projects', ['id' => $project->id]);
    }

    public function test_guest_cannot_destroy_project() {
        $project = Project::factory()->create([
            'client_id' => Client::factory()->create(),
            'user_id' => User::factory()->create()
        ]);

        $response = $this->delete(route('projects.destroy', $project));

        $response->assertStatus(403);

        $response->assertSee('Forbidden');

        $this->assertDatabaseHas('projects', ['id' => $project->id]);
    }
    
}
