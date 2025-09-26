<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class CreateTestUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-test-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create test users with different roles for testing';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Creating test users...');

        $testUsers = [
            [
                'name' => 'Admin User',
                'email' => 'admin@test.com',
                'role' => 'admin'
            ],
            [
                'name' => 'Manager User',
                'email' => 'manager@test.com',
                'role' => 'manager'
            ],
            [
                'name' => 'Teacher User',
                'email' => 'teacher@test.com',
                'role' => 'teacher'
            ],
            [
                'name' => 'Guardian User',
                'email' => 'guardian@test.com',
                'role' => 'guardian'
            ]
        ];

        foreach ($testUsers as $userData) {
            // Check if user already exists
            if (User::where('email', $userData['email'])->exists()) {
                $this->warn("User {$userData['email']} already exists. Skipping...");
                continue;
            }

            // Create user
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => Hash::make('password'), // Default password for all test users
            ]);

            // Assign role
            $role = Role::where('name', $userData['role'])->first();
            if ($role) {
                $user->assignRole($role);
                $user->syncUserRole();
                $this->info("Created {$userData['role']}: {$userData['email']} (password: password)");
            } else {
                $this->error("Role '{$userData['role']}' not found for user {$userData['email']}");
            }
        }

        $this->info('Test users created successfully!');
    }
}
