<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        
        $role = Role::create(['name' => 'Admin']);
        User::factory()->create([
            'username' => 'User',
            'first_name' => 'User',
            'email' => 'user@user.com',
        ]);
        $user = User::factory()->create([
            'username' => 'Admin',
            'first_name' => 'Admin',
            'email' => 'admin@admin.com',
        ]);

        $user->assignRole($role);
    }
}
