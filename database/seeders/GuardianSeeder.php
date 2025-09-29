<?php

namespace Database\Seeders;

use App\Models\Guardian;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class GuardianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure guardian role exists
        $guardianRole = Role::firstOrCreate(['name' => 'guardian']);

        $guardians = [
            [
                'user' => [
                    'name' => 'Mr. John Adebayo',
                    'email' => 'john.adebayo@example.com',
                    'password' => Hash::make('password123'),
                    'userRole' => 'guardian',
                    'email_verified_at' => now(),
                ],
                'guardian' => [
                    'guardian_name' => 'Mr. John Adebayo',
                    'guardian_phone' => '+234-801-234-5678',
                    'guardian_email' => 'john.adebayo@example.com',
                    'address' => '15 Victoria Island, Lagos',
                    'nationality' => 'Nigerian',
                    'stateoforigin' => 'Lagos',
                    'lga' => 'Lagos Island',
                ]
            ],
            [
                'user' => [
                    'name' => 'Mrs. Fatima Ibrahim',
                    'email' => 'fatima.ibrahim@example.com',
                    'password' => Hash::make('password123'),
                    'userRole' => 'guardian',
                    'email_verified_at' => now(),
                ],
                'guardian' => [
                    'guardian_name' => 'Mrs. Fatima Ibrahim',
                    'guardian_phone' => '+234-802-345-6789',
                    'guardian_email' => 'fatima.ibrahim@example.com',
                    'address' => '22 Garki District, Abuja',
                    'nationality' => 'Nigerian',
                    'stateoforigin' => 'Kano',
                    'lga' => 'Kano Municipal',
                ]
            ],
            [
                'user' => [
                    'name' => 'Mr. Chinedu Okafor',
                    'email' => 'chinedu.okafor@example.com',
                    'password' => Hash::make('password123'),
                    'userRole' => 'guardian',
                    'email_verified_at' => now(),
                ],
                'guardian' => [
                    'guardian_name' => 'Mr. Chinedu Okafor',
                    'guardian_phone' => '+234-803-456-7890',
                    'guardian_email' => 'chinedu.okafor@example.com',
                    'address' => '8 New Haven, Enugu',
                    'nationality' => 'Nigerian',
                    'stateoforigin' => 'Enugu',
                    'lga' => 'Enugu East',
                ]
            ],
            [
                'user' => [
                    'name' => 'Mrs. Blessing Okoro',
                    'email' => 'blessing.okoro@example.com',
                    'password' => Hash::make('password123'),
                    'userRole' => 'guardian',
                    'email_verified_at' => now(),
                ],
                'guardian' => [
                    'guardian_name' => 'Mrs. Blessing Okoro',
                    'guardian_phone' => '+234-804-567-8901',
                    'guardian_email' => 'blessing.okoro@example.com',
                    'address' => '12 GRA Phase 2, Port Harcourt',
                    'nationality' => 'Nigerian',
                    'stateoforigin' => 'Rivers',
                    'lga' => 'Port Harcourt',
                ]
            ],
            [
                'user' => [
                    'name' => 'Mr. Ahmed Musa',
                    'email' => 'ahmed.musa@example.com',
                    'password' => Hash::make('password123'),
                    'userRole' => 'guardian',
                    'email_verified_at' => now(),
                ],
                'guardian' => [
                    'guardian_name' => 'Mr. Ahmed Musa',
                    'guardian_phone' => '+234-805-678-9012',
                    'guardian_email' => 'ahmed.musa@example.com',
                    'address' => '5 Sabon Gari, Kaduna',
                    'nationality' => 'Nigerian',
                    'stateoforigin' => 'Kaduna',
                    'lga' => 'Kaduna North',
                ]
            ],
            [
                'user' => [
                    'name' => 'Mrs. Grace Adeola',
                    'email' => 'grace.adeola@example.com',
                    'password' => Hash::make('password123'),
                    'userRole' => 'guardian',
                    'email_verified_at' => now(),
                ],
                'guardian' => [
                    'guardian_name' => 'Mrs. Grace Adeola',
                    'guardian_phone' => '+234-806-789-0123',
                    'guardian_email' => 'grace.adeola@example.com',
                    'address' => '18 Bodija Estate, Ibadan',
                    'nationality' => 'Nigerian',
                    'stateoforigin' => 'Oyo',
                    'lga' => 'Ibadan North',
                ]
            ],
            [
                'user' => [
                    'name' => 'Mr. Daniel Etim',
                    'email' => 'daniel.etim@example.com',
                    'password' => Hash::make('password123'),
                    'userRole' => 'guardian',
                    'email_verified_at' => now(),
                ],
                'guardian' => [
                    'guardian_name' => 'Mr. Daniel Etim',
                    'guardian_phone' => '+234-807-890-1234',
                    'guardian_email' => 'daniel.etim@example.com',
                    'address' => '25 Calabar Road, Uyo',
                    'nationality' => 'Nigerian',
                    'stateoforigin' => 'Akwa Ibom',
                    'lga' => 'Uyo',
                ]
            ],
            [
                'user' => [
                    'name' => 'Mrs. Kemi Adeyemi',
                    'email' => 'kemi.adeyemi@example.com',
                    'password' => Hash::make('password123'),
                    'userRole' => 'guardian',
                    'email_verified_at' => now(),
                ],
                'guardian' => [
                    'guardian_name' => 'Mrs. Kemi Adeyemi',
                    'guardian_phone' => '+234-808-901-2345',
                    'guardian_email' => 'kemi.adeyemi@example.com',
                    'address' => '10 Oke-Ado, Abeokuta',
                    'nationality' => 'Nigerian',
                    'stateoforigin' => 'Ogun',
                    'lga' => 'Abeokuta South',
                ]
            ],
        ];

        foreach ($guardians as $guardianData) {
            // Create user first
            $user = User::firstOrCreate(
                ['email' => $guardianData['user']['email']],
                $guardianData['user']
            );

            // Assign guardian role
            $user->assignRole($guardianRole);

            // Create guardian profile
            $guardianProfile = $guardianData['guardian'];
            $guardianProfile['user_id'] = $user->id;

            Guardian::firstOrCreate(
                ['user_id' => $user->id],
                $guardianProfile
            );
        }

        $this->command->info('Guardians seeded successfully!');
    }
}