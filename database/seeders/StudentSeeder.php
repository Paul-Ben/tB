<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Guardian;
use App\Models\Classroom;
use App\Models\SchoolSession;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all guardians
        $guardians = Guardian::all();
        
        // Get all classrooms
        $classrooms = Classroom::all();
        
        // Get current active session
        $currentSession = SchoolSession::where('status', 'active')->first();
        
        if ($guardians->isEmpty() || $classrooms->isEmpty() || !$currentSession) {
            $this->command->error('Please ensure guardians, classrooms, and school sessions are seeded first!');
            return;
        }

        $students = [
            // Students for Guardian 1 (Mr. John Adebayo)
            [
                'first_name' => 'Adebayo',
                'middle_name' => 'Olumide',
                'last_name' => 'John',
                'std_number' => 'STD001',
                'date_of_birth' => Carbon::create(2015, 3, 15),
                'nationality' => 'Nigerian',
                'gender' => 'Male',
                'stateoforigin' => 'Lagos',
                'lga' => 'Lagos Island',
                'genotype' => 'AA',
                'bgroup' => 'O+',
                'guardian_id' => $guardians->get(0)?->id,
                'class_id' => $classrooms->where('name', 'Primary 4A')->first()?->id,
                'current_session' => $currentSession->id,
            ],
            [
                'first_name' => 'Folake',
                'middle_name' => 'Adunni',
                'last_name' => 'John',
                'std_number' => 'STD002',
                'date_of_birth' => Carbon::create(2017, 8, 22),
                'nationality' => 'Nigerian',
                'gender' => 'Female',
                'stateoforigin' => 'Lagos',
                'lga' => 'Lagos Island',
                'genotype' => 'AA',
                'bgroup' => 'A+',
                'guardian_id' => $guardians->get(0)?->id,
                'class_id' => $classrooms->where('name', 'Primary 2A')->first()?->id,
                'current_session' => $currentSession->id,
            ],

            // Students for Guardian 2 (Mrs. Fatima Ibrahim)
            [
                'first_name' => 'Amina',
                'middle_name' => 'Khadija',
                'last_name' => 'Ibrahim',
                'std_number' => 'STD003',
                'date_of_birth' => Carbon::create(2013, 11, 5),
                'nationality' => 'Nigerian',
                'gender' => 'Female',
                'stateoforigin' => 'Kano',
                'lga' => 'Kano Municipal',
                'genotype' => 'AS',
                'bgroup' => 'B+',
                'guardian_id' => $guardians->get(1)?->id,
                'class_id' => $classrooms->where('name', 'Primary 6A')->first()?->id,
                'current_session' => $currentSession->id,
            ],

            // Students for Guardian 3 (Mr. Chinedu Okafor)
            [
                'first_name' => 'Chioma',
                'middle_name' => 'Grace',
                'last_name' => 'Okafor',
                'std_number' => 'STD004',
                'date_of_birth' => Carbon::create(2012, 6, 18),
                'nationality' => 'Nigerian',
                'gender' => 'Female',
                'stateoforigin' => 'Enugu',
                'lga' => 'Enugu East',
                'genotype' => 'AA',
                'bgroup' => 'O-',
                'guardian_id' => $guardians->get(2)?->id,
                'class_id' => $classrooms->where('name', 'JSS 1A')->first()?->id,
                'current_session' => $currentSession->id,
            ],
            [
                'first_name' => 'Emeka',
                'middle_name' => 'Joseph',
                'last_name' => 'Okafor',
                'std_number' => 'STD005',
                'date_of_birth' => Carbon::create(2014, 12, 3),
                'nationality' => 'Nigerian',
                'gender' => 'Male',
                'stateoforigin' => 'Enugu',
                'lga' => 'Enugu East',
                'genotype' => 'AA',
                'bgroup' => 'A-',
                'guardian_id' => $guardians->get(2)?->id,
                'class_id' => $classrooms->where('name', 'Primary 5A')->first()?->id,
                'current_session' => $currentSession->id,
            ],

            // Students for Guardian 4 (Mrs. Blessing Okoro)
            [
                'first_name' => 'Precious',
                'middle_name' => 'Gift',
                'last_name' => 'Okoro',
                'std_number' => 'STD006',
                'date_of_birth' => Carbon::create(2016, 4, 10),
                'nationality' => 'Nigerian',
                'gender' => 'Female',
                'stateoforigin' => 'Rivers',
                'lga' => 'Port Harcourt',
                'genotype' => 'AS',
                'bgroup' => 'AB+',
                'guardian_id' => $guardians->get(3)?->id,
                'class_id' => $classrooms->where('name', 'Primary 3A')->first()?->id,
                'current_session' => $currentSession->id,
            ],

            // Students for Guardian 5 (Mr. Ahmed Musa)
            [
                'first_name' => 'Aisha',
                'middle_name' => 'Zainab',
                'last_name' => 'Musa',
                'std_number' => 'STD007',
                'date_of_birth' => Carbon::create(2011, 9, 25),
                'nationality' => 'Nigerian',
                'gender' => 'Female',
                'stateoforigin' => 'Kaduna',
                'lga' => 'Kaduna North',
                'genotype' => 'AA',
                'bgroup' => 'B-',
                'guardian_id' => $guardians->get(4)?->id,
                'class_id' => $classrooms->where('name', 'JSS 2A')->first()?->id,
                'current_session' => $currentSession->id,
            ],
            [
                'first_name' => 'Usman',
                'middle_name' => 'Aliyu',
                'last_name' => 'Musa',
                'std_number' => 'STD008',
                'date_of_birth' => Carbon::create(2013, 1, 14),
                'nationality' => 'Nigerian',
                'gender' => 'Male',
                'stateoforigin' => 'Kaduna',
                'lga' => 'Kaduna North',
                'genotype' => 'AS',
                'bgroup' => 'O+',
                'guardian_id' => $guardians->get(4)?->id,
                'class_id' => $classrooms->where('name', 'Primary 6A')->first()?->id,
                'current_session' => $currentSession->id,
            ],

            // Students for Guardian 6 (Mrs. Grace Adeola)
            [
                'first_name' => 'Temitope',
                'middle_name' => 'Emmanuel',
                'last_name' => 'Adeola',
                'std_number' => 'STD009',
                'date_of_birth' => Carbon::create(2010, 7, 8),
                'nationality' => 'Nigerian',
                'gender' => 'Male',
                'stateoforigin' => 'Oyo',
                'lga' => 'Ibadan North',
                'genotype' => 'AA',
                'bgroup' => 'A+',
                'guardian_id' => $guardians->get(5)?->id,
                'class_id' => $classrooms->where('name', 'JSS 3A')->first()?->id,
                'current_session' => $currentSession->id,
            ],

            // Students for Guardian 7 (Mr. Daniel Etim)
            [
                'first_name' => 'Blessing',
                'middle_name' => 'Joy',
                'last_name' => 'Etim',
                'std_number' => 'STD010',
                'date_of_birth' => Carbon::create(2015, 10, 30),
                'nationality' => 'Nigerian',
                'gender' => 'Female',
                'stateoforigin' => 'Akwa Ibom',
                'lga' => 'Uyo',
                'genotype' => 'AA',
                'bgroup' => 'AB-',
                'guardian_id' => $guardians->get(6)?->id,
                'class_id' => $classrooms->where('name', 'Primary 4A')->first()?->id,
                'current_session' => $currentSession->id,
            ],

            // Students for Guardian 8 (Mrs. Kemi Adeyemi)
            [
                'first_name' => 'Ayomide',
                'middle_name' => 'Faith',
                'last_name' => 'Adeyemi',
                'std_number' => 'STD011',
                'date_of_birth' => Carbon::create(2009, 5, 12),
                'nationality' => 'Nigerian',
                'gender' => 'Female',
                'stateoforigin' => 'Ogun',
                'lga' => 'Abeokuta South',
                'genotype' => 'AS',
                'bgroup' => 'O-',
                'guardian_id' => $guardians->get(7)?->id,
                'class_id' => $classrooms->where('name', 'SSS 1 Science')->first()?->id,
                'current_session' => $currentSession->id,
            ],
            [
                'first_name' => 'Oluwatobi',
                'middle_name' => 'David',
                'last_name' => 'Adeyemi',
                'std_number' => 'STD012',
                'date_of_birth' => Carbon::create(2012, 2, 28),
                'nationality' => 'Nigerian',
                'gender' => 'Male',
                'stateoforigin' => 'Ogun',
                'lga' => 'Abeokuta South',
                'genotype' => 'AA',
                'bgroup' => 'B+',
                'guardian_id' => $guardians->get(7)?->id,
                'class_id' => $classrooms->where('name', 'JSS 1B')->first()?->id,
                'current_session' => $currentSession->id,
            ],
        ];

        foreach ($students as $student) {
            // Only create if the required relationships exist
            if ($student['guardian_id'] && $student['class_id']) {
                Student::firstOrCreate(
                    ['std_number' => $student['std_number']],
                    $student
                );
            }
        }

        $this->command->info('Students seeded successfully!');
        $this->command->info('Total students created: ' . Student::count());
        
        // Show guardian-student relationships
        $guardianStudentCounts = Guardian::withCount('students')->get();
        foreach ($guardianStudentCounts as $guardian) {
            $this->command->info("Guardian: {$guardian->guardian_name} has {$guardian->students_count} student(s)");
        }
    }
}