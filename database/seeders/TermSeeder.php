<?php

namespace Database\Seeders;

use App\Models\Term;
use App\Models\SchoolSession;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // First, ensure we have school sessions
        $sessions = [
            ['sessionName' => '2023/2024', 'status' => 'inactive'],
            ['sessionName' => '2024/2025', 'status' => 'active'],
            ['sessionName' => '2025/2026', 'status' => 'inactive'],
        ];

        foreach ($sessions as $session) {
            SchoolSession::firstOrCreate(
                ['sessionName' => $session['sessionName']],
                $session
            );
        }

        // Get the current active session
        $currentSession = SchoolSession::where('status', 'active')->first();
        $previousSession = SchoolSession::where('sessionName', '2023/2024')->first();

        $terms = [
            // Previous Session Terms (2023/2024)
            [
                'session_id' => $previousSession->id,
                'name' => 'First Term',
                'startDate' => Carbon::create(2023, 9, 11),
                'endDate' => Carbon::create(2023, 12, 15),
                'status' => 'inactive'
            ],
            [
                'session_id' => $previousSession->id,
                'name' => 'Second Term',
                'startDate' => Carbon::create(2024, 1, 8),
                'endDate' => Carbon::create(2024, 4, 12),
                'status' => 'inactive'
            ],
            [
                'session_id' => $previousSession->id,
                'name' => 'Third Term',
                'startDate' => Carbon::create(2024, 4, 29),
                'endDate' => Carbon::create(2024, 7, 26),
                'status' => 'inactive'
            ],

            // Current Session Terms (2024/2025)
            [
                'session_id' => $currentSession->id,
                'name' => 'First Term',
                'startDate' => Carbon::create(2024, 9, 9),
                'endDate' => Carbon::create(2024, 12, 20),
                'status' => 'active'
            ],
            [
                'session_id' => $currentSession->id,
                'name' => 'Second Term',
                'startDate' => Carbon::create(2025, 1, 6),
                'endDate' => Carbon::create(2025, 4, 11),
                'status' => 'inactive'
            ],
            [
                'session_id' => $currentSession->id,
                'name' => 'Third Term',
                'startDate' => Carbon::create(2025, 4, 28),
                'endDate' => Carbon::create(2025, 7, 25),
                'status' => 'inactive'
            ],
        ];

        foreach ($terms as $term) {
            Term::firstOrCreate(
                [
                    'session_id' => $term['session_id'],
                    'name' => $term['name']
                ],
                $term
            );
        }

        $this->command->info('Terms seeded successfully!');
    }
}