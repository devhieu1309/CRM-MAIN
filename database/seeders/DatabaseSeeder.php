<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::firstOrCreate(['name' => 'manage users']);
        Permission::firstOrCreate(['name' => 'delete']);

        Role::firstOrCreate(['name' => 'admin'])->givePermissionTo(['manage users', 'delete']);
        Role::firstOrCreate(['name' => 'user']);

        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'terms_accepted_at' => now()
        ]);
        $admin->assignRole('admin');

        $user = User::factory()->create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'terms_accepted_at' => now()
        ]);
        $user->assignRole('user');
    
        $this->call(UserSeeder::class); 
    }
}
